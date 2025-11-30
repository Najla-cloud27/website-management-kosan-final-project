<!-- Topbar Start -->
<header class="app-topbar">
    <div class="container-fluid topbar-menu">
        <div class="d-flex align-items-center gap-2">
            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a class="logo-light" href="<?php echo e(route('admin.dashboard')); ?>">
                    <span class="logo-lg">
                        <img alt="logo" src="/images/logo.png" />
                    </span>
                    <span class="logo-sm">
                        <img alt="small logo" src="/images/logo-sm.png" />
                    </span>
                </a>
                <!-- Logo Dark -->
                <a class="logo-dark" href="<?php echo e(route('admin.dashboard')); ?>">
                    <span class="logo-lg">
                        <img alt="dark logo" src="/images/logo-black.png" />
                    </span>
                    <span class="logo-sm">
                        <img alt="small logo" src="/images/logo-sm.png" />
                    </span>
                </a>
            </div>
            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button btn btn-default btn-icon">
                <i class="ti ti-menu-4 fs-22"></i>
            </button>
        </div>
        
        <div class="d-flex align-items-center gap-2">
            <!-- Notification Bell (Livewire Component) -->
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('notification-bell');

$__html = app('livewire')->mount($__name, $__params, 'lw-327720656-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            
            <!-- User Dropdown -->
            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a aria-expanded="false" aria-haspopup="false"
                        class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-offset="0,19"
                        data-bs-toggle="dropdown" href="#!">
                        <img alt="user-image" class="rounded-circle me-lg-2 d-flex" src="/images/users/user-1.jpg"
                            width="32" />
                        <div class="d-lg-flex align-items-center gap-1 d-none">
                            <h5 class="my-0"><?php echo e(auth()->user()->name); ?></h5>
                            <i class="ti ti-chevron-down align-middle"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- Header -->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Selamat Datang, <?php echo e(auth()->user()->name); ?>!</h6>
                        </div>
                        <!-- Logout -->
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item fw-semibold">
                                <i class="ti ti-logout-2 me-1 fs-17 align-middle"></i>
                                <span class="align-middle">Log Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Topbar End -->
<?php /**PATH D:\file-belajar-website-IDN\final-project-smstr1\resources\views/layouts/partials/topbar-admin.blade.php ENDPATH**/ ?>