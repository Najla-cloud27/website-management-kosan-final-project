<!DOCTYPE html>
<html lang="id" 
    data-skin="default"
    data-bs-theme="light"
    data-menu-color="light"
    data-topbar-color="dark"
    data-layout-position="fixed"
    data-sidenav-size="default">

<head>
    <meta charset="utf-8" />
    <title><?php echo e($title ?? 'Admin Panel'); ?> | Kosan DiriQ by Najla</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Sistem Manajemen Kosan DiriQ by Najla" name="description" />
    <meta content="Kosan DiriQ" name="author" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <!-- App favicon -->
    <link href="/images/favicon.ico" rel="shortcut icon" />

    <?php echo $__env->make('layouts.partials.head-css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body>
    <div class="wrapper">

        <?php echo $__env->make('layouts.partials.sidenav-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('layouts.partials.topbar-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="content-page">
            <div class="content">

                <div class="container-fluid">
                    <?php echo e($slot); ?>

                </div>

            </div>

            <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </div>

    </div>

    <?php echo $__env->make('layouts.partials.footer-scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH D:\final-project-smstr1\resources\views/layouts/admin-ubold.blade.php ENDPATH**/ ?>