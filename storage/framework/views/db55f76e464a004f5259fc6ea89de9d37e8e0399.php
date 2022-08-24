<style>
    .theme-btn {
        font-size: 1rem;
    }
</style>

<section class="call-to-action-two" <?php if(!empty($bg_image_url)): ?> style="background-image: url(<?php echo e($bg_image_url ?? ""); ?>) !important;" <?php endif; ?>>
    <div class="auto-container">
        <div class="sec-title light text-center">
            <h2><?php echo e($title); ?></h2>
            <div class="text"><?php echo e($sub_title); ?></div>
        </div>

        <div class="btn-box">
            
            <a href="<?php echo e('/job'); ?>" class="theme-btn  btn-style-three">Find Jobs</a>
            <a href="<?php echo e('/page/recruitment-procedure'); ?>" class="theme-btn btn-style-two">Recruitment Procudure</a>
        </div>
    </div>
</section>
<?php /**PATH D:\gawean\project mas chan\superio200\modules/Template/Views/frontend/blocks/call-to-action/style_1.blade.php ENDPATH**/ ?>