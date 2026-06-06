@extends('layouts.new-app')

@section('title', 'SOP Media Partner - Teknik Informatika')

@section('content')
   <section
      class="flex flex-col items-center bg-white-300 bg-cover bg-no-repeat lg:bg-center px-6 sm:px-10 lg:px-16 pt-24 lg:pt-28 pb-6 sm:pb-10 lg:pb-16 w-screen"
      style="background-image: url('{{ asset('images/about/mesh.webp') }}');">
      <div class="flex flex-col items-center gap-6 w-full max-w-5xl">
         <h1 class="font-bold text-white text-5xl lg:text-6xl text-center">STANDAR OPERASIONAL PROSEDUR</h1>
         <p class="w-full font-medium text-white/80 text-lg text-center text-balance">
            MEDIA PARTNER
         </p>
      </div>
   </section>

   <section class="flex flex-col items-center bg-white p-6 sm:p-10 lg:p-16 w-screen">
      <div class="flex flex-col items-center gap-10 w-full max-w-5xl">

         <div
            class="bg-zinc-100 shadow-sm hover:shadow-md border border-zinc-200 rounded-2xl w-full overflow-hidden transition-all duration-300">
            <div class="relative bg-zinc-200 w-full aspect-[4/3] lg:aspect-[16/9]">
               <iframe id="pdfIframe" src="{{ asset('documents/SOP-Medinfo.pdf') }}#page=1&view=FitH"
                  type="application/pdf" class="absolute inset-0 border-0 w-full h-full">
               </iframe>
            </div>
            <div
               class="flex sm:flex-row flex-col justify-between items-center gap-4 bg-white p-4 sm:p-6 border-zinc-200 border-t">
               <p class="text-zinc-600 text-sm sm:text-left text-center">
                  Jika dokumen PDF tidak dapat dimuat, Anda bisa mengunduh atau membukanya secara manual.
               </p>
               <a href="{{ asset('documents/SOP-Medinfo.pdf') }}" target="_blank"
                  class="inline-flex justify-center items-center bg-zinc-900 hover:bg-zinc-800 shadow-sm px-5 py-2.5 rounded-xl font-medium text-white text-sm whitespace-nowrap transition-colors duration-200">
                  Buka PDF Baru
               </a>
            </div>
         </div>

         <a href="https://wa.me/6281802546229"
            class="group inline-flex justify-center items-center gap-3 bg-[#25D366] hover:bg-[#1ebd5a] shadow-sm hover:shadow-md px-8 py-4 rounded-2xl font-semibold text-white transition-all hover:-translate-y-1 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
               class="size-6 group-hover:scale-110 transition-transform duration-300">
               <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.436-4.136-7.033-7.033l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
            </svg>
            Hubungi Kami via WhatsApp
         </a>
      </div>
   </section>
@endsection