<div>
    
    <?php echo $__env->make('layouts.partials.page-title', [
        'title' => 'Manajemen Kamar',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Manajemen Kamar']
        ]
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Kelola data kamar kosan</p>
        </div>
        <div class="d-flex gap-2">
            <button wire:click="exportRooms" class="btn btn-success">
                <i data-lucide="file-spreadsheet" class="icon-dual icon-xs me-1"></i> Export Excel
            </button>
            <button wire:click="createNew" class="btn btn-primary">
                <i data-lucide="plus" class="icon-dual icon-xs me-1"></i> Tambah Kamar
            </button>
        </div>
    </div>

    
    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i data-lucide="check-circle" class="icon-dual icon-xs me-1"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i data-lucide="alert-circle" class="icon-dual icon-xs me-1"></i>
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <?php if(session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i data-lucide="check-circle" class="icon-dual icon-xs me-1"></i>
            <?php echo e(session('message')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="position-relative">
                        <input type="text" wire:model.live="search" class="form-control ps-5" placeholder="Cari kamar...">
                        <i data-lucide="search" class="icon-dual icon-xs position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="terisi">Terisi</option>
                        <option value="sudah_dipesan">Sudah Dipesan</option>
                        <option value="pemeliharaan">Pemeliharaan</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    
    <!--[if BLOCK]><![endif]--><?php if($showForm): ?>
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="mb-0"><?php echo e($editingId ? 'Edit Kamar' : 'Tambah Kamar Baru'); ?></h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Kamar *</label>
                        <input type="text" wire:model="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Harga per Bulan (Rp) *</label>
                        <input type="text" wire:model="price" data-rupiah class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Masukkan harga">
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Panjang (meter) *</label>
                        <input type="number" step="0.1" wire:model="size_length" class="form-control <?php $__errorArgs = ['size_length'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="3">
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['size_length'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Lebar (meter) *</label>
                        <input type="number" step="0.1" wire:model="size_width" class="form-control <?php $__errorArgs = ['size_width'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="4">
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['size_width'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status *</label>
                        <select wire:model="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="tersedia">Tersedia</option>
                            <option value="terisi">Terisi</option>
                            <option value="sudah_dipesan">Sudah Dipesan</option>
                            <option value="pemeliharaan">Pemeliharaan</option>
                        </select>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Gambar Utama *</label>
                        <input type="file" wire:model="main_image" class="form-control <?php $__errorArgs = ['main_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['main_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        <!--[if BLOCK]><![endif]--><?php if($main_image): ?>
                            <img src="<?php echo e($main_image->temporaryUrl()); ?>" class="img-thumbnail mt-2" style="max-height: 100px">
                        <?php elseif($editingId): ?>
                            <?php $room = \App\Models\Room::find($editingId); ?>
                            <!--[if BLOCK]><![endif]--><?php if($room && $room->main_image_url): ?>
                                <img src="<?php echo e(asset('storage/' . $room->main_image_url)); ?>" class="img-thumbnail mt-2" style="max-height: 100px">
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea wire:model="description" rows="3" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"></textarea>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="col-12">
                        <label class="form-label">Fasilitas</label>
                        <div class="row g-2">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $availableFasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fasilitas_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" wire:model="fasilitas" value="<?php echo e($fasilitas_item); ?>" class="form-check-input" id="fas-<?php echo e($loop->index); ?>">
                                    <label class="form-check-label" for="fas-<?php echo e($loop->index); ?>"><?php echo e($fasilitas_item); ?></label>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Gambar Tambahan (Opsional)</label>
                        <input type="file" wire:model="additional_images" class="form-control" accept="image/*" multiple>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['additional_images.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        <!--[if BLOCK]><![endif]--><?php if($additional_images): ?>
                            <div class="d-flex gap-2 mt-2">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $additional_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="<?php echo e($image->temporaryUrl()); ?>" class="img-thumbnail" style="max-height: 100px">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <?php if($editingId): ?>
                        <?php $room = \App\Models\Room::with('images')->find($editingId); ?>
                        <!--[if BLOCK]><![endif]--><?php if($room && $room->images->count() > 0): ?>
                        <div class="col-12">
                            <label class="form-label">Gambar Tambahan Saat Ini</label>
                            <div class="d-flex gap-2 flex-wrap">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $room->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="position-relative">
                                    <img src="<?php echo e(asset('storage/' . $image->image_url_room)); ?>" class="img-thumbnail" style="max-height: 100px">
                                    <button type="button" wire:click="deleteImage(<?php echo e($image->id_room); ?>)" wire:confirm="Hapus gambar ini?" class="btn btn-danger btn-sm position-absolute top-0 end-0">
                                        <i data-lucide="x" class="icon-dual icon-xs"></i>
                                    </button>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="save" class="icon-dual icon-xs me-1"></i> <?php echo e($editingId ? 'Update' : 'Simpan'); ?>

                    </button>
                    <button type="button" wire:click="cancelForm" class="btn btn-secondary">
                        <i data-lucide="x" class="icon-dual icon-xs me-1"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-centered table-hover table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Kamar</th>
                            <th>Harga</th>
                            <th>Ukuran</th>
                            <th>Status</th>
                            <th>Fasilitas</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <!--[if BLOCK]><![endif]--><?php if($room->main_image_url): ?>
                    <img src="<?php echo e(asset('storage/rooms/' . $room->main_image_url)); ?>" style="width: 20px; height: 30px;">
                                <?php else: ?>
                                    <div class="avatar-md">
                                        <span class="avatar-title bg-soft-secondary text-secondary rounded fs-18">
                                            <i data-lucide="image"></i>
                                        </span>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td>
                                <strong><?php echo e($room->name); ?></strong>
                                <!--[if BLOCK]><![endif]--><?php if($room->description): ?>
                                    <br><small class="text-muted"><?php echo e(Str::limit($room->description, 50)); ?></small>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td>Rp <?php echo e(number_format($room->price, 0, ',', '.')); ?></td>
                            <td><?php echo e($room->size); ?> m²</td>
                            <td>
                                <span class="badge <?php echo e(status_badge_class($room->status)); ?>"><?php echo e(format_status($room->status)); ?></span>
                            </td>
                            <td>
                                <!--[if BLOCK]><![endif]--><?php if($room->fasilitas && is_array($room->fasilitas) && count($room->fasilitas) > 0): ?>
                                    <small><?php echo e(implode(', ', array_slice($room->fasilitas, 0, 3))); ?></small>
                                    <!--[if BLOCK]><![endif]--><?php if(count($room->fasilitas) > 3): ?>
                                        <small class="text-muted">+<?php echo e(count($room->fasilitas) - 3); ?></small>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                <?php else: ?>
                                    <small class="text-muted">-</small>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e($room->images_count); ?> foto</small>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button wire:click="edit(<?php echo e($room->id); ?>)" class="btn btn-sm btn-soft-primary" title="Edit">
                                        <i data-lucide="edit" class="icon-dual icon-xs"></i>
                                    </button>
                                    <button wire:click="delete(<?php echo e($room->id); ?>)" wire:confirm="Hapus kamar <?php echo e($room->name); ?>?" class="btn btn-sm btn-soft-danger" title="Hapus">
                                        <i data-lucide="trash-2" class="icon-dual icon-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i data-lucide="inbox" class="icon-dual" style="width: 64px; height: 64px;"></i>
                                    <p class="mt-2 mb-0">Belum ada kamar</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </tbody>
                </table>
            </div>
        </div>
        <!--[if BLOCK]><![endif]--><?php if($rooms->hasPages()): ?>
        <div class="card-footer">
            <?php echo e($rooms->links()); ?>

        </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Initialize Lucide icons after Livewire updates
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            // Reinitialize Lucide icons after DOM update
            if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons({ icons: window.lucide.icons });
            }
        });
    });

    // Also reinitialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\final-project-smstr1\resources\views/livewire/admin/room/manage-rooms.blade.php ENDPATH**/ ?>