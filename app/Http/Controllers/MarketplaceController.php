<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Bundle;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemFieldValue;
use App\Http\Requests\CheckoutRequest;
use App\Enums\OrderStatus;
use App\Mail\OrderCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class MarketplaceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $productsQuery = Product::active()->latest();
        $bundlesQuery = Bundle::with('products')->active()->latest();

        if ($search) {
            $productsQuery->where('name', 'LIKE', '%' . $search . '%');
            $bundlesQuery->where('name', 'LIKE', '%' . $search . '%');
        }

        $products = $productsQuery->get();
        $bundles = $bundlesQuery->get();

        return view('marketplace.index', compact('products', 'bundles'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active || $product->stock <= 0) {
            abort(404);
        }
        return view('marketplace.show', compact('product'));
    }

    public function purchaseForm(Product $product)
    {
        if (!$product->is_active || $product->stock <= 0) {
            abort(404);
        }
        $product->load('fields');
        return view('marketplace.purchase', compact('product'));
    }

    public function purchase(CheckoutRequest $request)
    {
        $validated = $request->validated();
        $validated['quantity'] = 1;
        $product = Product::findOrFail($validated['product_id']);

        if (!$product->is_active || $product->stock < $validated['quantity']) {
            return back()->withInput()->with('error', 'Produk tidak tersedia atau stok tidak cukup.');
        }

        // Handle file upload
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Calculate total
        $totalPrice = $product->price * $validated['quantity'];

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'tracking_token' => Str::uuid()->toString(),
            'buyer_name' => strip_tags($validated['customer_name']),
            'buyer_email' => strip_tags($validated['customer_email']),
            'buyer_whatsapp' => strip_tags($validated['customer_phone']),
            'total_price' => $totalPrice,
            'status' => OrderStatus::PendingApproval, // Usually PendingPayment, but we collect proof upfront
            'payment_proof_path' => $paymentProofPath,
        ]);

        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'orderable_type' => 'product',
            'quantity' => $validated['quantity'],
            'unit_price' => $product->price,
        ]);

        // Decrement stock
        $product->decrement('stock', $validated['quantity']);

        // Let's create dummy ProductField records for the product if they don't exist
        // to map these answers, or just store them differently. 
        // We'll create the field values based on dynamic fields if they exist.
        
        foreach ($product->fields as $field) {
            $fieldName = 'field_' . $field->id;
            if ($request->has($fieldName) || $request->hasFile($fieldName)) {
                $value = $request->input($fieldName);
                $filePath = null;
                
                if ($field->field_type === 'file' && $request->hasFile($fieldName)) {
                    $filePath = $request->file($fieldName)->store('order_files', 'public');
                    $value = null;
                }

                OrderItemFieldValue::create([
                    'order_item_id' => $orderItem->id,
                    'product_field_id' => $field->id,
                    'value' => $value,
                    'file_path' => $filePath,
                ]);
            }
        }

        // Mail
        Mail::to($order->buyer_email)->send(new OrderCreatedMail($order));

        return redirect()->route('marketplace.order.success', $order->order_number);
    }

    public function orderSuccess($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('marketplace.order-success', compact('order'));
    }

    public function showBundle(Bundle $bundle)
    {
        if (!$bundle->is_active) {
            abort(404);
        }
        $bundle->load('products');
        return view('marketplace.show-bundle', compact('bundle'));
    }

    public function purchaseBundleForm(Bundle $bundle)
    {
        if (!$bundle->is_active) {
            abort(404);
        }
        $bundle->load(['products' => function ($query) {
            $query->with('fields');
        }]);
        
        foreach ($bundle->products as $product) {
            if ($product->stock < $product->pivot->quantity) {
                return redirect()->route('marketplace.index')->with('error', 'Salah satu produk dalam bundle ini sedang habis.');
            }
        }

        return view('marketplace.purchase-bundle', compact('bundle'));
    }

    public function purchaseBundle(\App\Http\Requests\BundleCheckoutRequest $request)
    {
        $validated = $request->validated();
        $validated['quantity'] = 1; // Force quantity to 1
        
        $bundle = Bundle::with('products.fields')->findOrFail($validated['bundle_id']);

        if (!$bundle->is_active) {
            return back()->withInput()->with('error', 'Bundle tidak tersedia.');
        }

        foreach ($bundle->products as $product) {
            $requiredQuantity = $product->pivot->quantity * $validated['quantity'];
            if ($product->stock < $requiredQuantity) {
                return back()->withInput()->with('error', 'Stok untuk produk ' . $product->name . ' tidak mencukupi.');
            }
        }

        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $totalPrice = $bundle->special_price * $validated['quantity'];

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'tracking_token' => Str::uuid()->toString(),
            'buyer_name' => strip_tags($validated['customer_name']),
            'buyer_email' => strip_tags($validated['customer_email']),
            'buyer_whatsapp' => strip_tags($validated['customer_phone']),
            'total_price' => $totalPrice,
            'status' => OrderStatus::PendingApproval,
            'payment_proof_path' => $paymentProofPath,
        ]);

        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'bundle_id' => $bundle->id,
            'orderable_type' => 'bundle',
            'quantity' => $validated['quantity'],
            'unit_price' => $bundle->special_price,
        ]);

        foreach ($bundle->products as $product) {
            $requiredQuantity = $product->pivot->quantity * $validated['quantity'];
            $product->decrement('stock', $requiredQuantity);

            $fieldsData = $request->input('fields.' . $product->id, []);
            for ($copy = 0; $copy < $product->pivot->quantity; $copy++) {
                foreach ($product->fields as $field) {
                    $value = $fieldsData[$copy][$field->id] ?? null;
                    $filePath = null;

                    if ($field->field_type === 'file' && $request->hasFile("fields.{$product->id}.{$copy}.{$field->id}")) {
                        $filePath = $request->file("fields.{$product->id}.{$copy}.{$field->id}")->store('order_files', 'public');
                        $value = null;
                    }

                    if ($value !== null || $filePath !== null) {
                        OrderItemFieldValue::create([
                            'order_item_id' => $orderItem->id,
                            'product_field_id' => $field->id,
                            'value' => $value,
                            'file_path' => $filePath,
                            'copy_index' => $copy,
                        ]);
                    }
                }
            }
        }

        // Mail
        Mail::to($order->buyer_email)->send(new OrderCreatedMail($order));

        return redirect()->route('marketplace.order.success', $order->order_number);
    }

    
    public function track($token)
    {
        $order = Order::with('items')->where('tracking_token', $token)->firstOrFail();
        return view('marketplace.tracking', compact('order'));
    }

    public function submitFinalPayment(Request $request, $token)
    {
        $order = Order::where('tracking_token', $token)->firstOrFail();

        if ($order->status !== OrderStatus::PendingFinalPayment || $order->payment_type !== 'down_payment') {
            return back()->with('error', 'Aksi tidak diizinkan.');
        }

        $request->validate([
            'final_payment_proof' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ], [
            'final_payment_proof.required' => 'Bukti pembayaran wajib diunggah.',
            'final_payment_proof.image' => 'Bukti pembayaran harus berupa gambar.',
            'final_payment_proof.mimes' => 'Format gambar harus JPEG, PNG, atau JPG.',
            'final_payment_proof.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        if ($request->hasFile('final_payment_proof')) {
            $path = $request->file('final_payment_proof')->store('payment_proofs', 'public');
            $order->update([
                'final_payment_proof_path' => $path,
                'status' => OrderStatus::PendingFinalApproval,
            ]);
        }

        return back()->with('success', 'Bukti pelunasan berhasil diunggah dan sedang menunggu persetujuan.');
    }
}