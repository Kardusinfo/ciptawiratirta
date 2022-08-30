<?php $__env->startSection('content'); ?>
<<<<<<< Updated upstream
    <div class="login-section">
        <div class="image-layer" style="background-image: url(<?php echo e(asset('module/superio/images/background/12.jpg')); ?>);"></div>
=======
<div class="row">
    <div class="col-md-4 mx-auto">
        <div class="text-center">
        <br>
        <?php if($site_logo = setting_item('logo_id')): ?>
            <div class="logo">
                <a href="<?php echo e(url('/')); ?>">
                    <?php $logo = get_file_url($site_logo,'full') ?>
                    <img src="<?php echo e($logo); ?>" alt="<?php echo e(setting_item('site_title')); ?>">
                </a>
            </div>
        <?php endif; ?>
        <br>

        
>>>>>>> Stashed changes
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
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout::auth.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/resources/views/auth/register.blade.php ENDPATH**/ ?>