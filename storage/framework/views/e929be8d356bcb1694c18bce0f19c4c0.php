<div class="topbar-item">
    <div class="dropdown">
        <button aria-expanded="false" aria-haspopup="false"
            class="topbar-link dropdown-toggle drop-arrow-none" data-bs-auto-close="outside"
            data-bs-offset="0,24" data-bs-toggle="dropdown" type="button">
            <i class="fs-xxl" data-lucide="bell"></i>
            <!--[if BLOCK]><![endif]--><?php if($unreadCount > 0): ?>
                <span class="badge text-bg-danger badge-circle topbar-badge"><?php echo e($unreadCount > 9 ? '9+' : $unreadCount); ?></span>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </button>
        <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg" style="min-width: 360px; max-width: 400px;">
            <div class="px-3 py-2 border-bottom">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 fs-md fw-semibold">Notifikasi</h6>
                    </div>
                    <div class="col-auto">
                        <!--[if BLOCK]><![endif]--><?php if($unreadCount > 0): ?>
                            <button wire:click="markAllAsRead" class="btn btn-sm btn-link text-success text-decoration-none p-0" title="Tandai Semua Dibaca">
                                <i data-lucide="check-check" style="width: 16px; height: 16px;"></i>
                            </button>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </div>
            <div data-simplebar style="max-height: 400px; overflow-y: auto;">
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="dropdown-item notification-item py-2 <?php echo e($notification->is_read ? '' : 'bg-light'); ?>" 
                         wire:click="markAsRead(<?php echo e($notification->id); ?>)" 
                         style="cursor: pointer; white-space: normal; word-wrap: break-word;">
                        <div class="d-flex align-items-start gap-2">
                            <div class="flex-shrink-0 position-relative">
                                <span class="avatar-sm rounded-circle bg-<?php echo e($notification->is_read ? 'secondary' : 'primary'); ?> bg-opacity-10 d-flex align-items-center justify-content-center">
                                    <i data-lucide="bell" style="width: 18px; height: 18px;" class="text-<?php echo e($notification->is_read ? 'muted' : 'primary'); ?>"></i>
                                </span>
                                <!--[if BLOCK]><![endif]--><?php if(!$notification->is_read): ?>
                                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                        <span class="visually-hidden">New alerts</span>
                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="flex-grow-1" style="min-width: 0;">
                                <div class="fw-semibold text-dark mb-1" style="font-size: 0.875rem;"><?php echo e($notification->title); ?></div>
                                <div class="text-muted mb-1" style="font-size: 0.8125rem; line-height: 1.4;">
                                    <?php echo e(Str::limit($notification->message, 80)); ?>

                                </div>
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    <i data-lucide="clock" style="width: 12px; height: 12px;"></i>
                                    <?php echo e($notification->created_at->diffForHumans()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-4 text-muted">
                        <i data-lucide="bell-off" style="width: 48px; height: 48px;" class="d-block mx-auto mb-2 opacity-25"></i>
                        <p class="mb-0" style="font-size: 0.875rem;">Belum ada notifikasi</p>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            <!--[if BLOCK]><![endif]--><?php if($notifications->count() > 0): ?>
                <a class="dropdown-item text-center text-primary text-decoration-none fw-semibold border-top py-2"
                    href="javascript:void(0);" style="font-size: 0.875rem;">
                    Lihat Semua Notifikasi
                </a>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </div>
</div>

    <?php
        $__scriptKey = '1831774853-0';
        ob_start();
    ?>
<script>
    // Refresh notifications every 30 seconds
    setInterval(() => {
        $wire.refreshNotifications();
    }, 30000);
</script>
    <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Notification dropdown improvements */
    .notification-item {
        transition: background-color 0.2s ease;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .notification-item:last-child {
        border-bottom: none;
    }
    
    .notification-item:hover {
        background-color: #f8f9fa !important;
    }
    
    .notification-item .text-muted {
        word-break: break-word;
        overflow-wrap: break-word;
    }
    
    /* Ensure dropdown stays within viewport */
    .dropdown-menu-lg {
        max-width: 90vw !important;
    }
    
    @media (min-width: 768px) {
        .dropdown-menu-lg {
            max-width: 400px !important;
        }
    }
    
    /* Custom scrollbar for notification list */
    [data-simplebar] {
        overflow-x: hidden !important;
    }
    
    [data-simplebar]::-webkit-scrollbar {
        width: 6px;
    }
    
    [data-simplebar]::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    [data-simplebar]::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }
    
    [data-simplebar]::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<?php $__env->stopPush(); ?>

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
<?php /**PATH D:\file-belajar-website-IDN\final-project-smstr1\resources\views/livewire/notification-bell.blade.php ENDPATH**/ ?>