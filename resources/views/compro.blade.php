@extends('layouts.new-app')

@section('title', 'HIMTI - Teknik Informatika')

@section('content')
    {{-- HERO SECTION --}}
    <section class="flex w-screen h-screen">
        <img src="{{ asset('images/compro/all-cabinet.webp') }}" alt="Foto kabinet aksentra"
            class="top-0 right-0 absolute w-screen h-full object-cover">
        <div
            class="top-0 right-0 absolute bg-gradient-to-b from-gray-200 to-blue-300 opacity-50 backdrop-blur-sm w-screen h-full">
        </div>
        <div class="top-0 right-0 absolute bg-gradient-to-b from-black to-black/40 opacity-60 w-screen h-full">
        </div>

        <div class="z-10 flex md:flex-row flex-col flex-1 p-6 sm:p-10 lg:p-16 pt-28 md:pt-24">
            <div class="flex flex-col justify-center h-full text-white md:text-left">
                <h1 class="mb-auto lg:mb-0 font-bold text-5xl md:text-5xl lg:text-6xl leading-tight lg:leading-20">Himpunan
                    Mahasiswa<br>D4
                    Teknik Informatika</h1>
                <div class="flex sm:flex-row flex-col justify-center md:justify-start gap-4 mt-8">
                    <a href="#tentang-himti"
                        class="group flex justify-center items-center gap-2 bg-[#578FCE] hover:bg-[#4673A6] hover:shadow-lg px-6 py-3 rounded-lg font-medium text-white text-sm transition-all hover:-translate-y-1 duration-300 transform">
                        Jelajahi HIMTI
                        <span class="transition-transform group-hover:translate-x-1 duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd"
                                    d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </a>
                    <a href="/news"
                        class="flex justify-center items-center gap-2 bg-white/10 hover:bg-white/20 hover:shadow-lg backdrop-blur-sm px-6 py-3 border border-white/28 rounded-lg font-medium text-white text-sm transition-all hover:-translate-y-1 duration-300 transform">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd"
                                    d="M2 3.5A1.5 1.5 0 0 1 3.5 2h9A1.5 1.5 0 0 1 14 3.5v11.75A2.75 2.75 0 0 0 16.75 18h-12A2.75 2.75 0 0 1 2 15.25V3.5Zm3.75 7a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5Zm0 3a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5ZM5 5.75A.75.75 0 0 1 5.75 5h4.5a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 5 8.25v-2.5Z"
                                    clip-rule="evenodd" />
                                <path d="M16.5 6.5h-1v8.75a1.25 1.25 0 1 0 2.5 0V8a1.5 1.5 0 0 0-1.5-1.5Z" />
                            </svg>
                        </span>
                        Lihat berita
                    </a>
                </div>
            </div>
            <div class="flex justify-center md:justify-end items-end mt-12 md:mt-0 mb-16 md:mb-0 md:ml-auto">
                <img src="{{ asset('images/compro/logo-with-words.webp') }}" alt="Logo Kabinet Aksentra"
                    class="h-8 md:h-12 lg:h-16 object-contain">
            </div>
        </div>
        <div class="bottom-0 left-0 absolute flex justify-center w-screen text-white animate-bounce">
            <div class="flex flex-col justify-center items-center pb-1">
                <p class="text-xs">SCROLL</p>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </section>

    {{-- TENTANG HIMTI SECTION --}}
    <section id="tentang-himti"
        class="flex lg:flex-row flex-col gap-12 lg:gap-32 bg-white px-6 sm:px-10 lg:px-16 py-18 lg:py-32 w-screen overflow-x-hidden">
        <div class="flex flex-col gap-10">
            <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
                <p class="font-medium text-white text-xs">TENTANG HIMTI</p>
            </span>
            <h2 class="font-bold text-4xl lg:text-5xl">Wadah Kreativitas &<br>Pengembangan Diri</h2>
            <p class="text-zinc-500">
                HIMTI UNAIR adalah organisasi kemahasiswaan yang menghimpun seluruh mahasiswa Teknik Informatika. Melalui
                berbagai program kerja, kami membangun lingkungan yang kondusif untuk belajar, berkarya, dan berkembang
                bersama.
            </p>
            <p class="text-zinc-500">
                Kabinet Aksentra hadir dengan semangat sinergi dan identitas dalam setiap karya menjadi motor penggerak
                inovasi dan kolaborasi di lingkungan kampus maupun luar kampus.
            </p>
            <a href="/about-us"
                class="inline-block bg-transparent hover:bg-blue-300 hover:shadow-md px-6 py-3 border-2 border-blue-300 rounded-lg w-fit font-medium text-blue-400 hover:text-white text-sm transition-all hover:-translate-y-1 duration-300">
                Selengkapnya
            </a>
        </div>
        <div
            class="flex flex-col justify-end bg-gradient-to-b from-gray-200 to-blue-300 p-4 rounded-4xl w-full lg:w-7xl h-auto aspect-641/518">
            <img src="{{ asset('images/compro/kadep-kadep.webp') }}" alt="Ketua-ketua departemen"
                class="w-full object-bottom object-contain">
            <div
                class="gap-2 grid grid-cols-1 lg:grid-cols-3 grid-rows-3 lg:grid-rows-1 bg-gradient-to-b from-black/20 to-white/20 shadow-sm backdrop-blur-sm p-2 border border-white/28 rounded-2xl w-full h-fit">
                <div class="flex flex-col justify-center gap-1 bg-white p-3 rounded-xl h-20">
                    <strong class="font-bold text-lg">106 Anggota</strong>
                    <p class="flex items-center gap-1 text-gray-600 text-xs lg:text-sm">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </span>
                        Anggota aktif
                    </p>
                </div>
                <div class="flex flex-col justify-center gap-1 bg-white p-3 rounded-xl h-20">
                    <strong class="font-bold text-lg">8 Departemen</strong>
                    <p class="flex items-center gap-1 text-gray-600 text-xs lg:text-sm">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                            </svg>
                        </span>
                        Departemen
                    </p>
                </div>
                <div class="flex flex-col justify-center gap-1 bg-white p-3 rounded-xl h-20">
                    <strong class="font-bold text-lg">12 Proker</strong>
                    <p class="flex items-center gap-1 text-gray-600 text-xs lg:text-sm">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>
                        </span>
                        Program kerja
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- DEPARTEMEN SECTION --}}
    <section
        class="relative flex flex-col justify-center lg:items-center gap-6 bg-cover bg-no-repeat px-6 sm:px-10 lg:px-16 py-44 lg:py-6 w-screen aspect-[1440/800]"
        style="background-image: url('{{ asset('images/compro/mesh.webp') }}');">
        <h2 class="font-bold text-white text-5xl">Departemen <span class="text-yellow-100">HIMTI</span></h2>
        <p class="lg:w-2/3 text-white text-lg lg:text-center text-balance">
            HIMTI UNAIR memiliki <span class="text-yellow-100">8 departemen</span> yang masing-masing
            memiliki
            tugas dan fungsi untuk menjalankan organisasi secara optimal.
        </p>
        <a href="/about-us"
            class="hover:bg-white hover:shadow-md px-6 py-3 border-3 border-white rounded-lg w-fit font-medium text-white hover:text-blue-400 text-sm transition-all hover:-translate-y-1 duration-300">
            Selengkapnya
        </a>
        <div class="gap-2 lg:gap-4 grid grid-cols-1 lg:grid-cols-4 mt-8 w-full max-w-6xl">
            <div class="relative flex items-center gap-1 bg-white p-4 rounded-xl h-32">
                <strong class="text-semibold text-xl">Departemen<br><span class="text-blue-300">EKSEKUTIF</span></strong>
                <img src="{{ asset('images/compro/kahima-wakahima.webp') }}" alt="Kahima Wakahima"
                    class="right-0 bottom-0 absolute h-full object-cover">
            </div>
            <div class="relative flex items-center gap-1 bg-white p-4 rounded-xl h-32">
                <strong class="text-semibold text-xl">Departemen<br><span class="text-blue-300">RISKEL</span></strong>
                <img src="{{ asset('images/compro/kadep-riskel.webp') }}" alt="Kadep RISKEL"
                    class="right-10 lg:right-6 bottom-0 absolute h-full object-cover">
            </div>
            <div class="relative flex items-center gap-1 bg-white p-4 rounded-xl h-32">
                <strong class="text-semibold text-xl">Departemen<br><span class="text-blue-300">PERHUBUNGAN</span></strong>
                <img src="{{ asset('images/compro/kadep-perhub.webp') }}" alt="Kadep PERHUB"
                    class="right-10 lg:right-6 bottom-0 absolute h-full object-cover">
            </div>
            <div class="relative flex items-center gap-1 bg-white p-4 rounded-xl h-32">
                <strong class="text-semibold text-xl">Departemen<br><span class="text-blue-300">EKRAF</span></strong>
                <img src="{{ asset('images/compro/kadep-ekraf.webp') }}" alt="Kadep EKRAF"
                    class="right-10 lg:right-6 bottom-0 absolute h-full object-cover">
            </div>
            <div class="relative flex items-center gap-1 bg-white p-4 rounded-xl h-32">
                <strong class="text-semibold text-xl">Departemen<br><span class="text-blue-300">MEDINFO</span></strong>
                <img src="{{ asset('images/compro/kadep-medinfo.webp') }}" alt="Kadep MEDINFO"
                    class="right-10 lg:right-6 bottom-0 absolute h-full object-cover">
            </div>
            <div class="relative flex items-center gap-1 bg-white p-4 rounded-xl h-32">
                <strong class="text-semibold text-xl">Departemen<br><span class="text-blue-300">PSDM</span></strong>
                <img src="{{ asset('images/compro/kadep-psdm.webp') }}" alt="Kadep PSDM"
                    class="right-10 lg:right-6 bottom-0 absolute h-full object-cover">
            </div>
            <div class="relative flex items-center gap-1 bg-white p-4 rounded-xl h-32">
                <strong class="text-semibold text-xl">Departemen<br><span class="text-blue-300">PENGMAS</span></strong>
                <img src="{{ asset('images/compro/kadep-pengmas.webp') }}" alt="Kadep PENGMAS"
                    class="right-10 lg:right-6 bottom-0 absolute h-full object-cover">
            </div>
            <div class="relative flex items-center gap-1 bg-white p-4 rounded-xl h-32">
                <strong class="text-semibold text-xl">Departemen<br><span class="text-blue-300">MIKAT</span></strong>
                <img src="{{ asset('images/compro/kadep-mikat.webp') }}" alt="Kadep MIKAT"
                    class="right-10 lg:right-6 bottom-0 absolute h-full object-cover">
            </div>
        </div>
    </section>

    @if($allNews->isNotEmpty())
    {{-- BERITA SECTION --}}
    <section class="flex flex-col gap-6 bg-white p-6 sm:p-10 lg:p-16 w-screen">
        <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
            <p class="font-medium text-white text-xs">BERITA</p>
        </span>
        <div class="flex lg:flex-row flex-col justify-between gap-4">
            <h2 class="font-bold text-4xl lg:5xl">Kegiatan & Berita HIMTI</h2>
            <a href="/news"
                class="hover:bg-blue-300 hover:shadow-md px-6 py-3 border-3 border-blue-300 rounded-lg w-fit h-fit font-medium text-blue-300 hover:text-white text-sm transition-all hover:-translate-y-1 duration-300">
                Selengkapnya
            </a>
        </div>
        <div class="gap-4 grid grid-cols-1 {{ $allNews->count() > 1 ? 'lg:grid-cols-2 grid-rows-2' : 'grid-rows-1' }} lg:grid-rows-1">
            @php $firstNews = $allNews->first(); @endphp
            {{-- Big Card --}}
            <a href="{{ route('news.show', $firstNews->slug) }}" class="group relative flex flex-col justify-end bg-gray-200 rounded-2xl h-[32rem] overflow-hidden">
                @if($firstNews->featured_image)
                    <img src="{{ Str::startsWith($firstNews->featured_image, 'http') ? $firstNews->featured_image : Storage::url($firstNews->featured_image) }}" alt="{{ $firstNews->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                @else
                    <div class="absolute inset-0 w-full h-full bg-red-500 transition-transform duration-700 group-hover:scale-105"></div>
                @endif
                <div class="relative z-10 flex flex-col gap-4 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 lg:p-8 h-full justify-end">
                    <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
                        <p class="font-medium text-white text-xs">{{ $firstNews->type === 'public' ? 'Berita Publik' : ($firstNews->type === 'internal' ? 'Berita Internal' : 'Berita') }}</p>
                    </span>
                    <p class="text-white text-sm">{{ $firstNews->published_at ? $firstNews->published_at->translatedFormat('d F Y') : '' }}</p>
                    <h3 class="font-semibold text-white text-2xl lg:text-3xl">{{ $firstNews->title }}</h3>
                    <p class="text-white/80 text-sm line-clamp-2">
                        {{ $firstNews->excerpt }}
                    </p>
                    <button
                        class="mt-2 flex justify-center items-center gap-2 bg-white/10 group-hover:bg-white/20 group-hover:shadow-lg backdrop-blur-sm px-6 py-3 border border-white/28 rounded-lg w-fit font-medium text-white text-sm transition-all group-hover:-translate-y-1 duration-300 transform">
                        Baca Sekarang
                    </button>
                </div>
            </a>

            {{-- Small Cards Container --}}
            @if($allNews->count() > 1)
            <div class="gap-4 grid {{ $allNews->count() > 2 ? 'grid-rows-2' : 'grid-rows-1' }} h-[32rem]">
                @foreach($allNews->skip(1) as $news)
                <a href="{{ route('news.show', $news->slug) }}" class="group relative flex flex-col justify-end bg-gray-200 rounded-2xl overflow-hidden h-full">
                    @if($news->featured_image)
                        <img src="{{ Str::startsWith($news->featured_image, 'http') ? $news->featured_image : Storage::url($news->featured_image) }}" alt="{{ $news->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    @else
                        <div class="absolute inset-0 w-full h-full bg-red-500 transition-transform duration-700 group-hover:scale-105"></div>
                    @endif
                    <div class="relative z-10 flex flex-col gap-2 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 lg:p-8 h-full justify-end">
                        <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
                            <p class="font-medium text-white text-xs">{{ $news->type === 'public' ? 'Berita Publik' : ($news->type === 'internal' ? 'Berita Internal' : 'Berita') }}</p>
                        </span>
                        <p class="text-white text-sm">{{ $news->published_at ? $news->published_at->translatedFormat('d F Y') : '' }}</p>
                        <h3 class="font-semibold text-white text-xl line-clamp-2">
                            {{ $news->title }}
                        </h3>
                        <button
                            class="mt-2 flex justify-center items-center gap-2 bg-white/10 group-hover:bg-white/20 group-hover:shadow-lg backdrop-blur-sm px-6 py-3 border border-white/28 rounded-lg w-fit font-medium text-white text-sm transition-all group-hover:-translate-y-1 duration-300 transform">
                            Baca Sekarang
                        </button>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    {{-- STORE SECTION --}}
    <section class="flex flex-col gap-6 bg-[#D9EAF7]/50 p-6 sm:p-10 lg:p-16 w-screen">
        <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
            <p class="font-medium text-white text-xs">OFFICIAL STORE</p>
        </span>
        <div class="relative flex bg-[#578FCE] px-4 lg:px-8 pt-4 lg:pt-8 pb-0 rounded-2xl w-full">
            <img src="{{ asset('images/compro/store-banner.webp') }}" alt="HIMTI Store" class="w-full">
            <div class="hidden bottom-4 lg:bottom-8 left-0 absolute lg:flex justify-center w-full">
                <div
                    class="flex flex-col items-center gap-4 bg-white/10 backdrop-blur-sm p-8 border border-white/28 rounded-xl max-w-xl">
                    <h3 class="font-bold text-white text-2xl text-center">Tertarik dengan Merchandise HIMTI?</h3>
                    <p class="text-white/60 text-sm text-center text-balance">
                        Tunjukkan identitasmu sebagai bagian dari HIMTI lewat merchandise eksklusif kami.
                        Untuk kamu yang bangga menjadi bagian dari HIMTI.
                    </p>
                    <a href="/marketplace"
                        class="flex justify-center items-center gap-2 bg-white/10 hover:bg-white/20 hover:shadow-lg backdrop-blur-sm mt-2 px-6 py-3 border border-white/28 rounded-full w-fit font-medium text-white text-sm transition-all hover:-translate-y-1 duration-300 transform">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd"
                                    d="M6 5v1H4.667a1.75 1.75 0 0 0-1.743 1.598l-.826 9.5A1.75 1.75 0 0 0 3.84 19H16.16a1.75 1.75 0 0 0 1.743-1.902l-.826-9.5A1.75 1.75 0 0 0 15.333 6H14V5a4 4 0 0 0-8 0Zm4-2.5A2.5 2.5 0 0 0 7.5 5v1h5V5A2.5 2.5 0 0 0 10 2.5ZM7.5 10a2.5 2.5 0 0 0 5 0V8.75a.75.75 0 0 1 1.5 0V10a4 4 0 0 1-8 0V8.75a.75.75 0 0 1 1.5 0V10Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Kunjungi Marketplace
                    </a>
                </div>
            </div>
        </div>
        <div class="lg:hidden flex flex-col items-center gap-3 bg-white p-4 lg:p-8 rounded-2xl">
            <h3 class="font-bold text-blue-300 text-lg text-center">Tertarik dengan Merchandise HIMTI?</h3>
            <p class="text-black/60 text-xs text-center text-balance">
                Tunjukkan identitasmu sebagai bagian dari HIMTI lewat merchandise eksklusif kami.
                Untuk kamu yang bangga menjadi bagian dari HIMTI.
            </p>
            <a href="/marketplace"
                class="flex justify-center items-center gap-2 bg-blue-300 mt-2 px-4 lg:px-6 py-2 lg:py-3 rounded-full w-fit font-medium text-white text-xs">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M2 3.5A1.5 1.5 0 0 1 3.5 2h9A1.5 1.5 0 0 1 14 3.5v11.75A2.75 2.75 0 0 0 16.75 18h-12A2.75 2.75 0 0 1 2 15.25V3.5Zm3.75 7a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5Zm0 3a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5ZM5 5.75A.75.75 0 0 1 5.75 5h4.5a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 5 8.25v-2.5Z"
                            clip-rule="evenodd" />
                        <path d="M16.5 6.5h-1v8.75a1.25 1.25 0 1 0 2.5 0V8a1.5 1.5 0 0 0-1.5-1.5Z" />
                    </svg>
                </span>
                Kunjungi Marketplace
            </a>
        </div>
    </section>

    {{-- KOLABORASI SECTION --}}
    <section class="flex flex-col justify-center lg:items-center gap-6 bg-[#f4f4f4] p-6 sm:p-10 lg:p-16 w-screen">
        <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
            <p class="font-medium text-white text-xs">KOLABORASI</p>
        </span>
        <h2 class="font-bold text-4xl lg:text-center lg:5xl">Partnership & Media Partner</h2>
        <p class="max-w-4xl text-zinc-600 lg:text-center text-balance">
            Pelajari prosedur kemitraan resmi HIMTI UNAIR dan lihat kolaborator yang telah mendukung kegiatan kami.
        </p>
        <div class="gap-6 lg:gap-32 grid grid-cols-1 lg:grid-cols-2 w-full max-w-5xl">
            <div class="flex flex-col justify-center items-center gap-6 bg-cover bg-no-repeat bg-center shadow-sm p-4 lg:p-8 rounded-2xl h-80"
                style="background-image: url('{{ asset('images/compro/mesh.webp') }}');">
                <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
                    <p class="font-medium text-white text-xs">Partnership</p>
                </span>
                <h3 class="font-bold text-white text-2xl lg:text-3xl text-center">SOP Partnership</h3>
                <p class="text-white/80 text-sm text-center text-balance">
                    Prosedur kerjasama resmi HIMTI UNAIR.
                </p>
                <div class="flex flex-col gap-2 mt-auto w-full">
                    <a href=""
                        class="flex justify-center items-center gap-2 bg-green-600 hover:bg-green-700 hover:shadow-md px-4 lg:px-6 py-2 lg:py-3 rounded-full w-full font-medium text-white transition-all hover:-translate-y-1 duration-300 transform">
                        <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="size-6">
                            <path
                                d="M24.7088 20.9553C24.4251 20.8143 22.5812 19.9683 22.2975 19.8273C22.0138 19.6863 21.7301 19.6863 21.4465 19.9683C21.1628 20.2503 20.5954 21.0963 20.3117 21.3783C20.1699 21.6603 19.8862 21.6603 19.6025 21.5193C18.6096 21.0963 17.6167 20.5323 16.7657 19.8273C16.0565 19.1223 15.3473 18.2763 14.7799 17.4303C14.6381 17.1483 14.7799 16.8663 14.9218 16.7253C15.0636 16.5843 15.2054 16.3023 15.4891 16.1613C15.631 16.0203 15.7728 15.7383 15.7728 15.5973C15.9147 15.4563 15.9147 15.1743 15.7728 15.0333C15.631 14.8923 14.9218 13.2003 14.6381 12.4953C14.4962 11.5083 14.2126 11.5083 13.9289 11.5083H13.2197C12.936 11.5083 12.5105 11.7903 12.3686 11.9313C11.5176 12.7773 11.0921 13.7643 11.0921 14.8923C11.2339 16.1613 11.6594 17.4303 12.5105 18.5583C14.0707 20.8143 16.0565 22.6473 18.4678 23.7753C19.177 24.0573 19.7444 24.3393 20.4536 24.4803C21.1628 24.7623 21.872 24.7623 22.723 24.6213C23.7159 24.4803 24.567 23.7753 25.1343 22.9293C25.418 22.3653 25.418 21.8013 25.2762 21.2373L24.7088 20.9553ZM28.2548 8.12426C22.723 2.62525 13.787 2.62525 8.25523 8.12426C3.71632 12.6363 2.86527 19.5453 5.98578 25.0443L4 32.2353L11.5176 30.2613C13.6452 31.3893 15.9147 31.9533 18.1841 31.9533C25.9854 31.9533 32.2264 25.7493 32.2264 17.9943C32.3682 14.3283 30.808 10.8033 28.2548 8.12426ZM24.4251 27.8643C22.5812 28.9923 20.4536 29.6973 18.1841 29.6973C16.0565 29.6973 14.0707 29.1333 12.2268 28.1463L11.8013 27.8643L7.40419 28.9923L8.53891 24.7623L8.25523 24.3393C4.85105 18.6993 6.55314 11.6493 12.0849 8.12426C17.6167 4.59925 24.7088 6.43225 28.113 11.7903C31.5172 17.2893 29.9569 24.4803 24.4251 27.8643Z"
                                fill="white" />
                        </svg>
                        Ajukan Partnership
                    </a>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center gap-6 bg-cover bg-no-repeat bg-center shadow-sm p-4 lg:p-8 rounded-2xl h-80"
                style="background-image: url('{{ asset('images/compro/mesh.webp') }}');">
                <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
                    <p class="font-medium text-white text-xs">Media Partner</p>
                </span>
                <h3 class="font-bold text-white text-2xl lg:text-3xl text-center">SOP Media Partner</h3>
                <p class="text-white/80 text-sm text-center text-balance">
                    Prosedur kolaborasi publikasi media sosial HIMTI UNAIR.
                </p>
                <div class="flex flex-col gap-2 w-full">
                    <a href="/sop/medinfo"
                        class="flex justify-center items-center gap-2 bg-black/10 hover:bg-black/20 hover:shadow-md backdrop-blur-sm px-4 lg:px-6 py-2 lg:py-3 border border-white/28 rounded-full w-full font-medium text-white transition-all hover:-translate-y-1 duration-300 transform">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd"
                                d="M4.25 5.5a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 0 0 .75-.75v-4a.75.75 0 0 1 1.5 0v4A2.25 2.25 0 0 1 12.75 17h-8.5A2.25 2.25 0 0 1 2 14.75v-8.5A2.25 2.25 0 0 1 4.25 4h5a.75.75 0 0 1 0 1.5h-5Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M6.194 12.753a.75.75 0 0 0 1.06.053L16.5 4.44v2.81a.75.75 0 0 0 1.5 0v-4.5a.75.75 0 0 0-.75-.75h-4.5a.75.75 0 0 0 0 1.5h2.553l-9.056 8.194a.75.75 0 0 0-.053 1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                        Lihat SOP
                    </a>
                    <a href=""
                        class="flex justify-center items-center gap-2 bg-green-600 hover:bg-green-700 hover:shadow-md px-4 lg:px-6 py-2 lg:py-3 rounded-full w-full font-medium text-white transition-all hover:-translate-y-1 duration-300 transform">
                        <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="size-6">
                            <path
                                d="M24.7088 20.9553C24.4251 20.8143 22.5812 19.9683 22.2975 19.8273C22.0138 19.6863 21.7301 19.6863 21.4465 19.9683C21.1628 20.2503 20.5954 21.0963 20.3117 21.3783C20.1699 21.6603 19.8862 21.6603 19.6025 21.5193C18.6096 21.0963 17.6167 20.5323 16.7657 19.8273C16.0565 19.1223 15.3473 18.2763 14.7799 17.4303C14.6381 17.1483 14.7799 16.8663 14.9218 16.7253C15.0636 16.5843 15.2054 16.3023 15.4891 16.1613C15.631 16.0203 15.7728 15.7383 15.7728 15.5973C15.9147 15.4563 15.9147 15.1743 15.7728 15.0333C15.631 14.8923 14.9218 13.2003 14.6381 12.4953C14.4962 11.5083 14.2126 11.5083 13.9289 11.5083H13.2197C12.936 11.5083 12.5105 11.7903 12.3686 11.9313C11.5176 12.7773 11.0921 13.7643 11.0921 14.8923C11.2339 16.1613 11.6594 17.4303 12.5105 18.5583C14.0707 20.8143 16.0565 22.6473 18.4678 23.7753C19.177 24.0573 19.7444 24.3393 20.4536 24.4803C21.1628 24.7623 21.872 24.7623 22.723 24.6213C23.7159 24.4803 24.567 23.7753 25.1343 22.9293C25.418 22.3653 25.418 21.8013 25.2762 21.2373L24.7088 20.9553ZM28.2548 8.12426C22.723 2.62525 13.787 2.62525 8.25523 8.12426C3.71632 12.6363 2.86527 19.5453 5.98578 25.0443L4 32.2353L11.5176 30.2613C13.6452 31.3893 15.9147 31.9533 18.1841 31.9533C25.9854 31.9533 32.2264 25.7493 32.2264 17.9943C32.3682 14.3283 30.808 10.8033 28.2548 8.12426ZM24.4251 27.8643C22.5812 28.9923 20.4536 29.6973 18.1841 29.6973C16.0565 29.6973 14.0707 29.1333 12.2268 28.1463L11.8013 27.8643L7.40419 28.9923L8.53891 24.7623L8.25523 24.3393C4.85105 18.6993 6.55314 11.6493 12.0849 8.12426C17.6167 4.59925 24.7088 6.43225 28.113 11.7903C31.5172 17.2893 29.9569 24.4803 24.4251 27.8643Z"
                                fill="white" />
                        </svg>
                        Ajukan Partnership
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection