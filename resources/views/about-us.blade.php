<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="DcSgQMfDWqjrilhei837tPvkhUIoKA12c0MdBmWl">
    <title>HIMTI - Teknik Informatika</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/css/common.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/css/about/style.css" rel="stylesheet">

</head>
<body>
    @include('components.navbar')
    <div class="himti-structure">
    <div class="background-pattern">
        <div class="pattern-right">
            <img src="http://127.0.0.1:8000/images/about/background-SELARAS.png" alt="Background pattern">
        </div>
    </div>

    <main class="container main-content">
        <section class="hero-section text-center mt-5" style="margin-top: 120px !important;" data-aos="fade-up">
            <h2 class="himti-subtitle">H I M T I</h2>
            <h1 class="struktur-title">STRUKTUR</h1>

            <div class="team-photo" data-aos="zoom-in" data-aos-delay="300">
                <img src="http://127.0.0.1:8000/images/about/KADEP-HIMTI.png" alt="HIMTI Structure Team" class="img-fluid">
            </div>
        </section>

        <section class="kahima-section" data-aos="fade-up">
            <div class="row">
                <div class="col-md-3" data-aos="fade-right" data-aos-delay="200">
                    <img src="http://127.0.0.1:8000/images/about/Kahima.png" alt="Muhammad Zaky" class="profile-image img-fluid">
                </div>
                <div class="col-md-9" data-aos="fade-left" data-aos-delay="300">
                    <h2 class="position-title">KAHIMA</h2>
                    <h3 class="person-name">Muhammad Zaky</h3>
                    <div class="profile-card">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consectetur odio sem, in pharetra turpis
                            faucibus in. Phasellus fringilla ultricies ullamcorper. Pellentesque gravida nisl nunc, id laoreet urna
                            pulvinar vel. Interdum et malesuada fames ac ante ipsum primis in faucibus. In dictum sit amet nunc vel
                            pharetra. Curabitur facilisis ex vitae blandit consectetur. Donec ut facilisis nisl, vitae pretium arcu.
                            In congue purus eleifend risus hendrerit, eu finibus lectus eleifend.
                        </p>
                        <p>
                            Nulla nec libero tortor. Fusce vehicula quam risus, nec tempus turpis luctus vel. Fusce eros diam,
                            porttitor vel ante dignissim, ullamcorper vehicula mi.
                        </p>
                        <p class="quote">kata kata dari kahima</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="wakahima-section" data-aos="fade-up">
            <div class="row">
                <div class="col-md-9" data-aos="fade-right" data-aos-delay="300">
                    <h2 class="position-title text-end">WAKAHIMA</h2>
                    <h3 class="person-name text-end">Fitria Indah Novitasari</h3>
                    <div class="profile-card">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consectetur odio sem, in pharetra turpis
                            faucibus in. Phasellus fringilla ultricies ullamcorper. Pellentesque gravida nisl nunc, id laoreet urna
                            pulvinar vel. Interdum et malesuada fames ac ante ipsum primis in faucibus. In dictum sit amet nunc vel
                            pharetra. Curabitur facilisis ex vitae blandit consectetur. Donec ut facilisis nisl, vitae pretium arcu.
                            In congue purus eleifend risus hendrerit, eu finibus lectus eleifend.
                        </p>
                        <p>
                            Nulla nec libero tortor. Fusce vehicula quam risus, nec tempus turpis luctus vel. Fusce eros diam,
                            porttitor vel ante dignissim, ullamcorper vehicula mi.
                        </p>
                        <p class="quote">kata kata dari wakahima</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-left" data-aos-delay="200">
                    <img src="http://127.0.0.1:8000/images/about/Wakahima.png" alt="Fitria Indah Novitasari" class="profile-image img-fluid">
                </div>
            </div>
        </section>

        <section class="programs-section" data-aos="fade-up">
            <h2 class="section-title text-center mb-5">DEPARTEMEN</h2>
            
            @if(isset($departments) && $departments->count() > 0)
                @foreach ($departments as $department)
                <div class="program-card mb-5" data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                    {{-- Menggunakan URL yang benar dengan slug --}}
                    <a href="{{ url('/about-us/' . $department->slug) }}" class="program-link">
                        <div class="row g-0">
                            <div class="col-md-4">
                                {{-- Menampilkan foto dari database --}}
                                <img src="{{ asset($department->leadership_photo) }}" alt="{{ $department->name }}" class="program-image">
                            </div>
                            <div class="col-md-8 d-flex align-items-center">
                                <div class="program-content">
                                    <div class="program-year">HIMTI 2025</div>
                                    {{-- Menampilkan nama dari database --}}
                                    <h3 class="program-title">{!! strtoupper($department->name) !!}</h3>
                                </div>
                                <div class="program-arrow">
                                    <i class="arrow-icon">›</i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <p class="text-center">Tidak ada departemen untuk ditampilkan.</p>
            @endif
            
        </section>

    </main>
</div>
    <div id="back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
        </svg>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="http://127.0.0.1:8000/js/main.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/portal.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('js/compro.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>

