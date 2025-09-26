<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function process(Order $order)
    {
        if ($order->isPaid()) {
            return redirect()->route('payment.success', $order);
        }

        $snapToken = $this->midtransService->createTransaction($order);

        return view('payment.process', compact('order', 'snapToken'));
    }

    public function callback(Request $request)
    {
        $notification = $this->midtransService->handleNotification($request);
        
        $order = Order::where('order_number', $notification['order_id'])->first();
        
        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
        }

        if ($notification['transaction_status'] === 'settlement' || $notification['transaction_status'] === 'capture') {
            $order->markAsPaid();
            $order->update([
                'payment_id' => $notification['transaction_id'],
                'payment_method' => $notification['payment_type'],
                'payment_data' => $notification,
            ]);

            // Decrease product stock
            foreach ($order->items as $item) {
                $item->product->decreaseStock($item->quantity);
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function success(Order $order)
    {
        if (!$order->isPaid()) {
            return redirect()->route('marketplace.show', $order->items->first()->product);
        }

        return view('payment.success', compact('order'));
    }
}
