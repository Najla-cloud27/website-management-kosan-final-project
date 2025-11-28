<div>
    <?php echo $__env->make('layouts.partials.page-title', [
        'title' => 'Dashboard Penyewa',
        'breadcrumbs' => [
            ['label' => 'Penyewa', 'url' => route('tenant.dashboard')],
            ['label' => 'Dashboard']
        ]
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Tagihan Belum Dibayar</h5>
                    <h2><?php echo e($stats['unpaid_bills']); ?></h2>
                    <a href="<?php echo e(route('tenant.billing.history')); ?>" class="btn btn-light btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Keluhan Aktif</h5>
                    <h2><?php echo e($stats['active_complaints']); ?></h2>
                    <a href="<?php echo e(route('tenant.complaints.index')); ?>" class="btn btn-light btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Booking Aktif</h5>
                    <h2><?php echo e($stats['active_bookings']); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-megaphone"></i> Pengumuman Terbaru</h5>
        </div>
        <div class="card-body">
            <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="mb-3 pb-3 <?php echo e(!$loop->last ? 'border-bottom' : ''); ?>">
                    <h6 class="mb-2"><?php echo e($announcement->title); ?></h6>
                    <p class="mb-1"><?php echo e($announcement->content); ?></p>
                    <small class="text-muted">
                        <i class="bi bi-clock"></i> <?php echo e($announcement->created_at->format('d M Y, H:i')); ?>

                    </small>
                    <?php if($announcement->image_url): ?>
                        <div class="mt-2">
                            <img src="<?php echo e(Storage::url($announcement->image_url)); ?>" class="img-fluid" style="max-height: 200px;">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-muted mb-0">Belum ada pengumuman.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Bills -->
    <?php if($recentBills->count() > 0): ?>
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-receipt"></i> Tagihan Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $recentBills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($bill->bill_code); ?></td>
                                    <td>Rp <?php echo e(number_format($bill->total_amount, 0, ',', '.')); ?></td>
                                    <td><span class="badge <?php echo e(status_badge_class($bill->status)); ?>"><?php echo e(format_status($bill->status)); ?></span></td>
                                    <td><?php echo e($bill->created_at->format('d M Y')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <a href="<?php echo e(route('tenant.billing.history')); ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
            </div>
        </div>
    <?php endif; ?>

    <!-- Active Bookings -->
    <?php if($activeBookings->count() > 0): ?>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-house-check"></i> Booking Aktif</h5>
            </div>
            <div class="card-body">
                <?php $__currentLoopData = $activeBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 <?php echo e(!$loop->last ? 'border-bottom' : ''); ?>">
                        <div>
                            <strong><?php echo e($booking->room->name); ?></strong><br>
                            <small>Kode: <?php echo e($booking->booking_code); ?></small><br>
                            <small>Check-in: <?php echo e($booking->planned_check_in_date ? $booking->planned_check_in_date->format('d M Y') : '-'); ?></small>
                        </div>
                        <span class="badge <?php echo e(status_badge_class($booking->status)); ?>">
                            <?php echo e(format_status($booking->status)); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Initialize Lucide icons after Livewire updates
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons({ icons: window.lucide.icons });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\final-project-smstr1\resources\views\livewire\tenant\dashboard.blade.php ENDPATH**/ ?>