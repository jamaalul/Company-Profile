<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<nav class="navbar-kustom">
    <a href="/">
        <div class="logo-container">
            <img src="/assets/logo_himpunan.png" alt="logo_himpunan">
            <img src="/assets/logo_kabinet.png" alt="logo_kabinet">
            <div class="brand-text">
                <h3>HIMA<br><b>TEKNIK INFORMATIKA</b></h3>
            </div>
        </div>
    </a>

    <input type="checkbox" id="mobile-menu-checkbox">
    <label for="mobile-menu-checkbox" class="hamburger">☰</label>

    <div class="menu-container">
        <a href="/news" class="menu">News</a>
        <a href="/coming" class="menu">About Us</a>
        
        {{-- INI BAGIAN YANG DIUBAH --}}
        <div class="menu-item-has-dropdown">
            <p class="menu sop-toggle">SOP<img class="toggle-img" src="{{ asset('assets/arrow.svg') }}"></p>
            {{-- Submenu SOP sekarang ada di dalam sini --}}
            <div class="sub-menu sop-menu">
                <a href="https://wa.me/6281927833334" class="border-bottom">Partnership</a>
                <a href="/sop/medinfo">Media Partner</a>
            </div>
        </div>

        {{-- INI BAGIAN YANG DIUBAH --}}
        <div class="menu-item-has-dropdown">
            <p class="menu features-toggle">Features <img class="toggle-img" src="{{ asset('assets/arrow.svg') }}"></p>
            {{-- Submenu Features sekarang ada di dalam sini --}}
            <div class="sub-menu features-menu">
                <a href="/coming" class="border-bottom">Berkas</a>
                <a href="/marketplace" class="border-bottom">Marketplace</a>
                <a href="/portal">Portal</a>
            </div>
        </div>
    </div>
</nav>

<script src="{{ asset('js/navbar.js') }}"></script>