<?php $__env->startSection('content'); ?>
    <div class="login-section">
        <div class="image-layer" style="background-image: url(<?php echo e(asset('popup.png')); ?>);"></div>
        <div class="outer-box">
            <!-- Login Form -->
            <div class="login-form default-form bravo-login-form-page bravo-login-page">
                <?php if($site_title = setting_item('site_title')): ?>
                    <h3><?php echo e(__('Create a :site_title Account', ['site_title' => $site_title])); ?></h3>
                <?php else: ?>
                    <h3><?php echo e(__('Register')); ?></h3>
                <?php endif; ?>
                <?php echo $__env->make('Layout::auth.register-form', ['captcha_action' => 'register_normal'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout::auth.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/resources/views/auth/register.blade.php ENDPATH**/ ?>