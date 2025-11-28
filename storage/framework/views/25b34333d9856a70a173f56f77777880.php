<div>
    <?php echo $__env->make('layouts.partials.page-title', [
        'title' => 'Manajemen Booking',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Booking']
        ]
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i data-lucide="check-circle" class="icon-dual icon-xs me-1"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i data-lucide="alert-circle" class="icon-dual icon-xs me-1"></i>
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!-- Stats Cards -->
    <div class="row mb-3">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="badge bg-primary rounded-circle p-3">
                                <i data-lucide="calendar" class="icon-sm"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0"><?php echo e($stats['total']); ?></h5>
                            <p class="text-muted mb-0 fs-13">Total Booking</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="badge bg-warning rounded-circle p-3">
                                <i data-lucide="clock" class="icon-sm"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0"><?php echo e($stats['pending']); ?></h5>
                            <p class="text-muted mb-0 fs-13">Pembayaran Tertunda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="badge bg-success rounded-circle p-3">
                                <i data-lucide="check-circle" class="icon-sm"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0"><?php echo e($stats['confirmed']); ?></h5>
                            <p class="text-muted mb-0 fs-13">Dikonfirmasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span class="badge bg-danger rounded-circle p-3">
                                <i data-lucide="x-circle" class="icon-sm"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0"><?php echo e($stats['cancelled']); ?></h5>
                            <p class="text-muted mb-0 fs-13">Dibatalkan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Cari kode booking, nama user, atau kamar...">
                </div>
                <div class="col-md-6">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pembayaran_tertunda">Pembayaran Tertunda</option>
                        <option value="dikonfirmasi">Dikonfirmasi</option>
                        <option value="dibatalkan">Dibatalkan</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode Booking</th>
                            <th>User</th>
                            <th>Kamar</th>
                            <th>Durasi</th>
                            <th>Check-in</th>
                            <th>Status</th>
                            <th>Tanggal Booking</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong><?php echo e($booking->booking_code); ?></strong></td>
                            <td>
                                <div><?php echo e($booking->user->name); ?></div>
                                <small class="text-muted"><?php echo e($booking->user->email); ?></small>
                            </td>
                            <td><?php echo e($booking->room->name); ?></td>
                            <td><?php echo e($booking->duration_in_months); ?> bulan</td>
                            <td><?php echo e($booking->planned_check_in_date ? $booking->planned_check_in_date->format('d M Y') : '-'); ?></td>
                            <td>
                                <!--[if BLOCK]><![endif]--><?php if($booking->status === 'pembayaran_tertunda'): ?>
                                    <span class="badge bg-warning">Pembayaran Tertunda</span>
                                <?php elseif($booking->status === 'dikonfirmasi'): ?>
                                    <span class="badge bg-success">Dikonfirmasi</span>
                                <?php elseif($booking->status === 'dibatalkan'): ?>
                                    <span class="badge bg-danger">Dibatalkan</span>
                                <?php else: ?>
                                    <span class="badge bg-info">Selesai</span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td><?php echo e($booking->created_at->format('d M Y H:i')); ?></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button wire:click="editStatus(<?php echo e($booking->id); ?>)" class="btn btn-soft-primary" title="Edit Status">
                                        <i data-lucide="edit" class="icon-xs"></i>
                                    </button>
                                    <button wire:click="deleteBooking(<?php echo e($booking->id); ?>)" 
                                            wire:confirm="Apakah Anda yakin ingin menghapus booking ini?" 
                                            class="btn btn-soft-danger" 
                                            title="Hapus">
                                        <i data-lucide="trash-2" class="icon-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i data-lucide="inbox" class="icon-lg text-muted mb-2"></i>
                                <p class="text-muted mb-0">Tidak ada data booking</p>
                            </td>
                        </tr>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($bookings->links()); ?>

            </div>
        </div>
    </div>

    <!-- Modal Edit Status -->
    <!--[if BLOCK]><![endif]--><?php if($showModal && $selectedBooking): ?>
    <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status Booking</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><strong>Kode Booking:</strong></label>
                        <p><?php echo e($selectedBooking->booking_code); ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>User:</strong></label>
                        <p><?php echo e($selectedBooking->user->name); ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Kamar:</strong></label>
                        <p><?php echo e($selectedBooking->room->name); ?></p>
                    </div>
                    <div class="mb-3">
                        <label for="newStatus" class="form-label">Status</label>
                        <select wire:model="newStatus" id="newStatus" class="form-select">
                            <option value="pembayaran_tertunda">Pembayaran Tertunda</option>
                            <option value="dikonfirmasi">Dikonfirmasi</option>
                            <option value="dibatalkan">Dibatalkan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Batal</button>
                    <button type="button" class="btn btn-primary" wire:click="updateStatus">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH D:\final-project-smstr1\resources\views/livewire/admin/booking/manage-bookings.blade.php ENDPATH**/ ?>