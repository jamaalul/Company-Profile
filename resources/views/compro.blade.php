@extends('layouts.app')

@section('title', 'HIMTI - Teknik Informatika')

@section('content')
    <style>
    .animate,
    .animate-load {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.6s ease-out, transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .animate[data-anim="fade-in-up"],
    .animate-load[data-anim="fade-in-up"] {
        transform: translateY(30px);
    }

    .animate[data-anim="fade-in-left"],
    .animate-load[data-anim="fade-in-left"] {
        transform: translateX(-30px);
    }

    .animate[data-anim="fade-in-right"],
    .animate-load[data-anim="fade-in-right"] {
        transform: translateX(30px);
    }

    .animate.is-visible,
    .animate-load.is-visible {
        opacity: 1;
        transform: none;
        visibility: visible;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    @keyframes ripple-effect {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .hero .left button {
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hero .left button:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 123, 255, 0.2);
    }

    .hero .left button .ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.7);
        transform: scale(0);
        animation: ripple-effect 0.6s linear;
        pointer-events: none;
    }

    .flsfcards {
        cursor: pointer;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .flsfcards:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.12);
    }
    </style>
     <section class="hero -mt-6">
        <div class="left">
            <div>
                <h1 class="animate-load" data-anim="fade-in-left" data-delay="200">HIMPUNAN MAHASISWA<br>TEKNIK INFORMATIKA D4</h1>
                <p class="animate-load" data-anim="fade-in-left" data-delay="400">Kabinet Selaras</p>
                <button class="animate-load" data-anim="fade-in-up" data-delay="600">Tentang Kami</button>
            </div>
        </div>
        <div class="right animate-load" data-anim="fade-in">
            </div>
    </section>

    <section class="desc">
        <h3 class="animate" data-anim="fade-in-up">KABINET</h3>
        <h1 class="animate" data-anim="fade-in-up" data-delay="150">SELARAS</h1>
        <p class="motto animate" data-anim="fade-in" data-delay="300">"Bersatu dalam Kolaborasi untuk Inovasi"</p>

        <div class="desc-content">
            <div class="photoframe animate" data-anim="fade-in-right">
                <img src="/images/compro/compro_img4.png" alt="kadep" class="kadep">
            </div>
            <div class="textbox animate" data-anim="fade-in-left">
                <p>
                    Kabinet "Selaras" lahir dari keinginan untuk menciptakan harmoni antara inovasi dan kolaborasi.<br><br>
                    Kami percaya bahwa keseimbangan antara internal dan eksternal, strategi dan eksekusi, serta perkembangan individu dan kemajuan kolektif adalah kunci untuk membangun ekosistem yang kompetitif dan adaptif.
                </p>
                <img src="/assets/logo_kabinet_transparan.png" alt="logo_kabinet" class="logo_kabinet_desc">
            </div>
        </div>
    </section>

    <section class="vision-section">
        <div class="container">
            <div class="vision-title animate" data-anim="fade-in-left">
                <div class="subtitle">HIMTI</div>
                <h1 class="main-title">VISI</h1>
            </div>
            <div class="vision-content animate" data-anim="fade-in-right">
                <p class="vision-text">
                    HIMTI sebagai pusat pergerakan dan pengembangan mahasiswa, berkomitmen menjadi organisasi yang dikenal baik oleh masyarakat umum dan seluruh warga Fakultas Vokasi, serta membudayakan nilai-nilai integritas dan komitmen dalam berorganisasi.
                </p>
            </div>
        </div>
    </section>

    <section class="mission-section">
        <div class="container">
            <div class="mission-title animate" data-anim="fade-in-up">
                <div class="subtitle">HIMTI</div>
                <h1 class="main-title">MISI</h1>
            </div>
            <div class="mission-content">
                <p class="mission-text animate" data-anim="fade-in-up" data-delay="100">
                    Membangun dan memperkuat budaya komunikasi dalam organisasi, dengan memastikan bahwa setiap anggota terlibat aktif serta memiliki tanggung jawab, dan berkontribusi secara positif.
                </p>
                <p class="mission-text animate" data-anim="fade-in-up" data-delay="200">
                    Membangun citra positif HIMTI melalui berbagai kegiatan publik, menyebarkan dampak positif yang dihasilkan, serta memperkenalkan kontribusi organisasi kepada masyarakat umum dan seluruh komunitas akademik di Fakultas Vokasi.
                </p>
                <p class="mission-text animate" data-anim="fade-in-up" data-delay="300">
                    Melaksanakan program kerja berlandaskan profesionalitas dan berbasis kekeluargaan dalam berorganisasi dan bermasyarakat.
                </p>
            </div>
        </div>
    </section>

    <section id="filosofi">
        <div id="flsftop" class="animate" data-anim="fade-in-up">
            <p>FILOSOFI</p>
            <h1>LOGO</h1>
        </div>
        <div id="flsfbottom">
            <div id="flsfleft" class="animate" data-anim="fade-in-right" data-delay="200"></div>
            <div id="flsfright">
                <div class="flsfcards animate" data-anim="fade-in-up" data-delay="100">
                    <div class="cardtop">
                        <img src="/images/compro/compro_img6.jpg" alt="shape" id="shape">
                        <h3>Shapes &amp; Compositions</h3>
                    </div>
                    <div class="cardbottom">
                        <p>Melambangkan keseimbangan dan keselarasan dalam menjalankan organisasi, di mana setiap elemen bekerja bersama menuju tujuan yang sama.</p>
                    </div>
                </div>
                <div class="flsfcards animate" data-anim="fade-in-up" data-delay="200">
                     <div class="cardtop">
                        <img src="/images/compro/compro_img7.jpg" alt="shape" id="shape">
                        <h3>Colors</h3>
                    </div>
                    <div class="cardbottom">
                        <p>Merepresentasikan nilai-nilai yang diusung HIMTI 2025, seperti kebersamaan, inovasi, dan profesionalisme dalam setiap langkah yang diambil.</p>
                    </div>
                </div>
                <div class="flsfcards animate" data-anim="fade-in-up" data-delay="300">
                     <div class="cardtop">
                        <img src="/images/compro/compro_img8.jpg" alt="shape" id="shape">
                        <h3>Visual Elements</h3>
                    </div>
                    <div class="cardbottom">
                        <p>Setiap garis, bentuk, dan simbol dalam logo memiliki arti mendalam yang menggambarkan semangat “Beraksi dalam Kolaborasi untuk Inovasi”, di mana HIMTI tidak hanya bergerak maju, tetapi juga menciptakan dampak nyata bagi lingkungan sekitarnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection