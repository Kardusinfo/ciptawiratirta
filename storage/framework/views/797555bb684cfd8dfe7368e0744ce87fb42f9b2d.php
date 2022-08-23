    <?php
        $candidate = $row->candidate;
    ?>
    <div class="row">
        

        

        <div class="form-group">
            <label for="education_level"><?php echo e(__("Kantor CWT Mendaftar")); ?></label>
            <select class="form-control" id="education_level" name="education_level">
                <option value="" <?php if(old('education_level',@$candidate->education_level) == ''): ?> selected <?php endif; ?> ><?php echo e(__("Select")); ?></option>
                <option value="certificate" <?php if(old('education_level',@$candidate->education_level) == 'Jakarta'): ?> selected <?php endif; ?> ><?php echo e(__("Jakarta")); ?></option>
                <option value="diploma" <?php if(old('education_level',@$candidate->education_level) == 'Bali'): ?> selected <?php endif; ?> ><?php echo e(__("Bali")); ?></option>
                <option value="associate" <?php if(old('education_level',@$candidate->education_level) == 'Yogyakarta'): ?> selected <?php endif; ?> ><?php echo e(__("Yogyakarta")); ?></option>
                <option value="bachelor" <?php if(old('education_level',@$candidate->education_level) == 'Surabaya'): ?> selected <?php endif; ?> ><?php echo e(__("Surabaya")); ?></option>
                <option value="master" <?php if(old('education_level',@$candidate->education_level) == 'Bandung'): ?> selected <?php endif; ?> ><?php echo e(__("Bandung")); ?></option>
                
            </select>
        </div>

        <div class="form-group">
            <label for="gender"><?php echo e(__('Gender')); ?></label>
            <select class="form-control" id="gender" name="gender">
                <option value="" <?php if(old('gender', @$candidate->gender) == ''): ?> selected <?php endif; ?>>
                    <?php echo e(__('Select')); ?></option>
                <option value="male" <?php if(old('gender', @$candidate->gender) == 'male'): ?> selected <?php endif; ?>>
                    <?php echo e(__('Male')); ?></option>
                <option value="female" <?php if(old('gender', @$candidate->gender) == 'female'): ?> selected <?php endif; ?>>
                    <?php echo e(__('Female')); ?></option>
            </select>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo e(__("Language")); ?></label>
                <input type="text" value="<?php echo e(old('languages',@$candidate->languages)); ?>" name="languages" placeholder="<?php echo e(__("Language")); ?>" class="form-control">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label"><?php echo e(__("Video Url")); ?></label>
                <p><i><?php echo e(__("Insert a video, which shows anything about you")); ?></i></p>
                <input type="text" name="video" class="form-control" value="<?php echo e(old('video',@$candidate->video)); ?>" placeholder="<?php echo e(__("Youtube link video")); ?>">
            </div>
        </div>

        <?php if(is_default_lang()): ?>
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo e(__("Video Cover Image")); ?></label>
                    <div class="form-group">
                        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('video_cover_id',@$candidate->video_cover_id); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label"><?php echo e(__("Gallery")); ?> (<?php echo e(__('Recommended size image:1080 x 1920px')); ?>)</label>
                <?php
                    $gallery_id = @$candidate->gallery ?? old('gallery');
                ?>
                <?php echo \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery', $gallery_id); ?>

            </div>
        </div>
    </div>



<?php /**PATH D:\fadjar\gawean\superio200\modules/Candidate/Views/admin/candidate/form.blade.php ENDPATH**/ ?>