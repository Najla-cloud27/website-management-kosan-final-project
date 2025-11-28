

<?php $__env->startSection('title', 'Daftar - Kosan DiriQ by Najla'); ?>

<?php $__env->startSection('content'); ?>

<!-- Breadcrumb Section Start -->
<section class="breadcrumb-wrapper fix bg-cover" style="background-image: url('<?php echo e(asset('travo/img/breadcrumb/breadcrumb.jpg')); ?>');">
    <div class="container">
        <div class="breadcrumb-content-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="breadcrumb-content text-center">
                        <h1 class="text-white wow fadeInUp" data-wow-delay=".3s">Daftar Akun</h1>
                        <div class="breadcrumb-list wow fadeInUp" data-wow-delay=".5s">
                            <a href="<?php echo e(route('home')); ?>">Beranda</a>
                            <span><i class="fa-sharp fa-solid fa-slash-forward"></i></span>
                            <span>Daftar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Register Section Start -->
<section class="contact-section section-padding fix">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="contact-form-area">
                    <div class="section-title text-center mb-5">
                        <span class="sub-title wow fadeInUp">Bergabung Bersama Kami</span>
                        <h2 class="wow fadeInUp" data-wow-delay=".3s">Daftar Akun Baru</h2>
                        <p class="mt-3 wow fadeInUp" data-wow-delay=".5s">
                            Lengkapi formulir di bawah untuk membuat akun dan mulai mencari kamar kosan impian Anda
                        </p>
                    </div>
                    
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger wow fadeInUp" data-wow-delay=".3s">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('register')); ?>" class="contact-form-items wow fadeInUp" data-wow-delay=".7s">
                        <?php echo csrf_field(); ?>

                        <div class="row g-3">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-clt">
                                    <label class="form-label">
                                        <i class="fa-solid fa-user me-2 text-primary"></i>Nama Lengkap <span class="text-danger d-inline">*</span>
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           placeholder="Masukkan nama lengkap"
                                           value="<?php echo e(old('name')); ?>"
                                           class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           required 
                                           autofocus>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small d-block mt-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="form-clt">
                                    <label class="form-label">
                                        <i class="fa-solid fa-envelope me-2 text-primary"></i>Email <span class="text-danger d-inline">*</span>
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           placeholder="contoh@email.com"
                                           value="<?php echo e(old('email')); ?>"
                                           class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small d-block mt-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="form-clt">
                                    <label class="form-label">
                                        <i class="fa-solid fa-id-card me-2 text-primary"></i>NIK <span class="text-danger d-inline">*</span>
                                    </label>
                                    <input type="text" 
                                           name="nik" 
                                           id="nik" 
                                           placeholder="16 digit NIK"
                                           value="<?php echo e(old('nik')); ?>"
                                           maxlength="16"
                                           class="form-control <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           required>
                                    <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small d-block mt-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="form-clt">
                                    <label class="form-label">
                                        <i class="fa-solid fa-phone me-2 text-primary"></i>No. Telepon
                                    </label>
                                    <input type="text" 
                                           name="phone_number" 
                                           id="phone_number" 
                                           placeholder="08xxxxxxxxxx"
                                           value="<?php echo e(old('phone_number')); ?>"
                                           class="form-control <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger small d-block mt-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="form-clt">
                                    <label class="form-label">
                                        <i class="fa-solid fa-lock me-2 text-primary"></i>Password <span class="text-danger d-inline">*</span>
                                    </label>
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           placeholder="Minimal 8 karakter"
                                           class="form-control <?php $__errorArgs = ['password'];
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
                                        <span class="text-danger small d-block mt-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-6">
                                <div class="form-clt">
                                    <label class="form-label">
                                        <i class="fa-solid fa-lock-keyhole me-2 text-primary"></i>Konfirmasi Password <span class="text-danger d-inline">*</span>
                                    </label>
                                    <input type="password" 
                                           name="password_confirmation" 
                                           id="password_confirmation" 
                                           placeholder="Ulangi password"
                                           class="form-control"
                                           required>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="terms"
                                           required>
                                    <label class="form-check-label" for="terms">
                                        Saya menyetujui <a href="#" class="text-primary fw-semibold">syarat dan ketentuan</a> yang berlaku
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 mt-4">
                                <button type="submit" class="theme-btn w-100">
                                    <i class="fa-solid fa-user-plus me-2"></i>
                                    Daftar Sekarang
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-4 wow fadeInUp" data-wow-delay=".9s">
                        <p class="mb-2">
                            Sudah punya akun? 
                            <a href="<?php echo e(route('login')); ?>" class="text-primary fw-semibold">
                                Login di sini <i class="fa-solid fa-arrow-right ms-1"></i>
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
        padding: 50px 45px;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    
    .contact-form-items .form-clt {
        margin-bottom: 0;
    }
    
    .contact-form-items .form-label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }
    
    .contact-form-items input[type="text"],
    .contact-form-items input[type="email"],
    .contact-form-items input[type="password"] {
        height: 60px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0 20px;
        font-size: 15px;
        transition: all 0.3s ease;
        width: 100%;
        background-color: #f8f9fa;
    }
    
    .contact-form-items input[type="text"]:focus,
    .contact-form-items input[type="email"]:focus,
    .contact-form-items input[type="password"]:focus {
        border-color: #2196F3;
        box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.15);
        outline: none;
        background-color: #ffffff;
    }
    
    .contact-form-items input.is-invalid {
        border-color: #dc3545;
        background-color: #fff5f5;
    }
    
    .contact-form-items input::placeholder {
        color: #999;
        font-size: 14px;
    }
    
    .form-check {
        padding: 0;
        display: flex;
        align-items: center;
    }
    
    .form-check-input {
        width: 20px;
        height: 20px;
        margin-top: 0;
        cursor: pointer;
        flex-shrink: 0;
        border: 2px solid #d0d0d0;
    }
    
    .form-check-input:checked {
        background-color: #2196F3;
        border-color: #2196F3;
    }
    
    .form-check-label {
        font-size: 14px;
        margin-left: 10px;
        margin-bottom: 0;
        cursor: pointer;
        line-height: 20px;
        color: #555;
    }
    
    .form-check-label a {
        text-decoration: none;
    }
    
    .form-check-label a:hover {
        text-decoration: underline;
    }
    
    .theme-btn {
        height: 58px;
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
    }
    
    .theme-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(33, 150, 243, 0.3);
    }
    
    .alert {
        border-radius: 10px;
        border: none;
        padding: 18px 22px;
        margin-bottom: 25px;
    }
    
    .alert-danger {
        background-color: #fee;
        color: #c33;
        border-left: 4px solid #dc3545;
    }
    
    .alert-danger ul {
        padding-left: 20px;
        margin-top: 8px;
        margin-bottom: 0;
    }
    
    .alert-danger li {
        margin-bottom: 5px;
    }
    
    .text-danger {
        color: #dc3545 !important;
        font-size: 13px;
        display: block;
        margin-top: 5px;
        font-weight: 500;
    }
    
    .section-title .sub-title {
        font-size: 18px;
        margin-bottom: 15px;
        display: inline-block;
    }
    
    .section-title h2 {
        margin-bottom: 15px;
        font-size: 36px;
        font-weight: 700;
    }
    
    .section-title p {
        font-size: 15px;
        color: #666;
        line-height: 1.8;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .row.g-3 {
        --bs-gutter-y: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .contact-form-area {
            padding: 35px 25px;
        }
        
        .section-title h2 {
            font-size: 28px;
        }
        
        .contact-form-items input[type="text"],
        .contact-form-items input[type="email"],
        .contact-form-items input[type="password"] {
            height: 55px;
            font-size: 14px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\final-project-smstr1\resources\views\auth\register.blade.php ENDPATH**/ ?>