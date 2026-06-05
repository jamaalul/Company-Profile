@extends('layouts.new-app')

@section('title', 'HIMTI STORE - Teknik Informatika')

@section('content')

    {{-- SEARCH BAR SECTION --}}
    <section
        class="flex flex-col items-center bg-cover bg-no-repeat bg-center px-6 sm:px-10 lg:px-16 pt-24 lg:pt-28 pb-6 sm:pb-6 lg:pb-8 w-screen"
        style="background-image: url('{{ asset('images/about/mesh.webp') }}');">
        <div class="flex lg:flex-row flex-col items-center gap-6 pt-8 w-full max-w-5xl">
            <h1 class="hidden lg:block font-bold text-white text-4xl text-end">HIMTI<br>STORE</h1>
            <h1 class="lg:hidden w-full font-bold text-white text-5xl text-center">HIMTI STORE</h1>
            <form action="{{ route('marketplace.index') }}" method="GET" class="flex items-center bg-white p-[2px] rounded-2xl w-full h-10">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Produk" class="px-4 outline-none w-full h-full rounded-2xl text-black">
                <button type="submit"
                    class="flex justify-center items-center bg-blue-300 hover:bg-blue-400 rounded-[14px] h-full aspect-square text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
    </section>

    {{-- BUNDLE SECTION --}}
    <section class="flex flex-col items-center p-6 sm:p-10 lg:p-16 w-screen">
        <div class="flex flex-col gap-4 bg-zinc-100 p-4 rounded-2xl w-full max-w-5xl">
            <h3 class="flex items-center gap-4 font-bold text-[#578FCE] text-3xl">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path
                        d="M9.375 3a1.875 1.875 0 0 0 0 3.75h1.875v4.5H3.375A1.875 1.875 0 0 1 1.5 9.375v-.75c0-1.036.84-1.875 1.875-1.875h3.193A3.375 3.375 0 0 1 12 2.753a3.375 3.375 0 0 1 5.432 3.997h3.943c1.035 0 1.875.84 1.875 1.875v.75c0 1.036-.84 1.875-1.875 1.875H12.75v-4.5h1.875a1.875 1.875 0 1 0-1.875-1.875V6.75h-1.5V4.875C11.25 3.839 10.41 3 9.375 3ZM11.25 12.75H3v6.75a2.25 2.25 0 0 0 2.25 2.25h6v-9ZM12.75 12.75v9h6.75a2.25 2.25 0 0 0 2.25-2.25v-6.75h-9Z" />
                </svg>
                Bundles
            </h3>
            <div class="gap-4 grid grid-cols-2 lg:grid-cols-4 w-full">
                @forelse ($bundles as $bundle)
                    <a href="{{ route('marketplace.bundle.show', $bundle->id) }}"
                        class="bg-white hover:shadow-md rounded-xl w-full overflow-hidden transition-all hover:-translate-y-1">
                        <div class="bg-zinc-50 rounded-xl w-full aspect-square overflow-hidden">
                            <img src="{{ Str::startsWith($bundle->image_path, 'http') ? $bundle->image_path : Storage::url($bundle->image_path) }}"
                                alt="{{ $bundle->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col p-2 lg:p-4 h-40">
                            <h4 class="overflow-ellipsis font-semibold text-lg line-clamp-2">{{ $bundle->name }}</h4>
                            <p class="overflow-ellipsis text-xss text-zinc-600 line-clamp-2">{{ $bundle->description }}</p>
                            <div class="flex lg:flex-row flex-col lg:justify-between lg:items-center gap-1 mt-auto">
                                <p class="items-end font-semibold text-[#578FCE] text-lg">Rp
                                    {{ number_format($bundle->special_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col col-span-2 lg:col-span-4 items-center gap-4 py-16 text-center">
                        <div class="flex justify-center items-center bg-zinc-200 rounded-full w-20 h-20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-10 text-zinc-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h3 class="font-semibold text-zinc-700 text-xl">Belum Ada Bundle</h3>
                            <p class="max-w-sm text-zinc-500 text-sm">Saat ini belum ada bundle yang tersedia. Silakan cek kembali nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        </div>
    </section>

    {{-- PRODUCT SECTION --}}
    <section class="flex flex-col items-center p-6 sm:p-10 lg:p-16 w-screen">
        <div class="flex flex-col gap-4 rounded-2xl w-full max-w-5xl">
            <h3 class="flex items-center gap-4 font-bold text-[#578FCE] text-3xl">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z"
                        clip-rule="evenodd" />
                </svg>
                Produk
            </h3>
            <div class="gap-4 grid grid-cols-2 lg:grid-cols-4 w-full">
                @forelse ($products as $product)
                    <a href="{{ route('marketplace.show', $product->id) }}"
                        class="bg-white hover:shadow-sm rounded-xl w-full overflow-hidden transition-all hover:-translate-y-1">
                        <div class="bg-zinc-50 rounded-xl w-full aspect-square overflow-hidden">
                            <img src="{{ Str::startsWith($product->image_path, 'http') ? $product->image_path : Storage::url($product->image_path) }}"
                                alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col p-2 lg:p-4 h-40">
                            <h4 class="overflow-ellipsis font-semibold text-lg line-clamp-2">{{ $product->name }}</h4>
                            <p class="overflow-ellipsis text-xss text-zinc-600 line-clamp-2">
                                {{ strip_tags($product->description) }}
                            </p>
                            <div class="flex lg:flex-row flex-col lg:justify-between lg:items-center gap-1 mt-auto">
                                <p class="items-end font-semibold text-[#578FCE] text-lg">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col col-span-2 lg:col-span-4 items-center gap-4 py-16 text-center">
                        <div class="flex justify-center items-center bg-zinc-100 rounded-full w-20 h-20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-10 text-zinc-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col gap-1">
                            <h3 class="font-semibold text-zinc-700 text-xl">Belum Ada Produk</h3>
                            <p class="max-w-sm text-zinc-500 text-sm">Saat ini belum ada produk yang tersedia. Silakan cek kembali nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>
    </section>
@endsection