@extends('layouts.new-app')

@section('title', $bundle->name . ' - HIMTI STORE')

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
            <h1 class="hidden lg:block font-bold text-white text-4xl text-start">{{ $bundle->name }}</h1>
            <h1 class="lg:hidden w-full font-bold text-white text-3xl text-start">{{ $bundle->name }}</h1>
        </div>
    </section>

    {{-- DETAIL SECTION --}}
    <section class="flex flex-col items-center p-6 sm:p-10 lg:p-16 w-screen">
        <div class="flex flex-col gap-8 w-full max-w-5xl">
            <div class="flex md:flex-row flex-col gap-8 rounded-2xl w-full">
                {{-- Image --}}
                <div class="relative bg-white rounded-xl md:w-1/2 aspect-square overflow-hidden shrink-0">
                    @if($bundle->image_path)
                        <img src="{{ Str::startsWith($bundle->image_path, 'http') ? $bundle->image_path : Storage::url($bundle->image_path) }}"
                            alt="{{ $bundle->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="/placeholder.svg?height=500&width=500" alt="{{ $bundle->name }}"
                            class="w-full h-full object-cover">
                    @endif
                    @if($bundle->products->contains('is_preorder', true))
                        <span class="top-4 right-4 absolute bg-orange-500 shadow-sm px-3 py-1 rounded-full font-bold text-xs text-white sm:text-sm tracking-wider">
                            PRE-ORDER
                        </span>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex flex-col justify-between md:w-1/2">
                    <div class="flex flex-col gap-4">
                        <h2 class="font-bold text-[#578FCE] text-3xl lg:text-4xl">Rp
                            {{ number_format($bundle->special_price, 0, ',', '.') }}
                        </h2>

                        <div class="max-w-none text-zinc-700 leading-relaxed prose prose-zinc">
                            {!! $bundle->description !!}
                        </div>

                        <div class="bg-zinc-100 mt-4 p-4 lg:p-6 rounded-xl">
                            <h3 class="mb-3 font-bold text-zinc-800 text-xl">Isi Bundle:</h3>
                            <ul class="flex flex-col gap-2">
                                @foreach($bundle->products as $product)
                                    <li class="flex items-center gap-3 text-zinc-700">
                                        <div class="bg-white px-2 py-1 rounded font-semibold text-[#578FCE] text-sm">
                                            <span class="tabular-nums">
                                                {{ $product->pivot->quantity }}x
                                            </span>
                                        </div>
                                        <span>{{ $product->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <a href="{{ route('marketplace.bundle.purchase.form', $bundle->id) }}"
                        class="flex justify-center items-center bg-[#578FCE] hover:bg-[#4a7abd] mt-8 p-3 lg:p-4 rounded-xl font-semibold text-white transition duration-300">
                        Beli Bundle
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection