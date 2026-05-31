@extends('layouts.app')

@section('title', 'HIMTI STORE - Teknik Informatika')

@section('content')
    <section
        class="relative flex justify-center items-end bg-cover bg-center px-5 pt-24 md:pt-0 pb-8 md:pb-0 h-fit md:min-h-[500px] overflow-x-hidden"
        style="background-image: url('{{ asset('assets/bg-marketplace.png') }}');">
        <div class="z-10 relative px-4 text-white text-center">

            <!-- Desktop image -->
            <div class="hidden md:block">
                <img src="{{ asset('assets/asset_marketplace.png') }}" alt="HIMTI Store Desktop" class="mx-auto rounded-lg">
            </div>

            <!-- Mobile text -->
            <div class="md:hidden block">
                <h1 class="font-black text-[6rem] -translate-x-18">
                    HIMTI
                </h1>
                <h2 class="font-bold text-5xl tracking-[0.2em] translate-x-8">
                    STORE
                </h2>
            </div>

        </div>
    </section>

    {{-- =========================================================
    CATALOG SECTION
    ========================================================= --}}
    <div class="flex flex-col items-center mx-auto px-4 sm:px-6 lg:px-8 w-full max-w-screen-xl">

        <h1 class="mb-8 pt-16 sm:pt-20 w-full font-bold text-blue-900 text-4xl md:text-5xl text-center tracking-tight">
            CATALOG
        </h1>

        <div class="gap-3 md:gap-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 pb-16 w-full">

            @foreach($bundles as $bundle)
                <a href="{{ route('marketplace.bundle.show', $bundle->id) }}" class="group block h-full">
                    <div
                        class="flex flex-col bg-white shadow-sm border border-gray-100 hover:border-gray-200 rounded-2xl h-full overflow-hidden transition-all hover:-translate-y-1 duration-300">

                        {{-- Bundle image --}}
                        <div class="relative bg-blue-50 aspect-square overflow-hidden shrink-0">
                            @if($bundle->image_path)
                                <img src="{{ asset('storage/' . $bundle->image_path) }}" alt="{{ $bundle->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="/placeholder.svg?height=200&width=300" alt="{{ $bundle->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif

                            <div class="top-2 right-2 absolute flex flex-col items-end gap-1">
                                <span
                                    class="bg-blue-600 shadow-sm px-2 py-0.5 rounded-full font-bold text-[10px] text-white sm:text-xs tracking-wider">
                                    BUNDLE
                                </span>
                                @if($bundle->products->contains('is_preorder', true))
                                    <span
                                        class="bg-orange-500 shadow-sm px-2 py-0.5 rounded-full font-bold text-[10px] text-white sm:text-xs tracking-wider">
                                        PRE-ORDER
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Bundle info --}}
                        <div class="flex flex-col flex-1 p-3 sm:p-4">
                            <h2
                                class="mb-1 font-bold text-blue-900 group-hover:text-blue-700 text-sm sm:text-base md:text-lg line-clamp-2 leading-snug transition-colors">
                                {{ $bundle->name }}
                            </h2>

                            <p class="flex-1 mb-2 text-blue-700/60 text-xs sm:text-sm line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($bundle->description), 90) }}
                            </p>

                            <div class="flex items-center mt-auto pt-2 border-blue-100/60 border-t">
                                <p class="font-bold text-blue-800 text-sm sm:text-base whitespace-nowrap">
                                    Rp&nbsp;{{ number_format($bundle->special_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                    </div>
                </a>
            @endforeach

            @forelse($products as $product)
                <a href="{{ route('marketplace.show', $product->id) }}" class="group block h-full">
                    <div
                        class="flex flex-col bg-white shadow-sm border border-gray-100 hover:border-blue-200 rounded-2xl h-full overflow-hidden transition-all hover:-translate-y-1 duration-300">

                        {{-- Product image --}}
                        <div class="relative bg-gray-50 aspect-square overflow-hidden shrink-0">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="/placeholder.svg?height=200&width=300" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif

                            @if($product->is_preorder)
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
                                {{ $product->name }}
                            </h2>

                            <p class="flex-1 mb-2 text-gray-500 text-xs sm:text-sm line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($product->description), 90) }}
                            </p>

                            <div
                                class="flex flex-wrap justify-between items-center gap-1 mt-auto pt-2 border-gray-100 border-t">
                                <p class="font-bold text-blue-800 text-sm sm:text-base whitespace-nowrap">
                                    Rp&nbsp;{{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                @if(!$product->is_preorder)
                                    <span
                                        class="bg-gray-100 px-2 py-0.5 rounded-md font-medium text-[10px] text-gray-500 sm:text-xs whitespace-nowrap">
                                        Stok: {{ $product->stock }}
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </a>
            @empty
                <div
                    class="col-span-full bg-gray-50 py-16 border border-gray-200 border-dashed rounded-2xl text-gray-500 text-center">
                    <svg class="mx-auto mb-3 w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <p class="font-medium text-lg">Belum ada produk yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection