

<?php $__env->startSection('title', 'Beranda - Kosan DiriQ by Najla'); ?>

<?php $__env->startSection('content'); ?>

<!-- Hero-Section Start -->
<section class="hero-section bg-cover" style="background-image: url(<?php echo e(asset('travo/img/hero/bg.jpg')); ?>);">
    <div class="shape float-bob-x">
        <img src="<?php echo e(asset('travo/img/shape/plane-1.png')); ?>" alt="">
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-wrapper">
                    <div class="section-title">
                        <span class="sub-title wow fadeInUp">
                            Hunian Nyaman dan Terjangkau
                        </span>
                        <h1 class="text-white wow fadeInUp" data-wow-delay=".3s">
                            Temukan Kamar Kosan <br> Impian Anda di Sini
                        </h1>
                    </div>
                    <div class="hero-button wow fadeInUp" data-wow-delay=".7s">
                        <a href="<?php echo e(route('rooms.index')); ?>" class="theme-btn">
                            Lihat Kamar Tersedia
                            <i class="fa-sharp fa-regular fa-arrow-right"></i>
                        </a>
                        <a href="<?php echo e(route('about')); ?>" class="theme-btn style-2">
                            Tentang Kami
                            <i class="fa-sharp fa-regular fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Search Box -->
        <div class="hero-bottom">
            <form action="<?php echo e(route('rooms.index')); ?>" method="GET">
                <div class="booking-list-area section-bg">
                    <div class="booking-list style-2">
                        <div class="icon">
                            <i class="fa-solid fa-search"></i>
                            <h6>Nama Kamar</h6>
                        </div>
                        <div class="form">
                            <input type="text" name="search" placeholder="Cari kamar..." class="form-control border-0">
                        </div>
                    </div>
                    <div class="booking-list">
                        <div class="icon">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <h6>Harga Min</h6>
                        </div>
                        <div class="form">
                            <input type="number" name="minPrice" placeholder="Min" class="form-control border-0">
                        </div>
                    </div>
                    <div class="booking-list">
                        <div class="icon">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <h6>Harga Max</h6>
                        </div>
                        <div class="form">
                            <input type="number" name="maxPrice" placeholder="Max" class="form-control border-0">
                        </div>
                    </div>
                    <div class="booking-list">
                        <div class="form">
                            <select name="status" class="form-select border-0">
                                <option value="">Semua Status</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="terisi">Terisi</option>
                            </select>
                        </div>
                    </div>
                    <button class="theme-btn" type="submit">Cari Kamar</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- About-Section Start -->
<section class="about-section section-padding fix">
    <div class="container">
        <div class="about-wrapper">
            <?php
                // Ambil 4 gambar dari rooms yang ada
                $roomsWithImages = \App\Models\Room::whereNotNull('main_image_url')
                    ->where('status', 'tersedia')
                    ->limit(4)
                    ->get();
                
                // Jika tidak cukup gambar, ambil rooms tanpa filter gambar
                if($roomsWithImages->count() < 4) {
                    $roomsWithImages = \App\Models\Room::where('status', 'tersedia')
                        ->limit(4)
                        ->get();
                }
            ?>
            <div class="row g-4">
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="about-left-image">
                        <?php if(isset($roomsWithImages[0]) && $roomsWithImages[0]->main_image_url && file_exists(public_path('storage/' . $roomsWithImages[0]->main_image_url))): ?>
                            <img src="<?php echo e(Storage::url($roomsWithImages[0]->main_image_url)); ?>" alt="<?php echo e($roomsWithImages[0]->name); ?>" class="wow img-custom-anim-left" style="width: 100%; height: 400px; object-fit: cover;">
                        <?php else: ?>
                            <div class="placeholder-container-about" style="height: 400px;">
                                <i class="fa-solid fa-image"></i>
                                <p>Kosan DiriQ</p>
                            </div>
                        <?php endif; ?>
                        <div class="about-image-2">
                            <?php if(isset($roomsWithImages[1]) && $roomsWithImages[1]->main_image_url && file_exists(public_path('storage/' . $roomsWithImages[1]->main_image_url))): ?>
                                <img src="<?php echo e(Storage::url($roomsWithImages[1]->main_image_url)); ?>" alt="<?php echo e($roomsWithImages[1]->name); ?>" class="wow img-custom-anim-left" style="width: 100%; height: 250px; object-fit: cover;">
                            <?php else: ?>
                                <div class="placeholder-container-about" style="height: 250px;">
                                    <i class="fa-solid fa-home"></i>
                                    <p>Fasilitas</p>
                                </div>
                            <?php endif; ?>
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
                                Kosan DiriQ by Najla <br> Hunian Modern & Nyaman
                            </h2>
                        </div>
                        <p class="mt-4 mt-md-0 wow fadeInUp" data-wow-delay=".5s">
                            Kosan DiriQ menyediakan hunian berkualitas dengan fasilitas lengkap dan lokasi strategis. 
                            Kami berkomitmen memberikan pengalaman tinggal yang aman, nyaman, dan terjangkau untuk Anda.
                        </p>
                        <div class="about-button wow fadeInUp" data-wow-delay=".7s">
                            <a href="<?php echo e(route('about')); ?>" class="theme-btn">
                                Selengkapnya
                                <i class="fa-sharp fa-regular fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="about-right-image">
                        <?php if(isset($roomsWithImages[2]) && $roomsWithImages[2]->main_image_url && file_exists(public_path('storage/' . $roomsWithImages[2]->main_image_url))): ?>
                            <img src="<?php echo e(Storage::url($roomsWithImages[2]->main_image_url)); ?>" alt="<?php echo e($roomsWithImages[2]->name); ?>" class="wow img-custom-anim-right" style="width: 100%; height: 400px; object-fit: cover;">
                        <?php else: ?>
                            <div class="placeholder-container-about" style="height: 400px;">
                                <i class="fa-solid fa-bed"></i>
                                <p>Kamar Nyaman</p>
                            </div>
                        <?php endif; ?>
                        <div class="about-image-2">
                            <?php if(isset($roomsWithImages[3]) && $roomsWithImages[3]->main_image_url && file_exists(public_path('storage/' . $roomsWithImages[3]->main_image_url))): ?>
                                <img src="<?php echo e(Storage::url($roomsWithImages[3]->main_image_url)); ?>" alt="<?php echo e($roomsWithImages[3]->name); ?>" class="wow img-custom-anim-right" style="width: 100%; height: 250px; object-fit: cover;">
                            <?php else: ?>
                                <div class="placeholder-container-about" style="height: 250px;">
                                    <i class="fa-solid fa-shield"></i>
                                    <p>Aman 24/7</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service-Section Start -->
<section class="service-section section-padding pb-0 section-bg fix">
    <div class="shape float-bob-y">
        <img src="<?php echo e(asset('travo/img/shape/plane-2.png')); ?>" alt="">
    </div>
    <div class="container">
        <div class="service-wrapper">
            <div class="row g-4">
                <div class="col-xl-4">
                    <div class="service-content">
                        <div class="section-title">
                            <span class="sub-title wow fadeInUp">
                                Fasilitas Unggulan
                            </span>
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                                Kenyamanan & Keamanan <br> Adalah Prioritas Kami
                            </h2>
                        </div>
                        <p class="wow fadeInUp" data-wow-delay=".5s">
                            Nikmati berbagai fasilitas lengkap yang kami sediakan untuk kenyamanan Anda
                        </p>
                        <div class="service-button">
                            <div class="array-button">
                                <button class="array-prev">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                                <button class="array-next">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="swiper service-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="service-box-item">
                                    <div class="icon">
                                        <i class="fa-solid fa-wifi fa-3x text-primary"></i>
                                    </div>
                                    <div class="content">
                                        <h3>
                                            <a href="<?php echo e(route('rooms.index')); ?>">WiFi Cepat</a>
                                        </h3>
                                        <p>
                                            Internet berkecepatan tinggi untuk mendukung aktivitas belajar, kerja, dan hiburan Anda setiap hari tanpa hambatan.
                                        </p>
                                        <div class="link-btns">
                                            <a href="<?php echo e(route('rooms.index')); ?>">Lihat Kamar
                                                <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-box-item">
                                    <div class="icon">
                                        <i class="fa-solid fa-shield fa-3x text-primary"></i>
                                    </div>
                                    <div class="content">
                                        <h3>
                                            <a href="<?php echo e(route('rooms.index')); ?>">Keamanan 24 Jam</a>
                                        </h3>
                                        <p>
                                            Sistem keamanan terpadu dengan CCTV dan penjaga 24 jam untuk memberikan rasa aman dan nyaman bagi penghuni.
                                        </p>
                                        <div class="link-btns">
                                            <a href="<?php echo e(route('rooms.index')); ?>">Lihat Kamar
                                                <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-box-item">
                                    <div class="icon">
                                        <i class="fa-solid fa-bed fa-3x text-primary"></i>
                                    </div>
                                    <div class="content">
                                        <h3>
                                            <a href="<?php echo e(route('rooms.index')); ?>">Kamar Nyaman</a>
                                        </h3>
                                        <p>
                                            Kamar dilengkapi dengan kasur empuk, AC, lemari, dan perlengkapan berkualitas untuk kenyamanan maksimal Anda.
                                        </p>
                                        <div class="link-btns">
                                            <a href="<?php echo e(route('rooms.index')); ?>">Lihat Kamar
                                                <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-box-item">
                                    <div class="icon">
                                        <i class="fa-solid fa-square-parking fa-3x text-primary"></i>
                                    </div>
                                    <div class="content">
                                        <h3>
                                            <a href="<?php echo e(route('rooms.index')); ?>">Parkir Luas</a>
                                        </h3>
                                        <p>
                                            Area parkir yang luas dan aman untuk motor dan mobil, memudahkan mobilitas Anda setiap hari.
                                        </p>
                                        <div class="link-btns">
                                            <a href="<?php echo e(route('rooms.index')); ?>">Lihat Kamar
                                                <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-box-item">
                                    <div class="icon">
                                        <i class="fa-solid fa-utensils fa-3x text-primary"></i>
                                    </div>
                                    <div class="content">
                                        <h3>
                                            <a href="<?php echo e(route('rooms.index')); ?>">Dapur Bersama</a>
                                        </h3>
                                        <p>
                                            Dapur bersama yang bersih dan lengkap untuk memasak makanan favorit Anda dengan mudah dan hemat.
                                        </p>
                                        <div class="link-btns">
                                            <a href="<?php echo e(route('rooms.index')); ?>">Lihat Kamar
                                                <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="service-box-item">
                                    <div class="icon">
                                        <i class="fa-solid fa-shower fa-3x text-primary"></i>
                                    </div>
                                    <div class="content">
                                        <h3>
                                            <a href="<?php echo e(route('rooms.index')); ?>">Kamar Mandi Dalam</a>
                                        </h3>
                                        <p>
                                            Setiap kamar dilengkapi kamar mandi dalam yang bersih dengan water heater untuk kenyamanan Anda.
                                        </p>
                                        <div class="link-btns">
                                            <a href="<?php echo e(route('rooms.index')); ?>">Lihat Kamar
                                                <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Rooms Section -->
<section class="package-section section-padding fix">
    <div class="container">
        <div class="section-title text-center">
            <span class="sub-title wow fadeInUp">Kamar Pilihan</span>
            <h2 class="wow fadeInUp" data-wow-delay=".3s">
                Temukan Kamar Favorit Anda
            </h2>
        </div>
        
        <div class="row g-4 mt-4">
            <?php
                // Get 6 available rooms untuk ditampilkan di homepage
                $featuredRooms = \App\Models\Room::where('status', 'tersedia')
                    ->orderBy('created_at', 'desc')
                    ->limit(6)
                    ->get();
            ?>
            
            <?php $__empty_1 = true; $__currentLoopData = $featuredRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".<?php echo e($loop->index * 2); ?>s">
                    <div class="package-card h-100">
                        <?php if($room->main_image_url && file_exists(public_path('storage/' . $room->main_image_url))): ?>
                            <img src="<?php echo e(Storage::url($room->main_image_url)); ?>" class="card-img-top" alt="<?php echo e($room->name); ?>" style="height: 250px; object-fit: cover;">
                        <?php else: ?>
                            <div class="placeholder-container-home">
                                <i class="fa-solid fa-image"></i>
                                <p><?php echo e($room->name); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="package-card-content">
                            <div class="package-card-top">
                                <span class="badge <?php echo e(status_badge_class($room->status)); ?>">
                                    <?php echo e(format_status($room->status)); ?>

                                </span>
                                <h3><a href="<?php echo e(route('rooms.show', $room->slug)); ?>"><?php echo e($room->name); ?></a></h3>
                                <p><?php echo e(Str::limit($room->description, 100)); ?></p>
                            </div>
                            <div class="package-card-bottom">
                                <div class="price">
                                    <span class="text-primary fw-bold">Rp <?php echo e(number_format($room->price, 0, ',', '.')); ?></span>
                                    <span class="text-muted">/bulan</span>
                                </div>
                                <a href="<?php echo e(route('rooms.show', $room->slug)); ?>" class="theme-btn">
                                    Lihat Detail
                                    <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fa-solid fa-info-circle"></i> Belum ada kamar tersedia saat ini.
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-5 wow fadeInUp">
            <a href="<?php echo e(route('rooms.index')); ?>" class="theme-btn">
                Lihat Semua Kamar
                <i class="fa-sharp fa-regular fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section fix section-padding bg-cover" style="background-image: url(<?php echo e(asset('travo/img/cta/bg.jpg')); ?>);">
    <div class="container">
        <div class="cta-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title mb-0">
                        <span class="sub-title text-white wow fadeInUp">Siap Pindah?</span>
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">
                            Booking Kamar Sekarang & <br> Dapatkan Promo Menarik!
                        </h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cta-button text-lg-end wow fadeInUp" data-wow-delay=".5s">
                        <a href="<?php echo e(route('rooms.index')); ?>" class="theme-btn style-3">
                            Pesan Kamar Sekarang
                            <i class="fa-sharp fa-regular fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Placeholder Container untuk Kamar Tanpa Gambar */
    .placeholder-container-home {
        width: 100%;
        height: 250px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        color: white;
        border-radius: 10px 10px 0 0;
    }
    
    .placeholder-container-home i {
        font-size: 60px;
        margin-bottom: 15px;
        opacity: 0.9;
    }
    
    .placeholder-container-home p {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        text-align: center;
        padding: 0 20px;
    }
    
    /* Placeholder Container untuk About Section */
    .placeholder-container-about {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        color: white;
        border-radius: 10px;
    }
    
    .placeholder-container-about i {
        font-size: 50px;
        margin-bottom: 15px;
        opacity: 0.9;
    }
    
    .placeholder-container-about p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        text-align: center;
        padding: 0 15px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Initialize Service Slider
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
            const serviceSlider = new Swiper('.service-slider', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                navigation: {
                    nextEl: '.array-next',
                    prevEl: '.array-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 2,
                    },
                    1200: {
                        slidesPerView: 2,
                    }
                }
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\final-project-smstr1\resources\views\public\home.blade.php ENDPATH**/ ?>