@extends('layouts.new-app')

@section('title', $product->name . ' - HIMTI STORE')

@section('content')
    {{-- HEADER SECTION --}}
    <section
        class="flex flex-col items-center bg-cover bg-no-repeat bg-center px-6 sm:px-10 lg:px-16 pt-24 lg:pt-28 pb-6 sm:pb-6 lg:pb-8 w-screen"
        style="background-image: url('{{ asset('images/about/mesh.webp') }}');">
        <div class="flex flex-col gap-4 pt-8 w-full max-w-5xl">
            <a href="{{ route('marketplace.index') }}"
                class="flex items-center gap-2 w-fit text-white/80 hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Marketplace
            </a>
            <h1 class="hidden lg:block font-bold text-white text-4xl text-start">{{ $product->name }}</h1>
            <h1 class="lg:hidden w-full font-bold text-white text-3xl text-start">{{ $product->name }}</h1>
        </div>
    </section>

    {{-- DETAIL SECTION --}}
    <section class="flex flex-col items-center p-6 sm:p-10 lg:p-16 w-screen">
        <div class="flex flex-col gap-8 w-full max-w-5xl">
            <div class="flex md:flex-row flex-col gap-8 rounded-2xl w-full">
                {{-- Image --}}
                <div class="bg-white rounded-xl md:w-1/2 aspect-square overflow-hidden shrink-0">
                    @if($product->image_path)
                        <img src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : Storage::url($product->image_path) }}"
                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="/placeholder.svg?height=500&width=500" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex flex-col justify-between md:w-1/2">
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col gap-2">
                            <h2 class="font-bold text-[#578FCE] text-3xl lg:text-4xl">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</h2>
                            <p class="font-semibold text-zinc-600">Tersisa: {{ $product->stock }} item</p>
                        </div>

                        <div class="max-w-none text-zinc-700 leading-relaxed prose prose-zinc">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <a href="{{ route('marketplace.purchase.form', $product->id) }}"
                        class="flex justify-center items-center bg-[#578FCE] hover:bg-[#4a7abd] mt-8 p-3 lg:p-4 rounded-xl font-semibold text-white transition duration-300">
                        Beli Sekarang
                    </a>
                </div>
            </div>

            {{-- RECOMMENDED PRODUCTS --}}
            <div class="flex flex-col gap-4 mt-8">
                <h3 class="flex items-center gap-4 font-bold text-[#578FCE] text-2xl lg:text-3xl">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z"
                            clip-rule="evenodd" />
                    </svg>
                    Produk Rekomendasi
                </h3>
                <div class="gap-4 grid grid-cols-2 lg:grid-cols-4 w-full">
                    @foreach(\App\Models\Product::active()->where('id', '!=', $product->id)->inRandomOrder()->take(4)->get() as $recommended)
                        <a href="{{ route('marketplace.show', $recommended->id) }}"
                            class="bg-white hover:shadow-sm rounded-xl w-full overflow-hidden transition-all hover:-translate-y-1">
                            <div class="relative bg-zinc-50 w-full aspect-square overflow-hidden">
                                @if($recommended->image_path)
                                    <img src="{{ Str::startsWith($recommended->image_path, 'http') ? $recommended->image_path : Storage::url($recommended->image_path) }}"
                                        alt="{{ $recommended->name }}" class="w-full h-full object-cover">
                                @else
                                    <img src="/placeholder.svg?height=200&width=300" alt="{{ $recommended->name }}"
                                        class="w-full h-full object-cover">
                                @endif
                                @if($recommended->is_preorder)
                                    <span
                                        class="top-2 right-2 absolute bg-orange-500 shadow-sm px-2 py-0.5 rounded-full font-bold text-[10px] text-white sm:text-xs tracking-wider">
                                        PRE-ORDER
                                    </span>
                                @endif
                            </div>
                            <div class="flex flex-col p-2 lg:p-4 h-40">
                                <h4 class="overflow-ellipsis font-semibold text-lg line-clamp-2">{{ $recommended->name }}</h4>
                                <p class="overflow-ellipsis text-zinc-600 text-xs line-clamp-2">
                                    {{ strip_tags($recommended->description) }}
                                </p>
                                <div class="flex lg:flex-row flex-col lg:justify-between lg:items-center gap-1 mt-auto">
                                    <p class="items-end font-semibold text-[#578FCE] text-lg">Rp
                                        {{ number_format($recommended->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection