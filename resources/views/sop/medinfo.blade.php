<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>MEDIAPARTNER - Teknik Informatika</title>
   <link rel="stylesheet" href="{{ asset('css/global.css') }}">
   <link rel="stylesheet" href="{{ asset('css/sop.css') }}">
   <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body>
   @include('components.navbar')
   <section class="header">
      <h1 data-aos="zoom-out-down" data-aos-duration="1000">STANDAR OPERASIONAL PROSEDUR</h1>
   </section>
   <section class="content">
      <h2 data-aos="zoom-out" data-aos-duration="1000">MEDIA PARTNER</h2>
      
      <div class="pdf-viewer" data-aos="fade-up" data-aos-duration="1000">
         <div class="pdf-container">
            {{-- Mengubah parameter zoom menjadi view=FitH agar pas dengan lebar --}}
            <iframe id="pdfIframe" 
                    src="{{ asset('documents/SOP-Medinfo.pdf') }}#page=1&view=FitH" 
                    type="application/pdf">
            </iframe>
         </div>
         <p class="pdf-fallback">
            <a href="{{ asset('documents/SOP-Medinfo.pdf') }}" target="_blank">
               Buka PDF dalam tab baru
            </a>
         </p>
      </div>
      <a href="https://wa.me/6281231830086"><button>Hubungi Kami</button></a>
   </section>
      
   @include('components.footer')

   <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
   <script>
      AOS.init();
   </script>
</body>
</html>