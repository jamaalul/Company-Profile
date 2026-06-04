@extends('layouts.new-app')

@section('content')

    {{-- HERO SECTION --}}
    <section class="relative w-screen h-screen md:h-fit overflow-x-hidden">
        <img src="{{ asset('images/about/mesh.webp') }}" alt="Mesh gradient" class="top-0 left-0 absolute w-full">
        <div
            class="z-10 relative flex flex-col justify-end items-center px-6 sm:px-10 lg:px-16 pt-32 md:pt-24 pb-0 w-full lg:h-screen overflow-hidden">
            <h1 class="relative font-bold text-white text-5xl lg:text-6xl text-center">
                KABINET <span class="text-[#578FCE]">AKSENTRA</span>
                <img src="{{ asset('images/about/logo.webp') }}" alt="Logo Aksentra"
                    class="-top-5 -right-8 absolute size-16">
            </h1>
            <p class="mt-2 text-white text-lg text-center text-balance">"Sinergi satu arah, Identitas dalam karya."</p>
            <img src="{{ asset('images/about/kadep-kadep.webp') }}" alt="Kadep-kadep" class="mt-auto w-full max-w-4xl">
        </div>
        <div class="flex flex-col items-center px-6 sm:px-10 lg:px-16 pt-0 pb-6 sm:pb-10 lg:pb-16 w-screen lg:h-[36rem]">
            <div
                class="gap-2 grid grid-cols-1 lg:grid-cols-3 grid-rows-3 lg:grid-rows-1 bg-gradient-to-b from-black/20 to-blue-300/20 lg:to-white/20 shadow-sm backdrop-blur-sm p-2 border border-white/28 rounded-2xl w-full max-w-4xl h-fit">
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

    {{-- TENTANG HIMTI SECTION --}}
    <section class="flex justify-center items-center gap-12 bg-white p-6 sm:p-10 lg:p-16 w-screen">
        <div class="flex lg:flex-row flex-col">
            <img src="{{ asset('assets/logo_himpunan.png') }}" alt="Logo HIMTI" class="size-96">
            <div class="flex flex-col justify-center gap-4 w-full max-w-2xl">
                <h2 class="mb-4 font-bold text-5xl lg:text-6xl">Tentang HIMTI</h2>
                <p class="font-medium text-zinc-600 text-lg">
                    HIMTI UNAIR adalah organisasi kemahasiswaan yang menghimpun seluruh mahasiswa Teknik Informatika.
                    Melalui berbagai program kerja, kami membangun lingkungan yang kondusif untuk belajar, berkarya, dan
                    berkembang bersama.
                </p>
                <p class="font-medium text-zinc-600 text-lg">
                    Kabinet Aksentra hadir dengan semangat sinergi dan identitas dalam setiap karya menjadi motor penggerak
                    inovasi dan kolaborasi di lingkungan kampus maupun luar kampus.
                </p>
            </div>
        </div>
    </section>

    {{-- VISI SECTION --}}
    <section class="flex flex-col justify-center items-center gap-12 bg-white p-6 sm:p-10 lg:p-16 w-screen">
        <h2 class="font-bold text-[#578FCE] text-5xl lg:text-6xl text-center">VISI</h2>
        <div class="flex bg-[#578FCE] p-4 lg:p-12 rounded-2xl w-full max-w-4xl">
            <p class="font-medium text-white text-lg lg:text-xl text-justify">
                Mewujudkan HIMTI yang solid melalui keseimbangan antara sinergi internal dan eksternal, menumbuhkan semangat
                progresif dalam inovasi, serta menghadirkan dampak nyata bagi dunia teknologi dan masyarakat, dengan moral
                dan nilai-nilai keagamaan sebagai landasan integritas, etika, dan tanggung jawab sosial.
            </p>
        </div>
    </section>

    {{-- MISI SECTION DESKTOP --}}
    <section
        class="hidden lg:flex flex-col justify-center items-center bg-[linear-gradient(180deg,#163C80_80%,#ffffff_95%)] p-6 sm:p-10 lg:p-16 w-screen lg:min-h-screen">
        <div class="flex justify-between w-full max-w-5xl h-96">
            <div class="flex flex-col justify-between w-full lg:w-72 h-full">
                <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full">
                    <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">1</h1>
                    <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                        Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat
                        budaya sinergi di lingkungan HIMTI.
                    </p>
                </div>
                <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full">
                    <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">2</h1>
                    <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                        Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat
                        budaya sinergi di lingkungan HIMTI.
                    </p>
                </div>
            </div>
            <img src="{{ asset('images/about/logo-kabinet-colorful.webp') }}" alt="Logo Aksentra"
                class="h-80 aspect-square">
            <div class="flex flex-col-reverse justify-between w-full lg:w-72 h-full">
                <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full">
                    <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">4</h1>
                    <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                        Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat
                        budaya sinergi di lingkungan HIMTI.
                    </p>
                </div>
                <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full">
                    <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">5</h1>
                    <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                        Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat
                        budaya sinergi di lingkungan HIMTI.
                    </p>
                </div>
            </div>
        </div>
        <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full lg:w-72">
            <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">3</h1>
            <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat budaya
                sinergi di lingkungan HIMTI.
            </p>
        </div>
    </section>

    {{-- MISI SECTION NON-DESKTOP --}}
    <section class="lg:hidden flex flex-col gap-6 bg-[linear-gradient(180deg,#163C80_80%,#ffffff_95%)] p-6 sm:p-10 lg:p-16">
        <div class="p-12 w-full">
            <img src="{{ asset('images/about/logo-kabinet-colorful.webp') }}" alt="Logo Aksentra" class="aspect-square">
        </div>
        <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full">
            <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">1</h1>
            <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat
                budaya sinergi di lingkungan HIMTI.
            </p>
        </div>
        <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full">
            <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">2</h1>
            <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat
                budaya sinergi di lingkungan HIMTI.
            </p>
        </div>
        <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full">
            <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">3</h1>
            <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat
                budaya sinergi di lingkungan HIMTI.
            </p>
        </div>
        <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full">
            <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">4</h1>
            <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat
                budaya sinergi di lingkungan HIMTI.
            </p>
        </div>
        <div class="flex items-center bg-gradient-to-b from-[#FEFDD0] to-[#8CA9FF] px-4 py-6 rounded-2xl w-full">
            <h1 class="mr-1 font-bold tabular-nums text-[#163C80] text-8xl">5</h1>
            <p class="w-full font-semibold text-[#163C80] text-xs text-justify">
                Membangun pondasi organisasi yang solid melalui transparansi dan profesionalisme, serta memperkuat
                budaya sinergi di lingkungan HIMTI.
            </p>
        </div>
    </section>

    {{-- FILOSOFI LOGO SECTION --}}
    <section
        class="flex flex-col items-center gap-12 bg-[linear-gradient(181deg,#ffffff_0%,#82A5D0_40%,#82A5D0_100%)] lg:bg-[linear-gradient(181deg,#ffffff_0%,#82A5D0_40%,#82A5D0_60%,#ffffff_100%)] mt-8 p-6 sm:p-10 lg:p-16 w-screen min-h-screen">
        <div class="flex gap-4 w-full max-w-6xl">
            <div class="flex flex-col flex-1 gap-2 pt-2">
                <p class="font-bold text-[#82A5D0] text-xl">FILOSOFI</p>
                <div class="bg-[#82A5D0] w-full h-3"></div>
            </div>
            <h1 class="font-bold text-[#82A5D0] text-8xl">LOGO</h1>
        </div>
        <div class="flex flex-1 w-full max-w-6xl">
            <div class="flex lg:flex-row flex-col justify-center items-center gap-18">
                <div class="w-full max-w-[32rem]">
                    <img src="{{ asset('images/about/logo-philo.webp') }}" alt="Logo Aksentra">
                </div>
                <div class="flex flex-col flex-1 gap-6 w-full">
                    <div>
                        <img src="{{ asset('images/about/aksentra-title.webp') }}" alt="Aksentra" class="h-24">
                    </div>
                    <p class="font-medium text-white text-lg">
                        Logo AKSENTRA merepresentasikan HIMTI sebagai sentra (pusat) pergerakan, kolaborasi, dan
                        pengembangan potensi mahasiswa Teknik Informatika. Logo ini menggabungkan elemen manusia, teknologi,
                        dan arah yang menyatu dalam satu sistem terintegrasi, mencerminkan identitas organisasi yang
                        berkarakter, progresif, serta berlandaskan nilai integritas dan tanggung jawab sosial. Setiap unsur
                        visual dalam logo melambangkan sinergi antara individu dan teknologi yang bergerak harmonis menuju
                        tujuan bersama.
                    </p>
                    <p class="font-semibold text-[#FFFEBD] text-2xl">
                        Sinergi satu arah, Identitas dalam karya
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection