<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MarketplaceController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::active()
            ->featured()
            ->inStock()
            ->take(4)
            ->get();

        $products = Product::active()
            ->inStock()
            ->latest()
            ->paginate(12);

        return view('marketplace.index', compact('featuredProducts', 'products'));
    }

    public function show(Product $product)
    {
        if ($product->status !== 'active') {
            abort(404);
        }

        $relatedProducts = Product::active()
            ->inStock()
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('marketplace.show', compact('product', 'relatedProducts'));
    }

    public function purchaseForm(Product $product)
    {
        if ($product->status !== 'active' || !$product->isInStock()) {
            abort(404);
        }

        return view('marketplace.purchase', compact('product'));
    }

    public function purchase(Request $request, Product $product)
    {     

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'angkatan' => 'required|string|max:10',
            'bidang' => 'required|in:HIMTI (non hima),Alumni,Medinfo,Pendidikan,Pengmas,Perhubungan,PSDM,Ekraf',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'size' => 'required|in:XS,S,M,L,XL,XXL,3XL',
            'payment_method' => 'required|in:cash,qris',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'customer_name.required' => 'Nama lengkap wajib diisi',
            'angkatan.required' => 'Angkatan wajib diisi',
            'bidang.required' => 'Bidang wajib dipilih',
            'bidang.in' => 'Bidang yang dipilih tidak valid',
            'customer_phone.required' => 'Nomor telepon wajib diisi',
            'customer_address.required' => 'Alamat wajib diisi',
            'size.required' => 'Size wajib dipilih',
            'payment_method.required' => 'Metode pembayaran wajib dipilih',
            'payment_proof.required' => 'Bukti pembayaran wajib diupload',
            'payment_proof.image' => 'File harus berupa gambar',
            'payment_proof.mimes' => 'Format gambar harus JPEG, PNG, atau JPG',
            'payment_proof.max' => 'Ukuran file tidak boleh lebih dari 2MB',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check stock availability
        if ($product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stock tidak mencukupi'])->withInput();
        }

        $quantity = $request->quantity;
        $totalAmount = $product->price * $quantity;

        // Handle payment proof upload
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $fileName = time() . '_payment_proof_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Store in public/storage/payment_proofs via Laravel's public disk
            $paymentProofPath = $file->storeAs('payment_proofs', $fileName, 'public');
            
            // Verify file was stored correctly
            if (!Storage::disk('public')->exists($paymentProofPath)) {
                return back()->withErrors(['payment_proof' => 'Gagal menyimpan bukti pembayaran'])->withInput();
            }
        }

        // Create order
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email ?? '',
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'angkatan' => $request->angkatan,
            'bidang' => $request->bidang,
            'size' => $request->size,
            'payment_method' => $request->payment_method,
            'payment_proof' => $paymentProofPath,
            'total_amount' => $product->price, // Karena quantity dihapus, jadi hanya price saja
            'status' => 'pending_confirmation',
        ]);

        // Create order item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1, // Fixed quantity 1
            'price' => $product->price,
        ]);

        return redirect()->route('marketplace.order.success', $order->order_number)
            ->with('success', 'Pesanan berhasil dikirim! Tunggu konfirmasi dari admin.');
    }

    public function orderSuccess($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('marketplace.order-success', compact('order'));
    }
}