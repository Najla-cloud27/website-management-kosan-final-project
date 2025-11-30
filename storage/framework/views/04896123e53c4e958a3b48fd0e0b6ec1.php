<!-- Footer-Section Start -->
<footer class="footer-section fix footer-3 section-padding pb-0">
    <div class="container">
        <div class="footer-top style-new">
            <div class="logo-items">
                <a href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(asset('travo/img/kosan-diriq.png')); ?>" alt="Kosan DiriQ Logo" style="max-height: 50px; filter: brightness(0) invert(1);">
                </a>
            </div>
            <div class="contact-info">
                <div class="contact-items">
                    <div class="icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="content">
                        <h6><a href="tel:+6281234567890">+62 812-3456-7890</a></h6>
                    </div>
                </div>
                <div class="contact-items">
                    <div class="icon">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <div class="content">
                        <h6><a href="mailto:info@kosandiriq.com">info@kosandiriq.com</a></h6>
                    </div>
                </div>
                <div class="contact-items">
                    <div class="icon">
                        <i class="fa-regular fa-location-dot"></i>
                    </div>
                    <div class="content">
                        <h6>Jl. Contoh No. 123 <br> Jakarta, Indonesia</h6>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget-wrapper-new style-2 style-new-area">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-widget-items">
                        <div class="footer-content style-3">
                            <h3>Subscribe Newsletter</h3>
                            <p>Dapatkan info promo dan update terbaru</p>
                            <div class="footer-input style-3">
                                <input type="email" id="email2" placeholder="Email Anda">
                                <button class="newsletter-btn theme-btn" type="submit">
                                    Subscribe <i class="fa-sharp fa-regular fa-arrow-right"></i>
                                </button>
                            </div>
                            <div class="social-icon style-3 d-flex align-items-center">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 ps-lg-5 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-widget-items">
                        <div class="widget-head">
                            <h4 class="style-3">Kosan DiriQ</h4>
                        </div>
                        <ul class="list-items style-3">
                            <li><a href="<?php echo e(route('about')); ?>">Tentang Kami</a></li>
                            <li><a href="<?php echo e(route('rooms.index')); ?>">Kamar Tersedia</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>">Kontak</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 ps-lg-5 wow fadeInUp" data-wow-delay=".6s">
                    <div class="single-widget-items">
                        <div class="widget-head">
                            <h4 class="style-3">Quick Links</h4>
                        </div>
                        <ul class="list-items style-3">
                            <li><a href="<?php echo e(route('home')); ?>">Beranda</a></li>
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(auth()->user()->role === 'penyewa'): ?>
                                    <li><a href="<?php echo e(route('tenant.dashboard')); ?>">Dashboard</a></li>
                                    <li><a href="<?php echo e(route('tenant.billing.history')); ?>">Tagihan</a></li>
                                    <li><a href="<?php echo e(route('tenant.complaints.index')); ?>">Keluhan</a></li>
                                <?php elseif(auth()->user()->role === 'pemilik'): ?>
                                    <li><a href="<?php echo e(route('admin.dashboard')); ?>">Admin Panel</a></li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                                <li><a href="<?php echo e(route('register')); ?>">Daftar</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 ps-lg-5 wow fadeInUp" data-wow-delay=".8s">
                    <div class="single-widget-items">
                        <div class="widget-head">
                            <h4 class="style-3">Fasilitas Unggulan</h4>
                        </div>
                        <ul class="list-items style-3">
                            <li><i class="fa-solid fa-wifi"></i> WiFi Cepat</li>
                            <li><i class="fa-solid fa-shield"></i> Keamanan 24 Jam</li>
                            <li><i class="fa-solid fa-bed"></i> Kasur Nyaman</li>
                            <li><i class="fa-solid fa-shower"></i> Kamar Mandi Dalam</li>
                            <li><i class="fa-solid fa-square-parking"></i> Parkir Luas</li>
                            <li><i class="fa-solid fa-utensils"></i> Dapur Bersama</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom style-2">
            <div class="footer-wrapper">
                <p class="wow fadeInUp" data-wow-delay=".3s">
                    ©<span class="style-3">Kosan DiriQ by Najla</span> <?php echo e(date('Y')); ?>. All Rights Reserved
                </p>
                <ul class="bottom-list wow fadeInUp" data-wow-delay=".5s">
                    <li>Syarat & Ketentuan</li>
                    <li>Kebijakan Privasi</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH D:\file-belajar-website-IDN\final-project-smstr1\resources\views/layouts/public/footer.blade.php ENDPATH**/ ?>