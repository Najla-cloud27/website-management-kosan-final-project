<!-- Sidenav Menu Start -->
<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a class="logo" href="<?php echo e(route('tenant.dashboard')); ?>">
        <span class="logo logo-light">
            <span class="logo-lg"><img alt="logo" src="/images/logo.png" /></span>
            <span class="logo-sm"><img alt="small logo" src="/images/logo-sm.png" /></span>
        </span>
        <span class="logo logo-dark">
            <span class="logo-lg"><img alt="dark logo" src="/images/logo-black.png" /></span>
            <span class="logo-sm"><img alt="small logo" src="/images/logo-sm.png" /></span>
        </span>
    </a>
    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-on-hover">
        <i class="ti ti-menu-4 fs-22 align-middle"></i>
    </button>
    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-offcanvas">
        <i class="ti ti-x align-middle"></i>
    </button>
    <div class="scrollbar" data-simplebar="">
        <!-- User -->
        <div class="sidenav-user">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a class="link-reset" href="javascript:void(0);">
                        <img alt="user-image" class="rounded-circle mb-2 avatar-md" src="/images/users/user-2.jpg" />
                        <span class="sidenav-user-name fw-bold"><?php echo e(auth()->user()->name); ?></span>
                        <span class="fs-12 fw-semibold">Penyewa</span>
                    </a>
                </div>
                <div>
                    <a aria-expanded="false" aria-haspopup="false"
                        class="dropdown-toggle drop-arrow-none link-reset sidenav-user-set-icon" data-bs-offset="0,12"
                        data-bs-toggle="dropdown" href="#!">
                        <i class="ti ti-settings fs-24 align-middle ms-1"></i>
                    </a>
                    <div class="dropdown-menu">
                        <!-- Header -->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Selamat Datang!</h6>
                        </div>
                        <!-- Logout -->
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item fw-semibold">
                                <i class="ti ti-logout-2 me-2 fs-17 align-middle"></i>
                                <span class="align-middle">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <li class="side-nav-title mt-2">Menu Utama</li>
            
            <!-- Dashboard -->
            <li class="side-nav-item">
                <a class="side-nav-link <?php echo e(request()->routeIs('tenant.dashboard') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('tenant.dashboard')); ?>">
                    <span class="menu-icon"><i data-lucide="layout-dashboard"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <!-- Booking Saya -->
            <li class="side-nav-item">
                <a class="side-nav-link <?php echo e(request()->routeIs('tenant.bookings') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('tenant.bookings')); ?>">
                    <span class="menu-icon"><i data-lucide="calendar-check"></i></span>
                    <span class="menu-text">Booking Saya</span>
                </a>
            </li>

            <!-- Riwayat Tagihan -->
            <li class="side-nav-item">
                <a class="side-nav-link <?php echo e(request()->routeIs('tenant.billing.*') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('tenant.billing.history')); ?>">
                    <span class="menu-icon"><i data-lucide="receipt"></i></span>
                    <span class="menu-text">Riwayat Tagihan</span>
                </a>
            </li>

            <!-- Keluhan -->
            <li class="side-nav-item">
                <a class="side-nav-link <?php echo e(request()->routeIs('tenant.complaints.index') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('tenant.complaints.index')); ?>">
                    <span class="menu-icon"><i data-lucide="message-square"></i></span>
                    <span class="menu-text">Daftar Keluhan</span>
                </a>
            </li>

            <!-- Buat Keluhan -->
            <li class="side-nav-item">
                <a class="side-nav-link <?php echo e(request()->routeIs('tenant.complaints.create') ? 'active' : ''); ?>" 
                   href="<?php echo e(route('tenant.complaints.create')); ?>">
                    <span class="menu-icon"><i data-lucide="plus-circle"></i></span>
                    <span class="menu-text">Buat Keluhan Baru</span>
                </a>
            </li>

            <li class="side-nav-title">Lainnya</li>

            <!-- Katalog Kamar Public -->
            <li class="side-nav-item">
                <a class="side-nav-link" href="<?php echo e(route('rooms.index')); ?>" target="_blank">
                    <span class="menu-icon"><i data-lucide="earth"></i></span>
                    <span class="menu-text">Lihat Katalog Kamar</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Sidenav Menu End -->
<?php /**PATH D:\final-project-smstr1\resources\views\layouts\partials\sidenav-tenant.blade.php ENDPATH**/ ?>