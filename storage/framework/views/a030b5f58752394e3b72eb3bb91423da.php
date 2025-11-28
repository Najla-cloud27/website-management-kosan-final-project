<div>
    
    <?php echo $__env->make('layouts.partials.page-title', [
        'title' => 'Manajemen Keluhan',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Kelola Keluhan']
        ]
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="Cari judul atau nama penyewa...">
                </div>
                <div class="col-md-3">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="diproses">Diproses</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Complaints Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Penyewa</th>
                            <th>Kamar</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($complaint->id); ?></td>
                                <td><?php echo e($complaint->user->name); ?></td>
                                <td><?php echo e($complaint->room->name); ?></td>
                                <td>
                                    <?php echo e($complaint->title); ?>

                                    <?php if($complaint->image_url): ?>
                                        <i class="bi bi-image text-primary" title="Ada gambar"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <select wire:change="updateStatus(<?php echo e($complaint->id); ?>, $event.target.value)" 
                                            class="form-select form-select-sm">
                                        <option value="dikirim" <?php echo e($complaint->status === 'dikirim' ? 'selected' : ''); ?>>Dikirim</option>
                                        <option value="diproses" <?php echo e($complaint->status === 'diproses' ? 'selected' : ''); ?>>Diproses</option>
                                        <option value="ditolak" <?php echo e($complaint->status === 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                                        <option value="selesai" <?php echo e($complaint->status === 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                                    </select>
                                </td>
                                <td><?php echo e($complaint->created_at->format('d M Y')); ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal<?php echo e($complaint->id); ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button wire:click="deleteComplaint(<?php echo e($complaint->id); ?>)" 
                                            wire:confirm="Yakin ingin menghapus keluhan ini?"
                                            class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="detailModal<?php echo e($complaint->id); ?>" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Keluhan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-sm-3">Penyewa:</dt>
                                                <dd class="col-sm-9"><?php echo e($complaint->user->name); ?></dd>
                                                
                                                <dt class="col-sm-3">Kamar:</dt>
                                                <dd class="col-sm-9"><?php echo e($complaint->room->name); ?></dd>
                                                
                                                <dt class="col-sm-3">Judul:</dt>
                                                <dd class="col-sm-9"><?php echo e($complaint->title); ?></dd>
                                                
                                                <dt class="col-sm-3">Deskripsi:</dt>
                                                <dd class="col-sm-9"><?php echo e($complaint->description); ?></dd>
                                                
                                                <dt class="col-sm-3">Status:</dt>
                                                <dd class="col-sm-9"><span class="badge <?php echo e(status_badge_class($complaint->status)); ?>"><?php echo e(format_status($complaint->status)); ?></span></dd>
                                                
                                                <dt class="col-sm-3">Tanggal:</dt>
                                                <dd class="col-sm-9"><?php echo e($complaint->created_at->format('d M Y, H:i')); ?></dd>
                                            </dl>
                                            
                                            <?php if($complaint->image_url): ?>
                                                <div class="mt-3">
                                                    <strong>Gambar:</strong><br>
                                                    <img src="<?php echo e(Storage::url($complaint->image_url)); ?>" class="img-fluid" style="max-height: 400px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada keluhan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                <?php echo e($complaints->links()); ?>

            </div>
        </div>
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
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\final-project-smstr1\resources\views\livewire\admin\complaint\manage-complaints.blade.php ENDPATH**/ ?>