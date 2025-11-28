<div>
    
    <?php echo $__env->make('layouts.partials.page-title', [
        'title' => 'Manajemen Pengumuman',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Pengumuman']
        ]
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Kelola Pengumuman</h5>
        <button wire:click="createNew" class="btn btn-soft-primary">
            <i data-lucide="plus" class="icon-dual icon-xs me-1"></i> Buat Pengumuman
        </button>
    </div>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($showForm): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h5><?php echo e($editingId ? 'Edit' : 'Buat'); ?> Pengumuman</h5>
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" wire:model="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten</label>
                        <textarea wire:model="content" class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="5"></textarea>
                        <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar (Optional)</label>
                        <input type="file" wire:model="image" class="form-control <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php if($image): ?>
                            <div class="mt-2">
                                <img src="<?php echo e($image->temporaryUrl()); ?>" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select wire:model="publish_status" class="form-select">
                            <option value="draf">Draf</option>
                            <option value="diterbitkan">Diterbitkan</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" wire:click="$set('showForm', false)" class="btn btn-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title"><?php echo e($announcement->title); ?></h5>
                            <span class="badge bg-<?php echo e($announcement->publish_status === 'diterbitkan' ? 'success' : 'secondary'); ?>">
                                <?php echo e(ucfirst($announcement->publish_status)); ?>

                            </span>
                        </div>
                        <p class="card-text"><?php echo e(Str::limit($announcement->content, 150)); ?></p>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-clock"></i> <?php echo e($announcement->created_at->format('d M Y, H:i')); ?>

                            <i class="bi bi-person ms-2"></i> <?php echo e($announcement->admin->name); ?>

                        </p>
                        <?php if($announcement->image_url): ?>
                            <img src="<?php echo e(Storage::url($announcement->image_url)); ?>" class="img-fluid mb-3" style="max-height: 200px;">
                        <?php endif; ?>
                        <div class="d-flex gap-2">
                            <button wire:click="edit(<?php echo e($announcement->id); ?>)" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button wire:click="togglePublish(<?php echo e($announcement->id); ?>)" class="btn btn-sm btn-info">
                                <i class="bi bi-<?php echo e($announcement->publish_status === 'diterbitkan' ? 'eye-slash' : 'eye'); ?>"></i>
                            </button>
                            <button wire:click="delete(<?php echo e($announcement->id); ?>)" wire:confirm="Hapus pengumuman?" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-info">Belum ada pengumuman.</div>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <?php echo e($announcements->links()); ?>

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
<?php /**PATH D:\final-project-smstr1\resources\views\livewire\admin\announcement\manager.blade.php ENDPATH**/ ?>