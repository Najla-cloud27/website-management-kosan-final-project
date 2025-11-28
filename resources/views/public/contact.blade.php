@extends('layouts.public')

@section('title', 'Hubungi Kami - Kosan DiriQ')

@section('content')

<!-- Breadcrumb Section -->
<div class="breadcrumb-wrapper section-padding bg-cover" style="background-image: url('{{ asset('travo/img/breadcrumb/01.jpg') }}');">
    <div class="container">
        <div class="page-heading">
            <h1 class="wow fadeInUp" data-wow-delay=".3s">Hubungi Kami</h1>
            <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li>Hubungi Kami</li>
            </ul>
        </div>
    </div>
</div>

<!-- Contact Info Section -->
<section class="contact-info-section section-padding fix">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                <div class="info-items">
                    <div class="icon">
                        <i class="fa-solid fa-location-dot" style="font-size: 48px; color: #2196F3;"></i>
                    </div>
                    <h3>Alamat Kantor</h3>
                    <p>Jl. Contoh No. 123<br>Jakarta Selatan, 12345</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="info-items">
                    <div class="icon">
                        <i class="fa-solid fa-phone" style="font-size: 48px; color: #2196F3;"></i>
                    </div>
                    <h3>Hubungi Kami:</h3>
                    <p><a href="tel:+6281234567890">+62 812-3456-7890</a></p>
                    <p><a href="tel:+6281234567891">+62 812-3456-7891</a></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                <div class="info-items">
                    <div class="icon">
                        <i class="fa-solid fa-envelope" style="font-size: 48px; color: #2196F3;"></i>
                    </div>
                    <h3>Email Kami:</h3>
                    <p><a href="mailto:info@kosandiriq.com">info@kosandiriq.com</a></p>
                    <p><a href="mailto:support@kosandiriq.com">support@kosandiriq.com</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-section section-padding fix section-bg bg-cover" style="background-image: url('{{ asset('travo/img/contact/bg.png') }}');">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay=".2s">
                <div class="contact-wrapper">
                    <div class="section-title">
                        <span class="sub-title wow fadeInUp">
                            Hubungi Kami
                        </span>
                        <h2 class="wow fadeInUp" data-wow-delay=".3s">
                            Mari Diskusikan Kebutuhan Hunian Anda
                        </h2>
                    </div>
                    <p class="wow fadeInUp" data-wow-delay=".5s">
                        Kami siap membantu Anda menemukan kamar kosan yang sesuai dengan kebutuhan dan budget Anda. 
                        Tim kami akan merespons pertanyaan Anda dengan cepat dan profesional.
                    </p>
                    <div class="contact-thumb">
                        <img src="https://via.placeholder.com/500x300/2196F3/ffffff?text=Hubungi+Kosan+DiriQ" class="ex" alt="Contact">
                        <h4>
                            <img src="{{ asset('travo/img/icon/phone.svg') }}" alt="phone"> 
                            +62 812-3456-7890
                        </h4>
                    </div>

                    <!-- Social Media -->
                    <div class="contact-social mt-4">
                        <h5 class="mb-3">Ikuti Kami:</h5>
                        <div class="social-icons d-flex gap-3">
                            <a href="#" class="social-icon" style="width: 45px; height: 45px; background: #2196F3; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px;">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon" style="width: 45px; height: 45px; background: #2196F3; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px;">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="#" class="social-icon" style="width: 45px; height: 45px; background: #2196F3; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px;">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                            <a href="#" class="social-icon" style="width: 45px; height: 45px; background: #2196F3; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px;">
                                <i class="fa-brands fa-tiktok"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="contact-form style-2">
                    <h3>Isi Form Kontak</h3>
                    <p>Silakan isi form di bawah ini, kami tidak akan spam email Anda</p>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-clt">
                                    <input type="text" name="name" id="name" placeholder="Nama Lengkap *" value="{{ old('name') }}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-clt">
                                    <input type="tel" name="phone" id="phone" placeholder="No. Telepon *" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-clt">
                                    <input type="email" name="email" id="email" placeholder="Alamat Email *" value="{{ old('email') }}" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-clt">
                                    <input type="text" name="subject" id="subject" placeholder="Subjek" value="{{ old('subject') }}">
                                    @error('subject')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-clt">
                                    <textarea name="message" id="message" placeholder="Tulis pesan Anda *" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="theme-btn style-2">
                                    <i class="fa-solid fa-paper-plane"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<div class="map-section">
    <div class="map-items">
        <div class="googpemap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.89908392302!2d106.68942959999999!3d-6.2293867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Indonesia!5e0!3m2!1sen!2sid!4v1699999999999!5m2!1sen!2sid"
                style="border:0; width: 100%; height: 450px;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<section class="faq-section section-padding fix">
    <div class="container">
        <div class="section-title text-center">
            <span class="sub-title wow fadeInUp">
                Pertanyaan Umum
            </span>
            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                Pertanyaan Yang Sering Diajukan
            </h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-10">
                <div class="faq-accordion">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item wow fadeInUp" data-wow-delay=".2s">
                            <h5 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                    Bagaimana cara booking kamar?
                                </button>
                            </h5>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Anda dapat booking kamar melalui website kami dengan cara login terlebih dahulu, pilih kamar yang diinginkan, kemudian isi form booking. Setelah itu Anda akan mendapat tagihan yang harus dibayar dalam 3 hari.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp" data-wow-delay=".4s">
                            <h5 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                    Apa saja fasilitas yang tersedia?
                                </button>
                            </h5>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Setiap kamar dilengkapi dengan WiFi cepat, AC, kamar mandi dalam, lemari, dan kasur. Fasilitas umum meliputi keamanan 24 jam, parkir luas, dapur bersama, dan ruang tamu.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp" data-wow-delay=".6s">
                            <h5 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                    Berapa minimal durasi sewa?
                                </button>
                            </h5>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Minimal durasi sewa adalah 1 bulan. Anda dapat memperpanjang sewa hingga 12 bulan sesuai kebutuhan Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp" data-wow-delay=".8s">
                            <h5 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                    Apakah ada deposit atau uang muka?
                                </button>
                            </h5>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Ya, deposit sebesar 1 bulan sewa diperlukan saat check-in. Deposit akan dikembalikan penuh saat check-out jika tidak ada kerusakan pada kamar.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp" data-wow-delay="1s">
                            <h5 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
                                    Bagaimana cara pembayaran?
                                </button>
                            </h5>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>Pembayaran dapat dilakukan via transfer bank ke rekening yang tertera pada tagihan. Anda juga dapat melakukan pembayaran tunai di kantor kami pada jam kerja.</p>
                                </div>
                            </div>
                        </div>
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
                            Masih Ada Pertanyaan?
                        </h2>
                        <p class="text-white mt-3 wow fadeInUp" data-wow-delay=".5s">
                            Jangan ragu untuk menghubungi kami! Tim kami siap menjawab semua pertanyaan Anda dan membantu menemukan kamar kosan yang tepat.
                        </p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="cta-button text-lg-end wow fadeInUp" data-wow-delay=".7s">
                        <a href="https://wa.me/6281234567890" target="_blank" class="theme-btn">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .contact-form .form-clt input,
    .contact-form .form-clt textarea {
        width: 100%;
        padding: 15px 20px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .contact-form .form-clt input:focus,
    .contact-form .form-clt textarea:focus {
        border-color: #2196F3;
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
    }

    .social-icon:hover {
        background: #1976D2 !important;
        transform: translateY(-3px);
        transition: all 0.3s;
    }

    .info-items {
        text-align: center;
        padding: 40px 30px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 30px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }

    .info-items:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 40px rgba(33, 150, 243, 0.2);
    }

    .info-items .icon {
        margin-bottom: 20px;
    }

    .info-items h3 {
        font-size: 22px;
        margin-bottom: 15px;
        color: #1565C0;
    }

    .info-items p {
        margin: 0;
        color: #666;
    }

    .info-items a {
        color: #2196F3;
        text-decoration: none;
        transition: color 0.3s;
    }

    .info-items a:hover {
        color: #1976D2;
    }
</style>
@endpush
