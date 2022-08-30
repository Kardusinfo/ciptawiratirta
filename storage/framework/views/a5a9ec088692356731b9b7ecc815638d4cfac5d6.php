<!-- Job Detail Section -->
<section class="job-detail-section">
    <div class="job-detail-outer">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="job-block-outer">
                        <!-- Job Block -->
                        <div class="job-block-seven">
                            <div class="inner-box">
                                <?php echo $__env->make("Job::frontend.layouts.details.upper-box", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="job-detail">
                        <?php echo @clean($translation->content); ?>

                    </div>

                    <?php echo $__env->make("Job::frontend.layouts.details.gallery", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make("Job::frontend.layouts.details.video", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <a href="/redirect.php" class="theme-btn btn-style-two">Recruitment Procudure</a>

                    <?php echo $__env->make("Job::frontend.layouts.details.social-share", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php if($row->map_lat && $row->map_lng): ?>
                        <?php echo $__env->make("Job::frontend.layouts.details.location", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    
                </div>

                <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">

                        <?php echo $__env->make("Job::frontend.layouts.details.apply-button", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="sidebar-widget">

                            <?php echo $__env->make("Job::frontend.layouts.details.overview", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            
                        </div>

                        <?php echo $__env->make("Job::frontend.layouts.details.company-2", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php if(!empty($row->company->id)): ?>
                            
                        <?php endif; ?>

                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Job Detail Section -->
<?php /**PATH /Users/failamir/Sites/localhost/superio200/modules/Job/Views/frontend/layouts/detail-ver/job-single-v2.blade.php ENDPATH**/ ?>