<div>
    <?php echo $__env->make('layouts.partials.page-title', [
        'title' => 'Daftar Keluhan',
        'breadcrumbs' => [
            ['label' => 'Penyewa', 'url' => route('tenant.dashboard')],
            ['label' => 'Keluhan']
        ]
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="mb-3">
        <a href="<?php echo e(route('tenant.complaints.create')); ?>" class="btn btn-soft-primary">
            <i data-lucide="plus-circle" class="icon-xs me-1"></i> Buat Keluhan Baru
        </a>
    </div>

    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!-- Filter -->
    <div class="card mb-3">
        <div class="card-body">
            <select wire:model.live="statusFilter" class="form-select" style="max-width: 200px;">
                <option value="">Semua Status</option>
                <option value="dikirim">Dikirim</option>
                <option value="diproses">Diproses</option>
                <option value="ditolak">Ditolak</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
    </div>

    <!-- Complaints List -->
    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1">
                        <h5><?php echo e($complaint->title); ?></h5>
                        <p class="text-muted mb-2">
                            <i class="bi bi-door-open"></i> <?php echo e($complaint->room->name); ?> |
                            <i class="bi bi-clock"></i> <?php echo e($complaint->created_at->format('d M Y')); ?>

                        </p>
                        <p><?php echo e($complaint->description); ?></p>
                        <!--[if BLOCK]><![endif]--><?php if($complaint->image_url): ?>
                            <img src="<?php echo e(Storage::url($complaint->image_url)); ?>" class="img-thumbnail" style="max-width: 200px;">
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="ms-3">
                        <span class="badge <?php echo e(status_badge_class($complaint->status)); ?>">
                            <?php echo e(format_status($complaint->status)); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="alert alert-info">
            Belum ada keluhan. <a href="<?php echo e(route('tenant.complaints.create')); ?>">Buat keluhan baru</a>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <?php echo e($complaints->links()); ?>

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
<?php /**PATH D:\final-project-smstr1\resources\views/livewire/tenant/complaint/complaint-list.blade.php ENDPATH**/ ?>