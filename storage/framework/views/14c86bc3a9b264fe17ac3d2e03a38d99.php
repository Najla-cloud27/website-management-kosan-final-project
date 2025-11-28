<div>
    <?php echo $__env->make('layouts.partials.page-title', [
        'title' => 'Riwayat Tagihan',
        'breadcrumbs' => [
            ['label' => 'Penyewa', 'url' => route('tenant.dashboard')],
            ['label' => 'Riwayat Tagihan']
        ]
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="card-title"><?php echo e($bill->bill_code); ?></h5>
                                <p class="mb-1"><strong>Jumlah:</strong> Rp <?php echo e(number_format($bill->total_amount, 0, ',', '.')); ?></p>
                                <p class="mb-1"><strong>Tanggal:</strong> <?php echo e($bill->created_at->format('d M Y')); ?></p>
                                <p class="mb-1">
                                    <strong>Status:</strong>
                                    <span class="badge <?php echo e(status_badge_class($bill->status)); ?>"><?php echo e(format_status($bill->status)); ?></span>
                                </p>

                                <?php if($bill->paymentProofs->count() > 0): ?>
                                    <div class="mt-2">
                                        <small><strong>Bukti Pembayaran:</strong></small>
                                        <?php $__currentLoopData = $bill->paymentProofs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <span class="badge <?php echo e(status_badge_class($proof->status)); ?>">
                                                    <?php echo e(format_status($proof->status)); ?>

                                                </span>
                                                <small class="text-muted"><?php echo e($proof->created_at->format('d M Y, H:i')); ?></small>
                                                <?php if($proof->admin_notes): ?>
                                                    <small class="text-muted">- Catatan: <?php echo e($proof->admin_notes); ?></small>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 text-end">
                                <?php if($bill->status === 'belum_dibayar' || ($bill->status === 'verifikasi_tertunda' && $bill->paymentProofs->where('status', 'rejected')->count() > 0)): ?>
                                    <button type="button" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#uploadModal<?php echo e($bill->id); ?>" wire:click="$set('uploadingForBillId', <?php echo e($bill->id); ?>)">
                                        <i data-lucide="upload" class="icon-dual icon-xs me-1"></i> Upload Bukti Bayar
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Modal -->
            <div class="modal fade" id="uploadModal<?php echo e($bill->id); ?>" tabindex="-1" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Tagihan:</strong> <?php echo e($bill->bill_code); ?></p>
                            <p><strong>Jumlah:</strong> Rp <?php echo e(number_format($bill->total_amount, 0, ',', '.')); ?></p>
                            
                            <div class="mb-3">
                                <label class="form-label">Pilih File Bukti Pembayaran (JPG, PNG, max 2MB)</label>
                                <input type="file" 
                                       wire:model="proofFile" 
                                       class="form-control <?php $__errorArgs = ['proofFile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       accept="image/jpeg,image/png,image/jpg">
                                <?php $__errorArgs = ['proofFile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                
                                <div wire:loading wire:target="proofFile" class="mt-2">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <small class="text-muted ms-2">Mengupload file...</small>
                                </div>
                            </div>

                            <?php if($uploadingForBillId == $bill->id && $proofFile): ?>
                                <div class="mt-2">
                                    <label class="form-label">Preview:</label>
                                    <img src="<?php echo e($proofFile->temporaryUrl()); ?>" class="img-thumbnail d-block" style="max-width: 100%; max-height: 300px;">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" 
                                    wire:click="uploadProof" 
                                    class="btn btn-primary" 
                                    <?php if(!$proofFile || $uploadingForBillId != $bill->id): ?> disabled <?php endif; ?>
                                    wire:loading.attr="disabled" 
                                    wire:target="uploadProof">
                                <span wire:loading.remove wire:target="uploadProof">
                                    <i data-lucide="upload" class="icon-xs me-1"></i> Upload
                                </span>
                                <span wire:loading wire:target="uploadProof">
                                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                    Uploading...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Belum ada tagihan.
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <?php echo e($bills->links()); ?>

    </div>
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

        // Listen for upload success event to close modal
        Livewire.on('payment-uploaded', () => {
            // Close all modals
            const modals = document.querySelectorAll('.modal.show');
            modals.forEach(modal => {
                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                }
            });
            
            // Remove backdrop manually if still exists
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
            
            // Remove modal-open class from body
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\final-project-smstr1\resources\views\livewire\tenant\billing\history.blade.php ENDPATH**/ ?>