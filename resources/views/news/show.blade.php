@extends('layouts.new-app')

@section('title', $news->title)

@section('meta')
    <meta property="og:title" content="{{ $news->title }}" />
    <meta property="og:description" content="{{ $news->excerpt ?? Str::limit(strip_tags($news->content), 150) }}" />
    <meta property="og:image" content="{{ Str::startsWith($news->featured_image, 'http') ? $news->featured_image : url(Storage::url($news->featured_image)) }}" />
    <meta property="og:url" content="{{ route('news.show', $news->slug) }}" />
    <meta property="og:type" content="article" />
@endsection

@section('navbar_always_black')@endsection

@section('content')

    {{-- TITLE SECTION --}}
    <section
        class="flex flex-col items-center bg-white px-6 sm:px-10 lg:px-16 pt-24 lg:pt-28 pb-6 sm:pb-10 lg:pb-16 w-screen">
        <div class="flex flex-col gap-6 pt-6 w-full max-w-5xl">
            <div class="flex bg-blue-300 mx-auto px-3 py-2 rounded-full w-fit">
                <p class="font-medium text-white text-xs">
                    {{ $news->type === 'public' ? 'Berita Publik' : ($news->type === 'internal' ? 'Berita Internal' : 'Berita') }}
                </p>
            </div>
            <h1 class="font-bold text-4xl lg:text-5xl text-center text-balance">{{ $news->title }}</h1>
            <div class="flex gap-4 mx-auto">
                <p class="text-zinc-600 text-sm">
                    {{ $news->published_at ? $news->published_at->translatedFormat('d F Y') : '' }}
                </p>
                <p class="text-zinc-600 text-sm">
                    \
                </p>
                <p class="text-zinc-600 text-sm">
                    {{ $news->author->name }}
                </p>
            </div>
            <div class="rounded-2xl w-full aspect-video overflow-hidden">
                <img src="{{ Str::startsWith($news->featured_image, 'http') ? $news->featured_image : Storage::url($news->featured_image) }}"
                    alt="{{ $news->title }}" class="w-full h-full object-center object-cover">
            </div>
        </div>
    </section>

    {{-- CONTENT SECTION --}}
    <section class="flex flex-col items-center bg-white px-6 sm:px-10 lg:px-16 w-screen">
        <div class="mb-6 lg:mb-16 w-full max-w-5xl">
            <div class="max-w-none text-justify prose lg:prose-lg content">
                {!! $news->content !!}
            </div>
        </div>
    </section>

    {{-- RECOMMENDATION SECTION --}}
    @if($relatedNews->count() > 1)
        <section class="flex flex-col items-center bg-white p-8 sm:p-16 lg:p-24 w-screen">
            <div class="flex flex-col gap-4 lg:gap-6 w-full max-w-5xl">
                <h2 class="font-bold text-2xl">Baca juga</h2>
                <div class="flex flex-col gap-8 lg:gap-6 w-full max-w-5xl">
                    @foreach ($relatedNews as $new)
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
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection