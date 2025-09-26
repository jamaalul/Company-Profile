@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
            <!-- Product Images -->
            <div class="flex flex-col-reverse">
                <div class="w-full aspect-w-1 aspect-h-1">
                    <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : '/placeholder.svg?height=500&width=500' }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-96 object-center object-cover sm:rounded-lg">
                </div>
            </div>

            <!-- Product Info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h1>
                
                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl tracking-tight text-green-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>
                    <div class="text-base text-gray-700 space-y-6">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                <!-- Product Specifications -->
                @if($product->specifications)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900">Specifications</h3>
                    <div class="mt-4 space-y-2">
                        @foreach($product->specifications as $key => $value)
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="text-gray-600">{{ $key }}:</span>
                            <span class="text-gray-900 font-medium">
                                {{ is_array($value) ? implode(', ', $value) : $value }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Stock Info -->
                <div class="mt-8">
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600">Stock available: </span>
                        <span class="ml-2 text-sm font-medium {{ $product->stock <= 5 ? 'text-red-600' : 'text-green-600' }}">
                            {{ $product->stock }} items
                        </span>
                    </div>
                    @if($product->stock <= 5)
                    <p class="mt-2 text-sm text-red-600">⚠️ Only {{ $product->stock }} items left in stock!</p>
                    @endif
                </div>

                <!-- Purchase Form -->
                @if($product->isInStock())
                <form action="{{ route('marketplace.purchase', $product) }}" method="POST" class="mt-10">
                    @csrf
                    
                    <!-- Quantity -->
                    <div class="mb-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                        <select name="quantity" id="quantity" class="w-20 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            @for($i = 1; $i <= min(10, $product->stock); $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Customer Information -->
                    <div class="space-y-4 mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Customer Information</h3>
                        
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="customer_name" id="customer_name" required 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                   value="{{ old('customer_name') }}">
                            @error('customer_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input type="email" name="customer_email" id="customer_email" required 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                   value="{{ old('customer_email') }}">
                            @error('customer_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" name="customer_phone" id="customer_phone" required 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                   value="{{ old('customer_phone') }}">
                            @error('customer_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-1">Delivery Address *</label>
                            <textarea name="customer_address" id="customer_address" rows="3" required 
                                      class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Purchase Now
                    </button>
                </form>
                @else
                <div class="mt-10">
                    <button disabled class="w-full bg-gray-400 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white cursor-not-allowed">
                        Out of Stock
                    </button>
                </div>
                @endif

                <!-- Product Details -->
                <div class="mt-10 border-t border-gray-200 pt-10">
                    <h3 class="text-lg font-medium text-gray-900">Product Details</h3>
                    <div class="mt-4 space-y-2">
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">SKU:</span>
                            <span class="text-gray-900 font-medium">{{ $product->sku }}</span>
                        </div>
                        @if($product->weight)
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">Weight:</span>
                            <span class="text-gray-900 font-medium">{{ $product->weight }}g</span>
                        </div>
                        @endif
                        <div class="flex justify-between py-2">
                            <span class="text-gray-600">Status:</span>
                            <span class="text-green-600 font-medium">{{ ucfirst($product->status) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">Related Products</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $related)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <div class="relative">
                    <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : '/placeholder.svg?height=200&width=300' }}" 
                         alt="{{ $related->name }}" 
                         class="w-full h-48 object-cover">
                    @if($related->stock <= 5)
                    <div class="absolute top-4 right-4">
                        <span class="bg-red-500 text-white text-xs font-semibold px-2.5 py-1 rounded-full">Low Stock</span>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $related->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($related->description, 80) }}</p>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xl font-bold text-green-600">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                        <span class="text-sm text-gray-500">Stock: {{ $related->stock }}</span>
                    </div>
                    <a href="{{ route('marketplace.show', $related) }}" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors font-semibold text-center block">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
