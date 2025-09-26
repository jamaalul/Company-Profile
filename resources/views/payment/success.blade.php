@extends('layouts.app')

@section('title', 'Payment Success')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Success Header -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-12 text-white text-center">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Payment Successful!</h1>
                <p class="text-green-100 text-lg">Thank you for your purchase. Your order has been confirmed.</p>
            </div>

            <!-- Order Details -->
            <div class="p-6">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Order Confirmation</h2>
                    <p class="text-gray-600">Order #{{ $order->order_number }}</p>
                    <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                </div>

                <!-- Order Summary -->
                <div class="border border-gray-200 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                    
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $item->product->featured_image ? asset('storage/' . $item->product->featured_image) : '/placeholder.svg?height=60&width=60' }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-16 h-16 object-cover rounded-lg">
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-sm text-gray-500">Price: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between text-lg font-bold text-gray-900">
                            <span>Total Paid</span>
                            <span class="text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Delivery Information -->
                <div class="border border-gray-200 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Delivery Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Customer Name</p>
                            <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-medium text-gray-900">{{ $order->customer_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Phone</p>
                            <p class="font-medium text-gray-900">{{ $order->customer_phone }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600">Delivery Address</p>
                            <p class="font-medium text-gray-900">{{ $order->customer_address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4">What's Next?</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-white text-xs font-bold">1</span>
                            </div>
                            <div>
                                <p class="font-medium text-blue-900">Order Confirmation</p>
                                <p class="text-blue-700 text-sm">You'll receive an email confirmation shortly with your order details.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-white text-xs font-bold">2</span>
                            </div>
                            <div>
                                <p class="font-medium text-blue-900">Processing</p>
                                <p class="text-blue-700 text-sm">Your order will be processed within 1-2 business days.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-white text-xs font-bold">3</span>
                            </div>
                            <div>
                                <p class="font-medium text-blue-900">Shipping</p>
                                <p class="text-blue-700 text-sm">We'll send you tracking information once your order ships.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('marketplace.index') }}" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold text-center">
                        Continue Shopping
                    </a>
                    <a href="{{ route('home') }}" class="border border-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-50 transition-colors font-semibold text-center">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
