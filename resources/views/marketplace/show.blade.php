@extends('layouts.app')

@section('title', 'HIMTI STORE - Teknik Informatika')

@section('content')
    <style>
        .body {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
    </style>

    <section class="bg-white min-h-screen flex items-center py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <article class="bg-white shadow-xl rounded-lg overflow-hidden flex flex-col md:flex-row">

                <div class="md:w-1/2">
                    <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : '/placeholder.svg?height=500&width=500' }}" 
                         alt="{{ $product->name }}"
                        class="w-full h-full object-cover">
                </div>

                <div class="md:w-1/2 p-8 lg:p-12 flex flex-col justify-between">
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>
                        <h2 class="text-3xl font-bold text-blue-800 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            {{ $product->description }}
                        </p>
                        @if($product->stock > 0)
                            <p class="text-green-600 mb-8 font-medium">
                                <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Stok tersedia: {{ $product->stock }} item
                            </p>
                        @else
                            <p class="text-red-600 mb-8 font-medium">
                                <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                Stok habis
                            </p>
                        @endif
                    </div>
                    
                    @if($product->stock > 0)
                        <a href="{{ route('marketplace.purchase.form', $product) }}"
                            class="block w-full md:w-auto px-8 py-3 bg-blue-800 text-white font-semibold rounded-lg shadow-md text-center hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Beli Sekarang
                        </a>
                    @else
                        <button disabled
                            class="block w-full md:w-auto px-8 py-3 bg-gray-400 text-white font-semibold rounded-lg shadow-md text-center cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif
                </div>
            </article>
        </div>
    </section>

    @if($relatedProducts->count() > 0)
    <section class="bg-gray-50 mt-24">
        <!-- title -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Produk Rekomendasi</h2>
            <p class="text-gray-600 mt-2">Pilihan terbaik untuk Anda</p>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-24">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $related)
                <div class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : '/placeholder.svg?height=200&width=300' }}" 
                         alt="{{ $related->name }}" class="w-full object-cover h-48">
                    <div class="p-4">
                        <h3 class="text-xl font-bold">{{ $related->name }}</h3>
                        <div class="body">
                            <div class="text-gray-800 leading-relaxed">
                                {!! nl2br(e($related->description)) !!}
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('marketplace.show', $related) }}"
                                class="block w-full md:w-auto px-8 py-2 bg-blue-800 text-white font-semibold rounded-lg shadow-md text-center hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection