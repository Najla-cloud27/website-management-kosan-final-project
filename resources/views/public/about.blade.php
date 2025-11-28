@extends('layouts.public')

@section('title', 'Tentang Kami - Kosan DiriQ')

@section('content')

<!-- Breadcrumb Section -->
<div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('travo/img/breadcrumb/01.jpg') }}');">
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Tentang Kami</h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li>Tentang Kami</li>
            </ul>
        </div>
    </div>
</div>

<!-- About Section -->
<section class="about-section section-padding fix">
    <div class="container">
        <div class="about-wrapper">
            <div class="row g-4">
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="about-left-image">
                        <img src="https://via.placeholder.com/300x400/2196F3/ffffff?text=Kosan+DiriQ" alt="Kosan DiriQ" class="wow img-custom-anim-left">
                        <div class="about-image-2">
                            <img src="https://via.placeholder.com/300x250/1976D2/ffffff?text=Kamar+Nyaman" alt="Kamar Nyaman" class="wow img-custom-anim-left">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="about-content">
                        <div class="section-title">
                            <span class="sub-title wow fadeInUp">
                                Kami Peduli Dengan Kenyamanan Anda
                            </span>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                Hunian Nyaman untuk <br> Masa Depan Cerah Anda
                            </h2>
                        </div>
                        <p class="mt-4 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                            Kosan DiriQ adalah solusi hunian terbaik untuk mahasiswa dan pekerja profesional. Kami menyediakan kamar kosan dengan fasilitas lengkap, keamanan terjamin 24 jam, dan lokasi strategis yang dekat dengan kampus dan pusat bisnis.
                        </p>
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            Dengan pengalaman lebih dari 5 tahun, kami berkomitmen memberikan pelayanan terbaik dan menciptakan lingkungan yang nyaman seperti rumah sendiri.
                        </p>
                        <div class="about-button wow fadeInUp" data-wow-delay=".7s">
                            <a href="{{ route('rooms.index') }}" class="theme-btn">
                                Lihat Kamar Tersedia 
                                <img src="{{ asset('travo/img/icon/white-arrow.svg') }}" alt="arrow">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="about-right-image">
                        <img src="https://via.placeholder.com/300x400/1565C0/ffffff?text=Fasilitas+Lengkap" alt="Fasilitas Lengkap" class="wow img-custom-anim-right">
                        <div class="about-image-2">
                            <img src="https://via.placeholder.com/300x250/0D47A1/ffffff?text=Lokasi+Strategis" alt="Lokasi Strategis" class="wow img-custom-anim-right">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Achievement Section -->
<section class="achievement-section section-padding fix pb-0">
    <div class="shape-top">
        <img src="{{ asset('travo/img/shape/random-top.png') }}" alt="shape">
    </div>
    <div class="shape-bottom">
        <img src="{{ asset('travo/img/shape/random-bottom.png') }}" alt="shape">
    </div>
    <div class="container">
        <div class="section-title-area">
            <div class="section-title mb-0">
                <span class="sub-title wow fadeInUp text-white">
                    Pencapaian Kami
                </span>
                <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">
                    Kepercayaan Dan Kepuasan <br>
                    Penghuni Adalah Prioritas Kami
                </h2>
            </div>
            <div class="achievement-button wow fadeInUp" data-wow-delay=".7s">
                <a href="{{ route('contact') }}" class="theme-btn">
                    Hubungi Kami
                    <img src="{{ asset('travo/img/icon/white-arrow.svg') }}" alt="arrow">
                </a>
            </div>
        </div>
        <div class="achievement-wrapper">
            <div class="row">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="achievement-items">
                        <div class="content">
                            <div class="icon">
                                <i class="fa-solid fa-users" style="font-size: 48px; color: #2196F3;"></i>
                            </div>
                            <h3 class="number">
                                <span class="count">500</span>+
                            </h3>
                            <h5>Penghuni Puas</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="achievement-items">
                        <div class="content">
                            <div class="icon">
                                <i class="fa-solid fa-door-open" style="font-size: 48px; color: #2196F3;"></i>
                            </div>
                            <h3 class="number"><span class="count">50</span>+</h3>
                            <h5>Kamar Tersedia</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="achievement-items">
                        <div class="content">
                            <div class="icon">
                                <i class="fa-solid fa-star" style="font-size: 48px; color: #2196F3;"></i>
                            </div>
                            <h3 class="number"><span class="count">4.9</span>/5</h3>
                            <h5>Rating Kepuasan</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                    <div class="achievement-items">
                        <div class="content">
                            <div class="icon">
                                <i class="fa-solid fa-award" style="font-size: 48px; color: #2196F3;"></i>
                            </div>
                            <h3 class="number">
                                <span class="count">5</span>+
                            </h3>
                            <h5>Tahun Pengalaman</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="choose-us-section section-padding fix section-bg">
    <div class="left-shape float-bob-x">
        <img src="{{ asset('travo/img/shape/plane-3.png') }}" alt="shape">
    </div>
    <div class="dot-shape">
        <img src="{{ asset('travo/img/shape/dot-1.png') }}" alt="shape">
    </div>
    <div class="right-shape">
        <img src="{{ asset('travo/img/choose-us/shape1.png') }}" alt="shape">
    </div>
    <div class="container">
        <div class="choose-us-wrapper">
            <div class="row g-4">
                <div class="col-xl-7 col-lg-6">
                    <div class="chose-us-image">
                        <img src="https://via.placeholder.com/600x450/2196F3/ffffff?text=Kamar+Kosan+DiriQ" alt="Kosan DiriQ" class="wow img-custom-anim-left">
                        <div class="chose-us-image2">
                            <img src="https://via.placeholder.com/250x200/1976D2/ffffff?text=Fasilitas+Umum" alt="Fasilitas">
                        </div>
                        <div class="chose-us-image3">
                            <img src="https://via.placeholder.com/250x200/1565C0/ffffff?text=Area+Bersama" alt="Area Bersama">
                            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="video-btn ripple video-popup">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="choose-us-content">
                        <div class="section-title mb-0">
                            <span class="sub-title wow fadeInUp">
                                Mengapa Memilih Kami
                            </span>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                Dapatkan Pengalaman Hunian Terbaik
                            </h2>
                        </div>
                        <div class="choose-us-area">
                            <div class="line-image">
                                <img src="{{ asset('travo/img/shape/line-shape.png') }}" alt="line">
                            </div>
                            <div class="choose-us-items wow fadeInUp" data-wow-delay=".2s">
                                <h3 class="number">01</h3>
                                <div class="content">
                                    <h4>Fasilitas Lengkap & Modern</h4>
                                    <p>Semua kamar dilengkapi dengan WiFi cepat, AC, kamar mandi dalam, dan furniture berkualitas untuk kenyamanan maksimal Anda.
                                    </p>
                                </div>
                            </div>
                            <div class="choose-us-items wow fadeInUp" data-wow-delay=".3s">
                                <h3 class="number">02</h3>
                                <div class="content">
                                    <h4>Keamanan 24 Jam Terjamin</h4>
                                    <p>Sistem keamanan canggih dengan CCTV dan petugas keamanan yang siaga 24 jam untuk melindungi Anda dan barang berharga Anda.
                                    </p>
                                </div>
                            </div>
                            <div class="choose-us-items wow fadeInUp mb-0" data-wow-delay=".5s">
                                <h3 class="number">03</h3>
                                <div class="content">
                                    <h4>Lokasi Strategis & Terjangkau</h4>
                                    <p>Dekat dengan kampus, pusat perbelanjaan, dan transportasi umum. Harga sewa yang kompetitif dengan kualitas terbaik.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="service-section section-padding fix">
    <div class="container">
        <div class="section-title text-center">
            <span class="sub-title wow fadeInUp">
                Nilai-Nilai Kami
            </span>
            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                Komitmen Kami Kepada Anda
            </h2>
        </div>
        <div class="row g-4">
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                <div class="service-card-items">
                    <div class="icon">
                        <i class="fa-solid fa-handshake" style="font-size: 48px; color: #2196F3;"></i>
                    </div>
                    <div class="content">
                        <h4>
                            <a href="{{ route('rooms.index') }}">Pelayanan Prima</a>
                        </h4>
                        <p>
                            Kami selalu siap membantu Anda dengan respon cepat dan solusi terbaik untuk setiap kebutuhan penghuni.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="service-card-items">
                    <div class="icon">
                        <i class="fa-solid fa-heart" style="font-size: 48px; color: #2196F3;"></i>
                    </div>
                    <div class="content">
                        <h4>
                            <a href="{{ route('rooms.index') }}">Kenyamanan Seperti Rumah</a>
                        </h4>
                        <p>
                            Kami menciptakan suasana yang hangat dan nyaman agar Anda merasa di rumah sendiri saat jauh dari keluarga.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                <div class="service-card-items">
                    <div class="icon">
                        <i class="fa-solid fa-shield" style="font-size: 48px; color: #2196F3;"></i>
                    </div>
                    <div class="content">
                        <h4>
                            <a href="{{ route('rooms.index') }}">Transparansi & Kepercayaan</a>
                        </h4>
                        <p>
                            Tidak ada biaya tersembunyi. Semua informasi jelas dan transparan untuk kenyamanan transaksi Anda.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".8s">
                <div class="service-card-items">
                    <div class="icon">
                        <i class="fa-solid fa-leaf" style="font-size: 48px; color: #2196F3;"></i>
                    </div>
                    <div class="content">
                        <h4>
                            <a href="{{ route('rooms.index') }}">Lingkungan Bersih & Sehat</a>
                        </h4>
                        <p>
                            Kebersihan adalah prioritas. Area kosan dijaga kebersihannya setiap hari untuk kesehatan penghuni.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="1s">
                <div class="service-card-items">
                    <div class="icon">
                        <i class="fa-solid fa-comments" style="font-size: 48px; color: #2196F3;"></i>
                    </div>
                    <div class="content">
                        <h4>
                            <a href="{{ route('rooms.index') }}">Komunitas Positif</a>
                        </h4>
                        <p>
                            Kami memfasilitasi interaksi antar penghuni untuk menciptakan lingkungan sosial yang positif dan suportif.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="1.2s">
                <div class="service-card-items">
                    <div class="icon">
                        <i class="fa-solid fa-lightbulb" style="font-size: 48px; color: #2196F3;"></i>
                    </div>
                    <div class="content">
                        <h4>
                            <a href="{{ route('rooms.index') }}">Inovasi Berkelanjutan</a>
                        </h4>
                        <p>
                            Kami terus berinovasi untuk meningkatkan kualitas layanan dan fasilitas demi kepuasan penghuni.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section cta-2 bg-cover" style="background-image: url('{{ asset('travo/img/cta-bg.jpg') }}');">
    <div class="container">
        <div class="cta-wrapper">
            <div class="row g-4 align-items-center justify-content-between">
                <div class="col-xl-7 col-lg-6">
                    <div class="section-title mb-0">
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">
                            Siap Menemukan Kamar Kosan Impian Anda?
                        </h2>
                        <p class="text-white mt-3 wow fadeInUp" data-wow-delay=".5s">
                            Bergabunglah dengan ratusan penghuni yang telah merasakan kenyamanan tinggal di Kosan DiriQ. 
                            Hubungi kami sekarang untuk informasi lebih lanjut atau langsung booking kamar pilihan Anda!
                        </p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="cta-button text-lg-end wow fadeInUp" data-wow-delay=".7s">
                        <a href="{{ route('rooms.index') }}" class="theme-btn">
                            Lihat Kamar Tersedia
                            <img src="{{ asset('travo/img/icon/white-arrow.svg') }}" alt="arrow">
                        </a>
                        <a href="{{ route('contact') }}" class="theme-btn" style="background: #fff; color: #2196F3; margin-left: 15px;">
                            <i class="fa-solid fa-phone"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Counter Animation
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.count');
        const speed = 200;

        counters.forEach(counter => {
            const updateCount = () => {
                const target = parseFloat(counter.innerText);
                const count = parseFloat(counter.getAttribute('data-count') || 0);
                const inc = target / speed;

                if (count < target) {
                    counter.setAttribute('data-count', Math.ceil(count + inc));
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }
            };

            // Start counter when in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCount();
                        observer.unobserve(entry.target);
                    }
                });
            });

            observer.observe(counter);
        });
    });
</script>
@endpush
