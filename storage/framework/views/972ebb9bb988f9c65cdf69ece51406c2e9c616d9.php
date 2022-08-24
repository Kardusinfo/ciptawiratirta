<!--Page Title-->
<section class="page-title style-two">
    <div class="auto-container">
        <!-- Job Search Form -->
        <div class="job-search-form">
            <?php echo $__env->make("Job::frontend.layouts.form-search.form-banner-1", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- Job Search Form -->
    </div>
</section>
<!--End Page Title-->

<!-- Listing Section -->
<section class="ls-section">
    <div class="auto-container">
        <div class="filters-backdrop"></div>

        <div class="row">

            <!-- Filters Column -->
            

            <!-- Content Column -->
            <div class="content-column col-lg-12 col-sm-12 col-sm-12">
                <div class="ls-outer">
                    <button type="button" class="theme-btn btn-style-two toggle-filters"><?php echo e(__("Show Filters")); ?></button>

                <?php if(!empty($rows) && count($rows) > 0): ?>
                    <!-- ls Switcher -->
                        <div class="ls-switcher">
                            <div class="showing-result">
                                <div class="text"><?php echo e(__("Showing")); ?> <strong><?php echo e($rows->firstItem()); ?>-<?php echo e($rows->lastItem()); ?></strong> <?php echo e(__("of")); ?> <strong><?php echo e($rows->total()); ?></strong> <?php echo e(__("jobs")); ?></div>
                            </div>
                            <div class="sort-by">
                                <form class="bc-form-order" method="get" action="<?php echo e(route('job.search')); ?>" >
                                    <?php echo $__env->make("Job::frontend.layouts.search.order-sort", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <div class="job-block-four col-lg-4 col-md-6 col-sm-12">
                                    <?php echo $__env->make("Job::frontend.layouts.loop.job-item-4", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    <!-- Pagination -->
                        <nav class="ls-pagination">
                            <?php echo e($rows->appends(request()->query())->links()); ?>

                        </nav>

                    <?php else: ?>
                        <div class="job-results-not-found">
                            <h3><?php echo e(__("No job results found")); ?></h3>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Listing Page Section -->
<?php /**PATH /Users/failamir/Sites/localhost/superio200/modules/Job/Views/frontend/layouts/search/job-list-v6.blade.php ENDPATH**/ ?>