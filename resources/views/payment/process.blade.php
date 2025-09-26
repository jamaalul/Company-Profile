@extends('layouts.app')

@section('title', 'Payment - Order #' . $order->order_number)

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-700 px-6 py-8 text-white">
                <h1 class="text-2xl md:text-3xl font-bold">Complete Your Payment</h1>
                <p class="text-blue-100 mt-2">Order #{{ $order->order_number }}</p>
            </div>

            <!-- Order Summary -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{ $item->product->featured_image ? asset('storage/' . $item->product->featured_image) : '/placeholder.svg?height=60&width=60' }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-16 h-16 object-cover rounded-lg">
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
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
                        <span>Total Amount</span>
                        <span class="text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Delivery Information</h2>
                
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

            <!-- Payment Section -->
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h2>
                
                <!-- Mock Payment Interface -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Secure Payment</h3>
                        <p class="text-gray-600 mb-6">Choose your preferred payment method below</p>
                        
                        <!-- Payment Options -->
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-blue-500 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Bank Transfer</span>
                                </div>
                                <span class="text-sm text-gray-500">Recommended</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-blue-500 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-600 rounded flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">E-Wallet</span>
                                </div>
                                <span class="text-sm text-gray-500">Instant</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-blue-500 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-purple-600 rounded flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Credit Card</span>
                                </div>
                                <span class="text-sm text-gray-500">Secure</span>
                            </div>
                        </div>
                        
                        <!-- Mock Payment Button -->
                        <button onclick="processPayment()" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                            Pay Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </button>
                        
                        <p class="text-xs text-gray-500 mt-4">
                            🔒 Your payment information is secure and encrypted
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function processPayment() {
    // Mock payment processing
    const button = event.target;
    button.disabled = true;
    button.innerHTML = 'Processing...';
    
    // Simulate payment processing
    setTimeout(() => {
        // Redirect to success page
        window.location.href = '{{ route("payment.success", $order) }}';
    }, 2000);
}
</script>
@endsection
