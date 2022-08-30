
<div class="">
    <?php if(empty($hide_avatar) && $company_logo = $row->getThumbnailUrl()): ?>
        
    <?php endif; ?>
    
    <h4><?php echo e($translation->title); ?></h4>
    <ul class="job-info">
        <?php if($row->category): ?>
            <?php $cat_translation = $row->category->translateOrOrigin(app()->getLocale()) ?>
            <li><span class="icon flaticon-briefcase"></span> <?php echo e($cat_translation->name); ?></li>
        <?php endif; ?>
        <?php if($row->location): ?>
            <?php $location_translation = $row->location->translateOrOrigin(app()->getLocale()) ?>
            <li><span class="icon flaticon-map-locator"></span> <?php echo e($location_translation->name); ?></li>
        <?php endif; ?>
        
        <?php if($row->salary_min): ?>
            <li><span class="icon flaticon-money"></span> <?php echo e($row->getSalary()); ?></li>
        <?php endif; ?>
    </ul>
    <ul class="job-other-info">
        <?php if($row->jobType): ?>
            <?php $jobType_translation = $row->jobType->translateOrOrigin(app()->getLocale()) ?>
            <li class="time"><?php echo e($jobType_translation->name); ?></li>
        <?php endif; ?>
        <?php if($row->is_featured): ?>
            <li class="privacy"><?php echo e(__("Featured")); ?></li>
        <?php endif; ?>
        <?php if($row->is_urgent): ?>
            <li class="required"><?php echo e(__("Urgent")); ?></li>
        <?php endif; ?>
    </ul>
</div>


<?php /**PATH /Users/failamir/Sites/localhost/superio200/modules/Job/Views/frontend/layouts/details/upper-box.blade.php ENDPATH**/ ?>