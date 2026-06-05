@extends('layouts.new-app')

@section('content')
   <section
      class="flex flex-col items-center bg-white-300 bg-cover bg-no-repeat lg:bg-center px-6 sm:px-10 lg:px-16 pt-24 lg:pt-28 pb-6 sm:pb-10 lg:pb-16 w-screen"
      style="background-image: url('{{ asset('images/about/mesh.webp') }}');">
      <div class="flex flex-col items-center gap-6 w-full max-w-5xl">
         <h1 class="font-bold text-white text-5xl lg:text-6xl">PORTAL HIMTI</h1>
         <p class="w-full text-white/80 text-lg text-center text-balance">
            Pusat informasi resmi Himpunan Mahasiswa D4 Teknik Informatika Universitas Airlangga. Lomba, beasiswa,
            workshop, dan peluang pengembangan diri, semua dalam satu tempat.
         </p>
         @if($firstNews)
            <a href="{{ route('portal.show', $firstNews->slug) }}"
               class="group relative flex flex-col justify-end bg-gray-200 rounded-2xl h-[32rem] overflow-hidden">
               @if($firstNews->featured_image)
                  <img
                     src="{{ Str::startsWith($firstNews->featured_image, 'http') ? $firstNews->featured_image : Storage::url($firstNews->featured_image) }}"
                     alt="{{ $firstNews->title }}"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
               @else
                  <div class="absolute inset-0 bg-red-500 w-full h-full group-hover:scale-105 transition-transform duration-700">
                  </div>
               @endif
               <div class="z-10 relative flex flex-col justify-end gap-4 p-4 lg:p-8 h-full"
                  style="background: linear-gradient(to top, rgba(0,0,0,0.85), rgba(0,0,0,0.45) 50%, transparent);">
                  <span class="bg-blue-300 px-4 py-2 rounded-full w-fit">
                     <p class="font-medium text-white text-xs">
                        {{ $firstNews->type === 'public' ? 'Berita Publik' : ($firstNews->type === 'internal' ? 'Informasi Internal' : 'Berita') }}
                     </p>
                  </span>
                  <p class="text-white text-sm">
                     {{ $firstNews->published_at ? $firstNews->published_at->translatedFormat('d F Y') : '' }}
                  </p>
                  <h3 class="font-semibold text-white text-2xl lg:text-3xl">{{ $firstNews->title }}</h3>
                  <p class="text-white/80 text-sm line-clamp-2">
                     {{ $firstNews->excerpt }}
                  </p>
               </div>
            </a>
         @endif
      </div>
   </section>

   {{-- ALL NEWS SECTION --}}
   <section class="flex flex-col items-center bg-white p-6 sm:p-10 lg:p-16 w-screen">
      <h2 class="mb-6 w-full max-w-5xl font-bold text-4xl lg:5xl">Informasi lainnya</h2>
      <div class="flex flex-col gap-8 lg:gap-6 w-full max-w-5xl">
         @forelse ($news as $new)
            <a href="{{ route('portal.show', $new->slug) }}"
               class="flex lg:flex-row flex-col gap-1 bg-zinc-100 lg:bg-white hover:bg-zinc-100 rounded-xl w-full lg:h-36 overflow-hidden transition-all duration-300">
               <div class="w-full lg:w-auto lg:h-full aspect-2/1 lg:aspect-4/3">
                  <img
                     src="{{ Str::startsWith($new->featured_image, 'http') ? $new->featured_image : Storage::url($new->featured_image) }}"
                     alt="{{ $new->title }}" class="rounded-xl h-full object-center object-cover">
               </div>
               <div class="flex flex-col gap-1 p-4 w-full">
                  <div class="flex justify-between items-center mb-2 lg:mb-auto w-full">
                     <div class="bg-blue-300 px-3 py-2 rounded-full w-fit">
                        <p class="font-medium text-white text-xs">
                           {{ $new->type === 'public' ? 'Berita Publik' : ($new->type === 'internal' ? 'Informasi Internal' : 'Berita') }}
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
                  <h3 class="font-semibold text-zinc-700 text-xl">Belum Ada Informasi</h3>
                  <p class="max-w-sm text-zinc-500 text-sm">Belum ada informasi yang dipublikasikan. Silahkan
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