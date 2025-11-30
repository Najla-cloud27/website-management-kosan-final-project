

<?php $__env->startSection('title', 'Login - Kosan DiriQ by Najla'); ?>

<?php $__env->startSection('content'); ?>

<!-- Breadcrumb Section Start -->
<section class="breadcrumb-wrapper fix bg-cover" style="background-image: url('<?php echo e(asset('travo/img/breadcrumb/breadcrumb.jpg')); ?>');">
    <div class="container">
        <div class="breadcrumb-content-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="breadcrumb-content text-center">
                        <h1 class="text-white wow fadeInUp" data-wow-delay=".3s">Login</h1>
                        <div class="breadcrumb-list wow fadeInUp" data-wow-delay=".5s">
                            <a href="<?php echo e(route('home')); ?>">Beranda</a>
                            <span><i class="fa-sharp fa-solid fa-slash-forward"></i></span>
                            <span>Login</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Login Section Start -->
<section class="contact-section section-padding fix">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="contact-form-area">
                    <div class="section-title text-center mb-4">
                        <span class="sub-title wow fadeInUp">Selamat Datang Kembali</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".3s">Login ke Akun Anda</h2>
                        <p class="mt-3 wow fadeInUp" data-wow-delay=".5s">
                            Masukkan email dan password untuk mengakses dashboard Anda
                        </p>
                    </div>
                    
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger wow fadeInUp" data-wow-delay=".3s">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="mb-0"><?php echo e($error); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(session('status')): ?>
                        <div class="alert alert-success wow fadeInUp" data-wow-delay=".3s">
                            <i class="fa-solid fa-circle-check me-2"></i>
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('login')); ?>" class="contact-form-items wow fadeInUp" data-wow-delay=".7s">
                        <?php echo csrf_field(); ?>

                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="form-clt">
                                    <span class="text-dark fw-semibold mb-2 d-block">
                                        <i class="fa-solid fa-envelope me-2 text-primary"></i>Email
                                    </span>
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           placeholder="Masukkan email Anda"
                                           value="<?php echo e(old('email')); ?>"
                                           class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           required 
                                           autofocus>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small mt-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-clt">
                                    <span class="text-dark fw-semibold mb-2 d-block">
                                        <i class="fa-solid fa-lock me-2 text-primary"></i>Password
                                    </span>
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           placeholder="Masukkan password"
                                           class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           required>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small mt-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="remember" 
                                           id="remember"
                                           <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <button type="submit" class="theme-btn w-100">
                                    <i class="fa-solid fa-right-to-bracket me-2"></i>
                                    Masuk ke Dashboard
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-4 wow fadeInUp" data-wow-delay=".9s">
                        <p class="mb-2">
                            Belum punya akun? 
                            <a href="<?php echo e(route('register')); ?>" class="text-primary fw-semibold">
                                Daftar di sini <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </p>
                        <p class="mb-0">
                            <a href="<?php echo e(route('home')); ?>" class="text-muted">
                                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Beranda
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Custom Auth Styles */
    .contact-form-area {
        background: #ffffff;
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    
    .contact-form-items input[type="email"],
    .contact-form-items input[type="password"] {
        color: #2196F3;
        height: 65px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .contact-form-items input[type="email"]:focus,
    .contact-form-items input[type="password"]:focus {
        color: #2196F3;
        border-color: #2196F3;
        box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.15);
        outline: none;
    }
    
    .contact-form-items input.is-invalid {
        border-color: #dc3545;
    }
    
    .form-clt {
        margin-bottom: 10px;
    }
    
    .form-clt span {
        font-size: 15px;
        margin-bottom: 8px;
    }
    
    .form-check {
        padding: 20px 0;
        display: flex;
        align-items: center;
    }
    
    .form-check-input {
        width: 20px;
        height: 20px;
        margin-top: 0;
        cursor: pointer;
        flex-shrink: 0;
    }
    
    .form-check-input:checked {
        background-color: #2196F3;
        border-color: #2196F3;
    }
    
    .form-check-label {
        font-size: 15px;
        margin-left: 10px;
        margin-bottom: 0;
        cursor: pointer;
        line-height: 20px;
    }
    
    .theme-btn {
        height: 60px;
        font-size: 17px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
    }
    
    .alert {
        border-radius: 8px;
        border: none;
        padding: 18px 20px;
        margin-bottom: 25px;
    }
    
    .alert-danger {
        background-color: #fee;
        color: #c33;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }
    
    .section-title .sub-title {
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    .section-title h2 {
        margin-bottom: 10px;
        font-size: 38px;
    }
    
    .section-title p {
        font-size: 16px;
        color: #666;
        line-height: 1.8;
    }
    
    @media (max-width: 768px) {
        .contact-form-area {
            padding: 35px 25px;
        }
        
        .section-title h2 {
            font-size: 28px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\file-belajar-website-IDN\final-project-smstr1\resources\views/auth/login.blade.php ENDPATH**/ ?>