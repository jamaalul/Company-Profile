<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>NEWS - Teknik Informatika</title>
   <link rel="stylesheet" href="{{ asset('css/global.css') }}">
   <link rel="stylesheet" href="{{ asset('css/news/show.css') }}">
   <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body>
   @include('components.navbar')
    <section class="hero">
        <div class="overlay" style="background-image: url('{{ asset('images/news/medinfo.png') }}');">
            <div class="overlay-content">
                <h1>{{ $news->title }}</h1>
                <p>{{ $news->author->name }}</p>
                <p>{{ \Carbon\Carbon::parse($news->published_at)->translatedFormat('j F Y') }}</p>
            </div>
        </div>
   </section>
   <section class="content">
      <div class="info" data-aos="fade-up" data-aos-duration="1000">
         <h1>{{ $news['title'] }}</h1>
         <p class="date">{{ $news['published_at'] }}</p>
         <div class="body">
            @if($news->featured_image)
            <div class="mb-8 image-wrapper">
                <img src="{{ asset('storage/' . $news->featured_image) }}" 
                    alt="{{ $news->title }}" 
                    class="news-image">
            </div>
            <br>
            @endif
            <div class="text-gray-800 leading-relaxed">
                {!! nl2br(e($news->content)) !!}
            </div>
         </div>
      </div>
      <div class="additional">
         <h2 data-aos="zoom-in-down" data-aos-duration="1000">INFORMASI LAINNYA</h2>
         <div class="other-info">
            @foreach ($relatedNews as $related)
                <a href="{{ route('news.show', $related) }}">
                    
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
   @include('components.footer')

   <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('js/portal.js') }}"></script>
   <script>
      AOS.init();
   </script>
</body>
</html>