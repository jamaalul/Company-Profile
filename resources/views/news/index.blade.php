@extends('layouts.new-app')

@section('content')

    {{-- LATEST NEWS SECTION --}}
    @if ($firstNews)
        <section class="bg-zinc-300 bg-cover bg-center w-screen h-96 lg:h-[80vh]"
            style="background-image: url('{{ Str::startsWith($firstNews->featured_image, 'http') ? $firstNews->featured_image : asset('storage/' . $firstNews->featured_image) }}');">
            <div class="z-10 relative flex flex-col justify-end items-center gap-4 px-6 sm:px-10 lg:px-16 pt-24 lg:pt-28 pb-6 sm:pb-10 lg:pb-16 h-full"
                style="background: linear-gradient(to top, rgba(0,0,0,0.85), rgba(0,0,0,0.45) 50%, transparent);">
                <div class="flex flex-col justify-end gap-4 w-full max-w-5xl">
                    <div class="flex justify-between items-center w-full">
                        <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
                            <p class="font-medium text-white text-xs">
                                {{ $firstNews->type === 'public' ? 'Berita Publik' : ($firstNews->type === 'internal' ? 'Berita Internal' : 'Berita') }}
                            </p>
                        </span>
                        <p class="text-white text-sm">
                            {{ $firstNews->published_at ? $firstNews->published_at->translatedFormat('d F Y') : '' }}
                        </p>
                    </div>
                    <h3 class="font-semibold text-white text-2xl lg:text-5xl">{{ $firstNews->title }}</h3>
                    <p class="text-white/80 text-sm line-clamp-2">
                        {{ $firstNews->excerpt }}
                    </p>
                    <a href="{{ route('news.show', $firstNews->slug) }}"
                        class="flex justify-center items-center gap-2 bg-white/10 hover:bg-white/20 hover:shadow-lg backdrop-blur-sm px-6 py-3 border border-white/28 rounded-lg w-fit font-medium text-white text-sm transition-all hover:-translate-y-1 duration-300 transform">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd"
                                    d="M2 3.5A1.5 1.5 0 0 1 3.5 2h9A1.5 1.5 0 0 1 14 3.5v11.75A2.75 2.75 0 0 0 16.75 18h-12A2.75 2.75 0 0 1 2 15.25V3.5Zm3.75 7a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5Zm0 3a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5ZM5 5.75A.75.75 0 0 1 5.75 5h4.5a.75.75 0 0 1 .75.75v2.5a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 5 8.25v-2.5Z"
                                    clip-rule="evenodd" />
                                <path d="M16.5 6.5h-1v8.75a1.25 1.25 0 1 0 2.5 0V8a1.5 1.5 0 0 0-1.5-1.5Z" />
                            </svg>
                        </span>
                        Baca berita
                    </a>
                </div>
            </div>
        </section>
    @else
        {{-- Empty state: no featured news --}}
        <section class="flex flex-col justify-center items-center bg-zinc-300 pt-24 lg:pt-28 w-screen h-96 lg:h-[80vh]">
            <div class="flex flex-col items-center gap-4 px-6 text-center">
                <div class="flex justify-center items-center bg-zinc-200 rounded-full w-20 h-20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-10 text-zinc-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>
                </div>
                <h2 class="font-semibold text-zinc-700 text-2xl lg:text-3xl">Belum Ada Berita Unggulan</h2>
                <p class="max-w-sm text-zinc-500 text-sm">Saat ini belum ada berita unggulan yang dipublikasikan. Pantau terus
                    halaman ini untuk update terbaru.</p>
            </div>
        </section>
    @endif

    {{-- ALL NEWS SECTION --}}
    <section class="flex flex-col items-center bg-white p-6 sm:p-10 lg:p-16 w-screen">
        <h2 class="mb-6 w-full max-w-5xl font-bold text-4xl lg:5xl">Kegiatan & Berita HIMTI</h2>
        <div class="flex flex-col gap-8 lg:gap-6 w-full max-w-5xl">
            @forelse ($news as $new)
                <a href="{{ route('news.show', $new->slug) }}"
                    class="flex lg:flex-row flex-col gap-1 bg-zinc-100 lg:bg-white hover:bg-zinc-100 rounded-xl w-full lg:h-36 overflow-hidden transition-all duration-300">
                    <div class="w-full lg:w-auto lg:h-full aspect-2/1 lg:aspect-4/3">
                        <img src="{{ Str::startsWith($new->featured_image, 'http') ? $new->featured_image : Storage::url($new->featured_image) }}"
                            alt="{{ $new->title }}" class="rounded-xl h-full object-center object-cover">
                    </div>
                    <div class="flex flex-col gap-1 p-4 w-full">
                        <div class="flex justify-between items-center mb-2 lg:mb-auto w-full">
                            <div class="bg-blue-300 px-3 py-2 rounded-full w-fit">
                                <p class="font-medium text-white text-xs">
                                    {{ $new->type === 'public' ? 'Berita Publik' : ($new->type === 'internal' ? 'Berita Internal' : 'Berita') }}
                                </p>
                            </div>
                            <p class="text-zinc-600 text-sm">
                                {{ $new->published_at ? $new->published_at->translatedFormat('d F Y') : '' }}
                            </p>
                        </div>
                        <h3 class="font-semibold text-xl lg:text-2xl line-clamp-2">
                            {{ $new->title }}
                        </h3>
                        <p class="text-zinc-600 text-xs line-clamp-2">
                            {{ $new->excerpt }}
                        </p>
                    </div>
                </a>
            @empty
                {{-- Empty state: no news articles --}}
                <div class="flex flex-col items-center gap-4 py-16 text-center">
                    <div class="flex justify-center items-center bg-zinc-100 rounded-full w-20 h-20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-10 text-zinc-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1">
                        <h3 class="font-semibold text-zinc-700 text-xl">Belum Ada Berita</h3>
                        <p class="max-w-sm text-zinc-500 text-sm">Belum ada berita atau kegiatan yang dipublikasikan. Silakan
                            kunjungi kembali nanti.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if ($news->hasPages())
            <div class="flex justify-center mt-10 w-full max-w-5xl">
                <nav class="flex items-center gap-1" aria-label="Pagination">
                    {{-- Previous --}}
                    @if ($news->onFirstPage())
                        <span
                            class="inline-flex justify-center items-center px-3 py-2 rounded-lg w-10 h-10 text-zinc-300 cursor-not-allowed select-none"
                            aria-disabled="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $news->previousPageUrl() }}"
                            class="inline-flex justify-center items-center hover:bg-zinc-100 px-3 py-2 rounded-lg w-10 h-10 text-zinc-600 hover:text-zinc-900 transition-colors duration-200"
                            aria-label="Previous page">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($news->links()->offsetGet('elements') as $element)
                        @if (is_string($element))
                            <span class="inline-flex justify-center items-center w-10 h-10 text-zinc-400 select-none">
                                &hellip;
                            </span>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $news->currentPage())
                                    <span
                                        class="inline-flex justify-center items-center bg-blue-300 rounded-lg w-10 h-10 font-semibold text-white text-sm"
                                        aria-current="page">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="inline-flex justify-center items-center hover:bg-zinc-100 rounded-lg w-10 h-10 text-zinc-600 hover:text-zinc-900 text-sm transition-colors duration-200">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if ($news->hasMorePages())
                        <a href="{{ $news->nextPageUrl() }}"
                            class="inline-flex justify-center items-center hover:bg-zinc-100 px-3 py-2 rounded-lg w-10 h-10 text-zinc-600 hover:text-zinc-900 transition-colors duration-200"
                            aria-label="Next page">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    @else
                        <span
                            class="inline-flex justify-center items-center px-3 py-2 rounded-lg w-10 h-10 text-zinc-300 cursor-not-allowed select-none"
                            aria-disabled="true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
        @endif
    </section>
@endsection