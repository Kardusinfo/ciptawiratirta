<style>
    .banner-section-nine {
        position: relative;
        background-repeat: no-repeat;
        height: 80vh;
    }

    .banner-section-nine::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
    }

    .modal-container {
        background: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center;
        /* pointer-events: none; */
        /* opacity: 0; */
        display: none;
    }

    .modal-custom {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        max-width: 100%;
        height: auto;
        max-height: 80%;
    }

    .modal-image {
        width: 600px;
        max-width: 100%;
        height: auto;
        max-height: 80%;
    }

    .modal-close {
        position: absolute;
        top: 0;
        right: 0;
        width: 32px;
        height: 32px;
        z-index: 9999;
        background: #0e0e0e;
        cursor: pointer;
    }

    .modal-close:hover {
        background: #474747;
    }

    .modal-close-line {
        position: absolute;
        top: 16px;
        right: 8px;
        width: 16px;
        height: 2px;
        background: #fefefe;
    }

    .modal-close-line.one {
        transform: rotate(45deg);
    }

    .modal-close-line.two {
        transform: rotate(-45deg);
    }
</style>
<section class="banner-section-nine"
    style="background-image: url(<?php if(!empty($banner_image)): ?> <?php echo e($banner_image_url); ?> <?php endif; ?>)">
    <div class="auto-container">
        <div class="cotnent-box">

            <div class="title-box wow fadeInUp" data-wow-delay='300ms'>
                <h3><?php echo $title; ?></h3>
                <div class="text"><?php echo e($sub_title); ?></div>
            </div>

            

            <div id="modal_container" class="modal-container">
                <div class="modal-custom">
                    
                    <a class="go-to" href="/page/recruitment-procedure">
                        
                        

                        <?php if($logo_id = setting_item('banner_id')): ?>
                            <?php $logo = get_file_url($logo_id,'full') ?>
                            <img src="<?php echo e($logo); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset('/popup.png')); ?>" alt="logo">
                        <?php endif; ?>

                    </a>
                    
                    <div id="modal_close" class="modal-close">
                        <span class="modal-close-line one"></span>
                        <span class="modal-close-line two"></span>
                    </div>
                </div>
            </div>

            <!-- Job Search Form -->
            
            <!-- Job Search Form -->

            <!-- Fun Fact Section -->
            <?php if(!empty($list_counter)): ?>
                <div class="fun-fact-section">
                    <div class="row">
                        <!--Column-->
                        <?php $__currentLoopData = $list_counter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                                <div class="count-box"><span class="count-text" data-speed="3000"
                                        data-stop="<?php echo e($counter['title']); ?>">0</span></div>
                                <h4 class="counter-title"><?php echo e($counter['sub_title']); ?></h4>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Fun Fact Section -->
        </div>
    </div>
</section>

<?php echo $__env->yieldContent('script.body'); ?>
<script type="text/javascript">
    window.onload = function() {
        var modal_container = document.getElementById("modal_container");
        var modal_close = document.getElementById("modal_close");

        setTimeout((event) => {
            modal_container.style.display = 'block';
        }, 2000);

        modal_close.onclick = function() {
            modal_container.style.display = 'none';
        }
    }
</script>
<?php /**PATH /Users/failamir/Sites/localhost/superio200/modules/Template/Views/frontend/blocks/hero-banner/style_9.blade.php ENDPATH**/ ?>