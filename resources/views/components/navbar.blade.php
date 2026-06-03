<nav x-data="{ open: false, sopOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
    class="top-0 left-0 z-50 fixed w-full transition-colors duration-300"
    :class="{ 'bg-gray-900/90 backdrop-blur-md': open, 'bg-white': scrolled && !open, 'bg-transparent': !scrolled && !open }">
    <div class="flex justify-between items-center p-4 px-6 md:px-16 w-full">
        <!-- Logo Section -->
        <div class="z-50 flex items-center gap-2 md:gap-4">
            <img src="{{ asset('assets/logo-hima-mini.webp') }}" alt="Logo HIMTI" class="h-12 md:h-18 object-bottom">
            <h3 class="font-semibold md:text-2xl leading-tight"
                :class="(scrolled && !open) ? 'text-gray-900' : 'text-white'">Himpunan Mahasiswa<br>D4 Teknik
                Informatika</h3>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-8" :class="(scrolled && !open) ? 'text-gray-900' : 'text-white'">
            <a href="/" class="hover:text-blue-300 text-xl transition">Home</a>
            <a href="/" class="hover:text-blue-300 text-xl transition">Tentang Kami</a>
            <a href="/" class="hover:text-blue-300 text-xl transition">Departemen</a>
            <a href="/" class="hover:text-blue-300 text-xl transition">Berita</a>
            <a href="/" class="hover:text-blue-300 text-xl transition">HIMTI Store</a>

            <!-- Dropdown for SOP -->
            <div class="relative" @click.away="sopOpen = false">
                <button @click="sopOpen = !sopOpen"
                    class="flex items-center gap-1 focus:outline-none hover:text-blue-300 text-xl transition">
                    SOP
                    <span :class="{'rotate-180': sopOpen}" class="transition-transform duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div x-show="sopOpen" style="display: none;" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="right-0 z-50 absolute bg-white shadow-lg mt-2 py-1 rounded-md w-48 text-gray-800">
                    <a href="#" class="block hover:bg-gray-100 px-4 py-2">Partnership</a>
                    <a href="#" class="block hover:bg-gray-100 px-4 py-2">Media Partner</a>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <button @click="open = !open" class="md:hidden z-50 focus:outline-none"
            :class="(scrolled && !open) ? 'text-gray-900' : 'text-white'">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg x-show="open" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" style="display: none;" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-full"
        class="md:hidden top-0 left-0 z-40 absolute flex flex-col justify-center items-center gap-6 bg-gray-900/95 backdrop-blur-lg w-full h-screen text-white text-2xl">
        <a href="/" class="hover:text-blue-400 transition" @click="open = false">Home</a>
        <a href="/" class="hover:text-blue-400 transition" @click="open = false">Tentang Kami</a>
        <a href="/" class="hover:text-blue-400 transition" @click="open = false">Departemen</a>
        <a href="/" class="hover:text-blue-400 transition" @click="open = false">Berita</a>
        <a href="/" class="hover:text-blue-400 transition" @click="open = false">HIMTI Store</a>

        <!-- Mobile Dropdown for SOP -->
        <div class="flex flex-col items-center">
            <button @click="sopOpen = !sopOpen"
                class="flex items-center gap-1 focus:outline-none hover:text-blue-400 transition">
                SOP
                <span :class="{'rotate-180': sopOpen}" class="transition-transform duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                        <path fill-rule="evenodd"
                            d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
            <div x-show="sopOpen" style="display: none;"
                class="flex flex-col items-center gap-4 mt-4 text-gray-300 text-xl">
                <a href="#" class="hover:text-white transition" @click="open = false">Partnership</a>
                <a href="#" class="hover:text-white transition" @click="open = false">Media Partner</a>
            </div>
        </div>
    </div>
</nav>