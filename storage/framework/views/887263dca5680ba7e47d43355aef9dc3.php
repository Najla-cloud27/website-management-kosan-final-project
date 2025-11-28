<?php if($title): ?>    
<div class="page-title-head d-flex align-items-center mb-4">
    <div class="flex-grow-1">
        <h4 class="fs-xl fw-bold m-0"><?php echo e($title); ?></h4>
    </div>
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="<?php echo e(url('/')); ?>">
                    <i data-lucide="home" class="icon-dual icon-xs me-1"></i>
                    Home
                </a>
            </li>
            
            <?php if(isset($breadcrumbs) && is_array($breadcrumbs)): ?>
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($breadcrumb['url']) && !$loop->last): ?>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e($breadcrumb['url']); ?>"><?php echo e($breadcrumb['label']); ?></a>
                        </li>
                    <?php else: ?>
                        <li class="breadcrumb-item active"><?php echo e($breadcrumb['label'] ?? $breadcrumb); ?></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php if(isset($subtitle)): ?>
                <li class="breadcrumb-item"><?php echo e($subtitle); ?></li>
                <?php endif; ?>
                <li class="breadcrumb-item active"><?php echo e($title); ?></li>
            <?php endif; ?>
        </ol>
    </div>
</div>
<?php endif; ?>
<?php /**PATH D:\final-project-smstr1\resources\views\layouts\partials\page-title.blade.php ENDPATH**/ ?>