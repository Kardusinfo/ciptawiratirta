<!-- Other Options -->
<div class="other-options">
    <div class="social-share">
        <h5><?php echo e(__("Share this job")); ?></h5>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i> <?php echo e(__("Facebook")); ?></a>
        <a href="whatsapp://send?text=The text to share!<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i> <?php echo e(__("Whatsapp")); ?></a>
        <a href="https://www.instagram.com/?url=<?php echo e($row->getDetailUrl()); ?>&description=<?php echo e($translation->title); ?>" target="_blank" class="instagram"><i class="fab fa-instagram"></i> <?php echo e(__("Instagram")); ?></a>
    </div>
</div>

<!-- Other Options -->

<?php /**PATH /home/forkomdi/ciptawiratirta.com/modules/Job/Views/frontend/layouts/details/social-share.blade.php ENDPATH**/ ?>