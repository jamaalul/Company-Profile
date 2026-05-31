@extends('layouts.app')

@section('title', $product->name . ' - HIMTI STORE')

@section('content')
    <section class="flex items-center bg-white pt-24 lg:pt-32 pb-16 min-h-screen">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 container max-w-screen-xl">
            <article class="flex md:flex-row flex-col bg-white shadow-sm border border-gray-100 rounded-2xl overflow-hidden">

                <div class="md:w-1/2 bg-gray-50 aspect-square shrink-0">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <img src="/placeholder.svg?height=500&width=500" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    @endif
                </div>

                <div class="flex flex-col justify-between p-8 lg:p-12 md:w-1/2">
                    <div>
                        <h1 class="mb-4 font-bold text-gray-800 text-4xl lg:text-5xl">{{ $product->name }}</h1>
                        <h2 class="mb-6 font-bold text-blue-800 text-3xl">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</h2>
                        <p class="mb-4 font-semibold text-gray-600">Tersisa: {{ $product->stock }} item</p>
                        <div class="mb-4 text-gray-600 leading-relaxed prose">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <a href="{{ route('marketplace.purchase.form', $product->id) }}"
                        class="block bg-blue-800 hover:bg-blue-700 shadow-md px-8 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 w-full md:w-auto font-semibold text-white text-center transition duration-300">
                        Beli Sekarang
                    </a>
                </div>
            </article>
        </div>
    </section>

    <section class="bg-gray-50 py-16">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 container max-w-screen-xl">
            <!-- title -->
            <div class="mb-10 text-center">
                <h2 class="font-bold text-gray-900 text-3xl md:text-4xl">Produk Rekomendasi</h2>
                <p class="mt-3 text-gray-500 text-sm md:text-base">Pilihan terbaik untuk Anda</p>
            </div>

            <div class="gap-3 md:gap-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach(\App\Models\Product::active()->where('id', '!=', $product->id)->inRandomOrder()->take(4)->get() as $recommended)
                    <a href="{{ route('marketplace.show', $recommended->id) }}" class="group block h-full">
                        <div
                            class="flex flex-col bg-white shadow-sm border border-gray-100 hover:border-blue-200 rounded-2xl h-full overflow-hidden transition-all hover:-translate-y-1 duration-300">

                            {{-- Product image --}}
                            <div class="relative bg-gray-50 aspect-square overflow-hidden shrink-0">
                                @if($recommended->image_path)
                                    <img src="{{ asset('storage/' . $recommended->image_path) }}" alt="{{ $recommended->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <img src="/placeholder.svg?height=200&width=300" alt="{{ $recommended->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif

                                @if($recommended->is_preorder)
                                    <span
                                        class="top-2 right-2 absolute bg-orange-500 shadow-sm px-2 py-0.5 rounded-full font-bold text-[10px] text-white sm:text-xs tracking-wider">
                                        PRE-ORDER
                                    </span>
                                @endif
                            </div>

                            {{-- Product info --}}
                            <div class="flex flex-col flex-1 p-3 sm:p-4">
                                <h2
                                    class="mb-1 font-bold text-gray-900 group-hover:text-blue-700 text-sm sm:text-base md:text-lg line-clamp-2 leading-snug transition-colors">
                                    {{ $recommended->name }}
                                </h2>

                                <p class="flex-1 mb-2 text-gray-500 text-xs sm:text-sm line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($recommended->description), 90) }}
                                </p>

                                <div
                                    class="flex flex-wrap justify-between items-center gap-1 mt-auto pt-2 border-gray-100 border-t">
                                    <p class="font-bold text-blue-800 text-sm sm:text-base whitespace-nowrap">
                                        Rp&nbsp;{{ number_format($recommended->price, 0, ',', '.') }}
                                    </p>
                                    @if(!$recommended->is_preorder)
                                        <span
                                            class="bg-gray-100 px-2 py-0.5 rounded-md font-medium text-[10px] text-gray-500 sm:text-xs whitespace-nowrap">
                                            Stok: {{ $recommended->stock }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

@endsection