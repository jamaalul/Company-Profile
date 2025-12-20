@extends('layouts.app')

@section('content')
   <link rel="stylesheet" href="{{ asset('css/portal/show.css') }}">
   <section class="hero">
      <div class="overlay"></div>
   </section>
   <section class="content">
      <div class="info" data-aos="fade-up" data-aos-duration="1000">
         <h1>{{ $news['title'] }}</h1>
         <p class="date">{{ $news['published_at'] }}</p>
         <div class="body">
            <div class="text-gray-800 leading-relaxed">
                {!! nl2br(e($news->content)) !!}
            </div>
         </div>
      </div>
      <div class="additional">
         <h2 data-aos="zoom-in-down" data-aos-duration="1000">INFORMASI LAINNYA</h2>
         <div class="other-info">
            @foreach ($relatedNews as $related)
                <a href="{{ route('portal.show', $related) }}">
                    
               <div class="info-card" data-aos="fade-up" data-aos-duration="1000">
                  <div class="top">
                     <h3>{{ $related['title'] }}</h3></div>
                  <div class="bottom">
                     {{-- <p>{!! \Illuminate\Support\Str::limit(strip_tags($related['excerpt']), 40, '...') !!}</p> --}}
                     <p class="date">{{ $related['published_at']->translatedFormat('j F Y') }}</p>
                  </div>
               </div>
               </a>
            @endforeach
         </div>
      </div>
   </section>
@endsection