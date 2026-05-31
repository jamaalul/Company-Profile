@extends('layouts.app')

@section('title', $bundle->name . ' - HIMTI STORE')

@section('content')
    <section class="flex items-center bg-white pt-24 lg:pt-32 pb-16 min-h-screen">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 container max-w-screen-xl">
            <article class="flex md:flex-row flex-col bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">

                <div class="md:w-1/2 bg-blue-50 aspect-square shrink-0">
                    @if($bundle->image_path)
                        <img src="{{ asset('storage/' . $bundle->image_path) }}" 
                             alt="{{ $bundle->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <img src="/placeholder.svg?height=500&width=500" 
                             alt="{{ $bundle->name }}"
                            class="w-full h-full object-cover">
                    @endif
                </div>

                <div class="md:w-1/2 p-8 lg:p-12 flex flex-col justify-between">
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">{{ $bundle->name }}</h1>
                        <h2 class="text-3xl font-bold text-blue-800 mb-6">Rp {{ number_format($bundle->special_price, 0, ',', '.') }}</h2>
                        <div class="text-gray-600 mb-4 leading-relaxed prose">
                            {!! $bundle->description !!}
                        </div>
                        
                        <div class="mb-6">
                            <h3 class="font-bold text-lg mb-2">Isi Bundle:</h3>
                            <ul class="list-disc pl-5 text-gray-700">
                                @foreach($bundle->products as $product)
                                    <li>{{ $product->pivot->quantity }}x {{ $product->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    <a href="{{ route('marketplace.bundle.purchase.form', $bundle->id) }}"
                        class="block w-full md:w-auto px-8 py-3 bg-blue-800 text-white font-semibold rounded-lg shadow-md text-center hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Beli Bundle
                    </a>
                </div>
            </article>
        </div>
    </section>
@endsection
