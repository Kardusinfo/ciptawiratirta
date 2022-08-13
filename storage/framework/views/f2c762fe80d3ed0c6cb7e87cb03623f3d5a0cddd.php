
<?php $__env->startSection('content'); ?>
    <?php if($row->template_id): ?>
        <div class="page-template-content page-<?php echo e($row->slug); ?>">
            <?php echo $row->getProcessedContent(); ?>

        </div>
    <?php else: ?>
        <section class="tnc-section">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <h2><?php echo e($translation->title); ?></h2>
                    <div class="text"><a href="<?php echo e(home_url()); ?>"><?php echo e(__("Home")); ?></a> / <?php echo e($translation->title); ?></div>
                </div>
                <div class="blog-content">
                    <?php echo $translation->content; ?>

                </div>
            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<style>
    .tnc-section .blog-content img {
        border-radius: 8px;
        margin-bottom: 24px;
    }
</style>

<?php $__env->startSection('footer'); ?>
<script>
$(window).on('scroll', function() {
    if ($('.slideInDown').length > 0) {
        $('.logo_2').show();
        $('.logo_1').hide();

        $('.nav.main-menu ul .depth-1 a').attr('style', 'color:#051650 !important');

        $('.main-header.header-style-two.header-shaddow .main-box .outer-box .login-item .is_login').attr('style', 'color:#ffffff !important');
        $('.main-header.header-style-two.header-shaddow.fixed-header.animated.slideInDown .main-box .outer-box .login-item .is_login').attr('style', 'color:#ffffff !important');
    }else{
        $('.logo_2').hide();
        $('.logo_1').show();

        $('.nav.main-menu ul .depth-1 a').attr('style', 'color:#051650 !important');
        
        $('.main-header.header-style-two.header-shaddow .main-box .outer-box .login-item .is_login').attr('style', 'color:#051650 !important');
        $('.main-header.header-style-two.header-shaddow.fixed-header.animated.slideInDown .main-box .outer-box .login-item .is_login').attr('style', 'color:#ffffff !important');

    }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kardusinfo\superio200\modules/Page/Views/frontend/detail.blade.php ENDPATH**/ ?>