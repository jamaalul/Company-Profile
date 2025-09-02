<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['items.product'])->latest();

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search by order number or customer name
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15);

        $statusCounts = [
            'all' => Order::count(),
            'pending_confirmation' => Order::pendingConfirmation()->count(),
            'confirmed' => Order::confirmed()->count(),
            'paid' => Order::paid()->count(),
            'rejected' => Order::rejected()->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function confirm(Request $request, Order $order)
    {
        if (!$order->canBeConfirmed()) {
            return back()->with('error', 'Pesanan tidak dapat dikonfirmasi.');
        }

        $request->validate([
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $order->update([
            'status' => 'confirmed',
            'admin_notes' => $request->admin_notes,
        ]);

        // Decrease product stock
        foreach ($order->items as $item) {
            $item->product->decreaseStock($item->quantity);
        }

        return back()->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function reject(Request $request, Order $order)
    {
        if (!$order->canBeRejected()) {
            return back()->with('error', 'Pesanan tidak dapat ditolak.');
        }

        $request->validate([
            'admin_notes' => 'required|string|max:500',
        ], [
            'admin_notes.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $order->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Pesanan berhasil ditolak.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending_confirmation,confirmed,paid,rejected',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $oldStatus = $order->status;
        
        $order->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        // If changing from confirmed back to pending_confirmation, restore stock
        if ($oldStatus === 'confirmed' && $request->status === 'pending_confirmation') {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }
        
        // If confirming order, decrease stock
        if ($oldStatus !== 'confirmed' && $request->status === 'confirmed') {
            foreach ($order->items as $item) {
                $item->product->decreaseStock($item->quantity);
            }
        }

        return back()->with('success', 'Status pesanan berhasil diupdate.');
    }

    public function destroy(Order $order)
    {
        // Delete payment proof file if exists
        if ($order->payment_proof && Storage::disk('public')->exists($order->payment_proof)) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        // If order was confirmed, restore stock
        if ($order->status === 'confirmed') {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}