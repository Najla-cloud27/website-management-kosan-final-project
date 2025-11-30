<div>
    
    <?php echo $__env->make('layouts.partials.page-title', [
        'title' => 'Manajemen Tagihan',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Tagihan & Pembayaran']
        ]
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Kelola Tagihan & Pembayaran</h5>
        <button wire:click="exportPayments" class="btn btn-soft-success">
            <i data-lucide="file-spreadsheet" style="width: 16px; height: 16px;" class="me-1"></i> Export Excel
        </button>
    </div>

    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link <?php echo e($activeTab === 'bills' ? 'active' : ''); ?>" 
               wire:click="$set('activeTab', 'bills')" href="javascript:void(0)" style="cursor: pointer;">
                <i data-lucide="receipt" style="width: 16px; height: 16px;" class="me-1"></i> Semua Tagihan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e($activeTab === 'pending_proofs' ? 'active' : ''); ?>" 
               wire:click="$set('activeTab', 'pending_proofs')" href="javascript:void(0)" style="cursor: pointer;">
                <i data-lucide="clock" style="width: 16px; height: 16px;" class="me-1"></i> Verifikasi Pembayaran
            </a>
        </li>
    </ul>

    <!--[if BLOCK]><![endif]--><?php if($activeTab === 'bills'): ?>
        <button wire:click="$toggle('showGenerateForm')" class="btn btn-soft-primary mb-3">
            <i data-lucide="plus-circle" style="width: 16px; height: 16px;" class="me-1"></i> Buat Tagihan Baru
        </button>

        <!--[if BLOCK]><![endif]--><?php if($showGenerateForm): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Buat Tagihan Baru</h5>
                    <form wire:submit.prevent="generateBill">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pilih Penyewa</label>
                                <select wire:model="selectedUserId" class="form-select <?php $__errorArgs = ['selectedUserId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih --</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tenant->id); ?>"><?php echo e($tenant->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selectedUserId'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jumlah (Rp)</label>
                                <input type="text" wire:model="billAmount" data-rupiah class="form-control <?php $__errorArgs = ['billAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Masukkan jumlah">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['billAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-soft-success w-100">
                                    <i data-lucide="zap" style="width: 16px; height: 16px;" class="me-1"></i> Generate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Penyewa</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($bill->bill_code); ?></td>
                                <td><?php echo e($bill->user->name); ?></td>
                                <td>Rp <?php echo e(number_format($bill->total_amount, 0, ',', '.')); ?></td>
                                <td><span class="badge <?php echo e(status_badge_class($bill->status)); ?>"><?php echo e(format_status($bill->status)); ?></span></td>
                                <td>
                                    <button wire:click="deleteBill(<?php echo e($bill->id); ?>)" wire:confirm="Hapus tagihan ini?" class="btn btn-sm btn-soft-danger" title="Hapus">
                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="5" class="text-center">Belum ada tagihan</td></tr>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
                <?php echo e($bills->links()); ?>

            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if($activeTab === 'pending_proofs'): ?>
        <div class="row">
            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $pendingProofs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><?php echo e($proof->bill->bill_code); ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted d-block">Penyewa</small>
                                <strong><?php echo e($proof->user->name); ?></strong>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Jumlah Tagihan</small>
                                <h5 class="mb-0 text-primary">Rp <?php echo e(number_format($proof->bill->total_amount, 0, ',', '.')); ?></h5>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Bukti Pembayaran</small>
                                <!--[if BLOCK]><![endif]--><?php if($proof->payment_proof_url): ?>
                                    <div class="border rounded p-2 text-center bg-light">
                                        <img src="<?php echo e(asset('storage/' . $proof->payment_proof_url)); ?>" 
                                             class="img-fluid rounded" 
                                             style="max-height: 250px; width: 100%; object-fit: contain; cursor: pointer;"
                                             onclick="window.open('<?php echo e(asset('storage/' . $proof->payment_proof_url)); ?>', '_blank')"
                                             alt="Bukti Pembayaran"
                                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'200\'%3E%3Crect fill=\'%23ddd\' width=\'200\' height=\'200\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\'%3EGambar tidak ditemukan%3C/text%3E%3C/svg%3E';">
                                        <small class="text-muted d-block mt-2">Klik untuk memperbesar</small>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-warning mb-0">
                                        <i data-lucide="alert-triangle" style="width: 16px; height: 16px;" class="me-1"></i>
                                        Bukti pembayaran tidak tersedia
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="d-grid gap-2">
                                <button wire:click="verifyPayment(<?php echo e($proof->id); ?>, 'terverifikasi')" class="btn btn-success">
                                    <i data-lucide="check-circle" style="width: 16px; height: 16px;" class="me-1"></i> Terima
                                </button>
                                <button wire:click="verifyPayment(<?php echo e($proof->id); ?>, 'rejected', 'Bukti tidak valid')" class="btn btn-danger">
                                    <i data-lucide="x-circle" style="width: 16px; height: 16px;" class="me-1"></i> Tolak
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center py-4">
                        <i data-lucide="inbox" class="icon-lg mb-2" style="width: 48px; height: 48px;"></i>
                        <p class="mb-0">Tidak ada bukti pembayaran yang perlu diverifikasi.</p>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
        <?php echo e($pendingProofs->links()); ?>

    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Initialize Lucide icons
    function initIcons() {
        if (window.lucide && window.lucide.createIcons && window.lucide.icons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initIcons();
    });
    
    // Re-initialize icons after Livewire updates
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            initIcons();
        });
    });
    
    // Re-initialize after wire:navigate
    document.addEventListener('livewire:navigated', () => {
        initIcons();
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\file-belajar-website-IDN\final-project-smstr1\resources\views/livewire/admin/billing/manage-billing.blade.php ENDPATH**/ ?>