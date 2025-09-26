@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total News</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_news'] }}</p>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-green-600">{{ $stats['published_news'] }} published</span>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Products</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_products'] }}</p>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-green-600">{{ $stats['active_products'] }} active</span>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Orders</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_orders'] }}</p>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-green-600">{{ $stats['paid_orders'] }} paid</span>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-sm text-gray-500">From paid orders</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
        </div>
        <div class="p-6">
            @if($recentOrders->count() > 0)
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900">#{{ $order->order_number }}</p>
                            <p class="text-sm text-gray-600">{{ $order->customer_name }}</p>
                            <p class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y g:i A') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : 
                                   ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        View all orders →
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No orders yet</p>
            @endif
        </div>
    </div>

    <!-- Popular Products -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Popular Products</h3>
        </div>
        <div class="p-6">
            @if($popularProducts->count() > 0)
                <div class="space-y-4">
                    @foreach($popularProducts as $product)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-center">
                            <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : '/placeholder.svg?height=50&width=50' }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-12 h-12 object-cover rounded-lg">
                            <div class="ml-4">
                                <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                <p class="text-sm text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-gray-900">{{ $product->order_items_count }} sold</p>
                            <p class="text-sm text-gray-600">Stock: {{ $product->stock }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        View all products →
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">No products yet</p>
            @endif
        </div>
    </div>
</div>
@endsection
