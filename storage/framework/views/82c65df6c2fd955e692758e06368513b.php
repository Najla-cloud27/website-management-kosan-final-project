<!-- header-top -->
<div class="header-top-section">
    <div class="container">
        <div class="header-top-wrapper bg-cover" style="background-image: url(<?php echo e(asset('travo/img/header/3.png')); ?>);">
            <ul class="top-left">
                <li>
                    <i class="fa-solid fa-envelope"></i>
                    <a href="mailto:info@kosandiriq.com">info@kosandiriq.com</a>
                </li>
                <li>
                    <i class="fa-solid fa-location-dot"></i>
                    Jl. Contoh No. 123, Jakarta, Indonesia
                </li>
            </ul>
            <ul class="top-right">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
            </ul>
        </div>
    </div>
</div>

<!-- header-main -->
<div id="header-sticky" class="header-1">
    <div class="container">
        <div class="mega-menu-wrapper">
            <div class="header-main">
                <div class="logo">
                    <a href="<?php echo e(route('home')); ?>" class="header-logo">
                        <img src="<?php echo e(asset('travo/img/kosan-diriq.png')); ?>" alt="Kosan DiriQ Logo" style="max-height: 50px;">
                    </a>
                </div>
                <div class="header-right d-flex justify-content-end align-items-center">
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('home')); ?>">Beranda</a>
                                    </li>
                                    <li class="<?php echo e(request()->routeIs('rooms.*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('rooms.index')); ?>">Kamar Tersedia</a>
                                    </li>
                                    <li class="<?php echo e(request()->routeIs('about') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('about')); ?>">Tentang Kami</a>
                                    </li>
                                    <li class="<?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('contact')); ?>">Kontak</a>
                                    </li>
                                    
                                    <?php if(auth()->guard()->check()): ?>
                                        <?php if(auth()->user()->role === 'penyewa'): ?>
                                            <li>
                                                <a href="<?php echo e(route('tenant.dashboard')); ?>">Dashboard Saya</a>
                                            </li>
                                        <?php elseif(auth()->user()->role === 'pemilik'): ?>
                                            <li>
                                                <a href="<?php echo e(route('admin.dashboard')); ?>">Admin Panel</a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    
                    <a href="#0" class="search-trigger search-icon">
                        <i class="fa-regular fa-magnifying-glass"></i>
                    </a>
                    
                    <div class="header__hamburger my-auto">
                        <div class="sidebar__toggle">
                            <img src="<?php echo e(asset('travo/img/icon/bars.svg')); ?>" alt="Menu">
                        </div>
                    </div>
                    
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="theme-btn"> 
                            Login / Daftar
                            <i class="fa-sharp fa-regular fa-arrow-right"></i>
                        </a>
                    <?php else: ?>
                        <div class="dropdown">
                            <a href="#" class="theme-btn dropdown-toggle" data-bs-toggle="dropdown">
                                <?php echo e(auth()->user()->name); ?>

                                <i class="fa-solid fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if(auth()->user()->role === 'penyewa'): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('tenant.dashboard')); ?>">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('tenant.billing.history')); ?>">Tagihan</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('tenant.complaints.index')); ?>">Keluhan</a></li>
                                <?php elseif(auth()->user()->role === 'pemilik'): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>">Admin Panel</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\final-project-smstr1\resources\views/layouts/public/header.blade.php ENDPATH**/ ?>