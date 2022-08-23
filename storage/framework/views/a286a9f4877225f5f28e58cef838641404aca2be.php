<?php if(!empty($breadcrumbs)): ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-no-gutter mb-0 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo e(url('')); ?>"><?php echo e(__('Home')); ?></a></li>
            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 <?php echo e($breadcrumb['class'] ?? ''); ?>">
                    <?php if(!empty($breadcrumb['url'])): ?>
                        <a href="<?php echo e(url($breadcrumb['url'])); ?>"><?php echo e($breadcrumb['name']); ?></a>
                    <?php else: ?>
                        <?php echo e($breadcrumb['name']); ?>

                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </nav>
<?php endif; ?><?php /**PATH /home/forkomdi/ciptawiratirta.com/modules/Layout/parts/bc.blade.php ENDPATH**/ ?>