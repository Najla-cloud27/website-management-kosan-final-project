<div>
    <!-- Breadcrumb Section -->
    <section class="breadcrumb-wrapper fix bg-cover" style="background-image: url('<?php echo e(asset('travo/img/breadcrumb/breadcrumb.jpg')); ?>');">
        <div class="container">
            <div class="row">
                <div class="page-heading">
                    <h2>Kamar Tersedia</h2>
                    <ul class="breadcrumb-list">
                        <li><a href="<?php echo e(url('/')); ?>">Beranda</a></li>
                        <li><i class="fa-solid fa-chevrons-right"></i></li>
                        <li class="active">Kamar</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Room Catalog Section -->
    <section class="destination-section section-padding fix">
        <div class="container">
            <!-- Filter Bar -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="filter-bar-wrapper">
                        <div class="row g-3 align-items-end">
                            <!-- Search -->
                            <div class="col-lg-3 col-md-6">
                                <div class="filter-group">
                                    <label class="filter-label">Cari Kamar</label>
                                    <input type="text" 
                                           wire:model.live.debounce.300ms="search" 
                                           class="filter-input" 
                                           placeholder="Nama kamar...">
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="col-lg-2 col-md-6">
                                <div class="filter-group">
                                    <label class="filter-label">Status</label>
                                    <select wire:model.live="statusFilter" class="filter-select">
                                        <option value="">Semua Status</option>
                                        <option value="tersedia">Tersedia</option>
                                        <option value="terisi">Terisi</option>
                                        <option value="sudah_dipesan">Sudah Dipesan</option>
                                        <option value="pemeliharaan">Pemeliharaan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Min Price -->
                            <div class="col-lg-2 col-md-6">
                                <div class="filter-group">
                                    <label class="filter-label">Harga Min</label>
                                    <input type="number" 
                                           wire:model.live.debounce.500ms="minPrice" 
                                           class="filter-input" 
                                           placeholder="Min...">
                                </div>
                            </div>

                            <!-- Max Price -->
                            <div class="col-lg-2 col-md-6">
                                <div class="filter-group">
                                    <label class="filter-label">Harga Max</label>
                                    <input type="number" 
                                           wire:model.live.debounce.500ms="maxPrice" 
                                           class="filter-input" 
                                           placeholder="Max...">
                                </div>
                            </div>

                            <!-- Reset Button -->
                            <div class="col-lg-3 col-md-6">
                                <button wire:click="resetFilters" class="filter-reset-btn">
                                    <i class="fa-solid fa-rotate-right"></i> Reset Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Grid -->
            <div class="row g-4">
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".<?php echo e(($loop->index % 3) * 0.2); ?>s">
                    <div class="destination-card-items">
                        <div class="destination-thumb">
                            <!--[if BLOCK]><![endif]--><?php if($room->main_image_url): ?>
                                <img src="<?php echo e(asset('storage/' . $room->main_image_url)); ?>" alt="<?php echo e($room->name); ?>">
                            <?php else: ?>
                                <div class="placeholder-container">
                                    <i class="fa-solid fa-image"></i>
                                    <p><?php echo e($room->name); ?></p>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            
                            <!--[if BLOCK]><![endif]--><?php if($room->status === 'tersedia'): ?>
                            <div class="ratting status-ribbon" style="background: #28a745 !important;">
                                <i class="fa-solid fa-check-circle"></i>
                                <span>TERSEDIA</span>
                            </div>
                            <?php elseif($room->status === 'terisi'): ?>
                            <div class="ratting status-ribbon" style="background: #dc3545 !important;">
                                <i class="fa-solid fa-ban"></i>
                                <span>TERISI</span>
                            </div>
                            <?php elseif($room->status === 'sudah_dipesan'): ?>
                            <div class="ratting status-ribbon" style="background: #17a2b8 !important;">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span>SUDAH DIPESAN</span>
                            </div>
                            <?php elseif($room->status === 'pemeliharaan'): ?>
                            <div class="ratting status-ribbon" style="background: #ffc107 !important; color: #000 !important;">
                                <i class="fa-solid fa-tools"></i>
                                <span>PEMELIHARAAN</span>
                            </div>
                            <?php else: ?>
                            <div class="ratting status-ribbon" style="background: #6c757d !important;">
                                <i class="fa-solid fa-question-circle"></i>
                                <span><?php echo e(strtoupper(str_replace('_', ' ', $room->status))); ?></span>
                            </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="destination-content">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="place">
                                    <i class="fa-solid fa-home"></i> 
                                    Kosan DiriQ
                                </span>
                            </div>
                            <h4>
                                <a href="<?php echo e(route('rooms.show', $room->slug)); ?>"><?php echo e($room->name); ?></a>
                            </h4>
                            <p class="room-desc">
                                <?php echo e(Str::limit($room->description ?? 'Kamar nyaman dengan fasilitas lengkap', 80)); ?>

                            </p>
                            
                            <?php
                                // Fasilitas sudah otomatis di-cast ke array oleh model
                                $fasilitas = is_array($room->fasilitas) ? $room->fasilitas : (is_string($room->fasilitas) ? json_decode($room->fasilitas, true) : []);
                                $iconMap = [
                                    'AC' => 'fa-snowflake',
                                    'Kasur' => 'fa-bed',
                                    'Lemari' => 'fa-door-closed',
                                    'Kamar Mandi Dalam' => 'fa-shower',
                                    'Kamar Mandi Luar' => 'fa-bath',
                                    'Meja Belajar' => 'fa-desk',
                                    'Meja' => 'fa-table',
                                    'Kursi' => 'fa-chair',
                                    'WiFi' => 'fa-wifi',
                                    'Wifi' => 'fa-wifi',
                                    'TV' => 'fa-tv',
                                    'Kipas Angin' => 'fa-wind',
                                    'Jendela' => 'fa-window',
                                ];
                            ?>
                            
                            <div class="room-facilities">
                                <span><i class="fa-solid fa-expand"></i> <?php echo e($room->size ?? '3x4m'); ?></span>
                                <!--[if BLOCK]><![endif]--><?php if(is_array($fasilitas) && count($fasilitas) > 0): ?>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span>
                                            <i class="fa-solid <?php echo e($iconMap[$item] ?? 'fa-check'); ?>"></i> 
                                            <?php echo e($item); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                <?php else: ?>
                                    <span><i class="fa-solid fa-wifi"></i> WiFi</span>
                                    <span><i class="fa-solid fa-bed"></i> Kasur</span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            
                            <div class="booking">
                                <h5>Rp <?php echo e(number_format($room->price, 0, ',', '.')); ?><span>/Bulan</span></h5>
                                <a href="<?php echo e(route('rooms.show', $room->slug)); ?>" class="theme-btn">
                                    Lihat Detail
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="fa-solid fa-info-circle fa-3x mb-3"></i>
                        <h4>Tidak Ada Kamar Ditemukan</h4>
                        <p>Coba ubah filter pencarian Anda atau <button wire:click="resetFilters" class="btn btn-link">reset filter</button></p>
                    </div>
                </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <!-- Pagination -->
            <!--[if BLOCK]><![endif]--><?php if($rooms->hasPages()): ?>
            <div class="page-nav-wrap mt-5">
                <ul>
                    
                    <!--[if BLOCK]><![endif]--><?php if($rooms->onFirstPage()): ?>
                        <li class="disabled"><span class="page-numbers"><i class="fal fa-long-arrow-left"></i></span></li>
                    <?php else: ?>
                        <li><a class="page-numbers" href="#" wire:click.prevent="previousPage"><i class="fal fa-long-arrow-left"></i></a></li>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $rooms->getUrlRange(1, $rooms->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!--[if BLOCK]><![endif]--><?php if($page == $rooms->currentPage()): ?>
                            <li class="active"><a class="page-numbers"><?php echo e(sprintf('%02d', $page)); ?></a></li>
                        <?php else: ?>
                            <li><a class="page-numbers" href="#" wire:click.prevent="gotoPage(<?php echo e($page); ?>)"><?php echo e(sprintf('%02d', $page)); ?></a></li>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                    
                    <!--[if BLOCK]><![endif]--><?php if($rooms->hasMorePages()): ?>
                        <li><a class="page-numbers" href="#" wire:click.prevent="nextPage"><i class="fal fa-long-arrow-right"></i></a></li>
                    <?php else: ?>
                        <li class="disabled"><span class="page-numbers"><i class="fal fa-long-arrow-right"></i></span></li>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </ul>
            </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </section>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    /* Filter Bar Styles */
    .filter-bar-wrapper {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }
    
    .filter-group {
        position: relative;
    }
    
    .filter-label {
        display: block;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    .filter-input,
    .filter-select {
        width: 100%;
        height: 48px;
        padding: 12px 15px;
        border: 1px solid #e1e8ed;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
        background: #fff;
        color: #1a1a1a;
        font-weight: 500;
    }
    
    .filter-input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }
    
    .filter-input:focus,
    .filter-select:focus {
        border-color: #2196F3;
        color: #2196F3;
        outline: none;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }
    
    .filter-reset-btn {
        width: 100%;
        padding: 12px 24px;
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
    }
    
    .filter-reset-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
    }
    
    .filter-reset-btn i {
        margin-right: 5px;
    }

    /* Room Card Enhancements */
    .destination-card-items {
        transition: all 0.3s;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    }
    
    .destination-card-items:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    
    .destination-thumb {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: #f8f9fa;
    }
    
    .destination-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    
    /* Placeholder Container - Lebih Baik */
    .placeholder-container {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        color: white;
    }
    
    .placeholder-container i {
        font-size: 60px;
        margin-bottom: 15px;
        opacity: 0.9;
    }
    
    .placeholder-container p {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        text-align: center;
        padding: 0 20px;
    }
    
    .destination-card-items:hover .destination-thumb img {
        transform: scale(1.1);
    }
    
    /* Status Ribbon - POSISI HORIZONTAL DI ATAS */
    .destination-thumb .ratting.status-ribbon {
        position: absolute !important;
        top: 20px !important;
        left: 20px !important;
        right: auto !important;
        bottom: auto !important;
        transform: none !important;
        font-size: 13px !important;
        padding: 10px 16px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 7px !important;
        font-weight: 700 !important;
        box-shadow: 0 3px 10px rgba(0,0,0,0.25) !important;
        border-radius: 6px !important;
        z-index: 10 !important;
        color: white !important;
        border: none !important;
        margin: 0 !important;
        line-height: 1 !important;
    }
    
    .destination-thumb .ratting.status-ribbon i {
        font-size: 13px !important;
        margin: 0 !important;
    }
    
    .destination-thumb .ratting.status-ribbon span {
        font-size: 13px !important;
        font-weight: 700 !important;
        letter-spacing: 0.8px !important;
        margin: 0 !important;
    }
    
    .room-desc {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
        margin: 10px 0;
    }
    
    .room-facilities {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin: 15px 0;
        padding: 15px 0;
        border-top: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
        min-height: auto;
        max-height: none;
        overflow: visible;
    }
    
    .room-facilities span {
        font-size: 12px;
        color: #2c3e50;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #f1f5f9;
        padding: 7px 12px;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        white-space: nowrap;
        font-weight: 500;
        flex-shrink: 0;
    }
    
    .room-facilities i {
        color: #2196F3;
        font-size: 13px;
        flex-shrink: 0;
    }
    
    .booking {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 15px;
        gap: 15px;
    }
    
    .booking h5 {
        color: #2196F3;
        font-size: 22px;
        font-weight: 700;
        margin: 0;
    }
    
    .booking h5 span {
        font-size: 14px;
        color: #666;
        font-weight: 400;
    }
    
    .booking .theme-btn {
        padding: 12px 24px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%) !important;
        color: white !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(33, 150, 243, 0.4) !important;
        transition: all 0.3s !important;
        white-space: nowrap;
    }
    
    .booking .theme-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(33, 150, 243, 0.5) !important;
    }
    
    .booking .theme-btn i {
        margin-left: 5px;
    }
    
    /* Pagination Styles */
    .page-nav-wrap ul li.disabled span {
        opacity: 0.4;
        cursor: not-allowed;
    }
    
    .page-nav-wrap ul li a {
        cursor: pointer;
    }

    /* Loading State */
    [wire\\:loading] {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .filter-bar-wrapper {
            padding: 20px;
        }
        
        .filter-reset-btn {
            margin-top: 10px;
        }
        
        .destination-thumb {
            height: 200px;
        }
    }
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\file-belajar-website-IDN\final-project-smstr1\resources\views/livewire/public/room-catalog.blade.php ENDPATH**/ ?>