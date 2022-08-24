<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('job.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? __('Edit: ').$row->title : __('Add new job')); ?></h1>
                    <?php if($row->slug): ?>
                        <p class="item-url-demo"><?php echo e(__("Permalink")); ?>: <?php echo e(url(config('job.job_route_prefix') )); ?>/<a href="#" class="open-edit-input" data-name="slug"><?php echo e($row->slug); ?></a>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if($row->slug): ?>
                        <a class="btn btn-default btn-sm" href="<?php echo e($row->getDetailUrl()); ?>" target="_blank"><i class="fa fa-eye"></i> <?php echo e(__("View Job")); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if($row->id): ?>
                <?php echo $__env->make('Language::admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">

                        <div class="panel">
                            <div class="panel-title"><strong><?php echo e(__("Job Content")); ?></strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label><?php echo e(__("Title")); ?></label>
                                    <input type="text" value="<?php echo e(old('title', $translation->title)); ?>" placeholder="<?php echo e(__("Title")); ?>" name="title" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo e(__("Content")); ?></label>
                                    <div class="">
                                        <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e(old('content', $translation->content)); ?></textarea>
                                    </div>
                                </div>
                                <?php if(is_default_lang()): ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo e(__("Expiration Date")); ?></label>
                                                <input type="text" readonly value="<?php echo e(old( 'expiration_date', $row->expiration_date ? date('Y/m/d', strtotime($row->expiration_date)) : '')); ?>" placeholder="YYYY/MM/DD" name="expiration_date" autocomplete="false" class="form-control has-datepicker bg-white">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender"><?php echo e(__("Gender")); ?></label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="Both" <?php if(old('gender', $row->gender) == 'Both'): ?> selected <?php endif; ?> ><?php echo e(__("Both")); ?></option>
                                                    <option value="Male" <?php if(old('gender', $row->gender) == 'Male'): ?> selected <?php endif; ?> ><?php echo e(__("Male")); ?></option>
                                                    <option value="Female" <?php if(old('gender', $row->gender) == 'Female'): ?> selected <?php endif; ?> ><?php echo e(__("Female")); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label"><?php echo e(__("Video Url")); ?></label>
                                                <input type="text" name="video" class="form-control" value="<?php echo e(old('video',$row->video)); ?>" placeholder="<?php echo e(__("Youtube link video")); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo e(__("Video Cover Image")); ?></label>
                                                <div class="form-group">
                                                    <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('video_cover_id',$row->video_cover_id); ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label"><?php echo e(__("Gallery")); ?> (<?php echo e(__('Recommended size image:1080 x 1920px')); ?>)</label>
                                                <?php
                                                    $gallery_id = $row->gallery ?? old('gallery');
                                                ?>
                                                <?php echo \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery', $gallery_id); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if(is_default_lang()): ?>
                            
                        <?php endif; ?>

                        
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                            <div class="panel-body">
                                <?php if(is_default_lang()): ?>
                                    <div>
                                        <label><input <?php if(old('status', $row->status) =='publish'): ?> checked <?php endif; ?> type="radio" name="status" value="publish"> <?php echo e(__("Publish")); ?></label>
                                    </div>
                                    <div>
                                        <label><input <?php if(old('status', $row->status)=='draft'): ?> checked <?php endif; ?> type="radio" name="status" value="draft"> <?php echo e(__("Draft")); ?></label>
                                    </div>
                                <?php endif; ?>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php echo e(__('Save Changes')); ?></button>
                                </div>
                            </div>
                        </div>
                        <?php if(is_default_lang()): ?>
                            
                            <div class="panel">
                                <div class="panel-title"><strong><?php echo e(__("Availability")); ?></strong></div>
                                <div class="panel-body">
                                    
                                    <div class="form-group">
                                        <label><?php echo e(__('Job Urgent')); ?></label>
                                        <br>
                                        <label>
                                            <input type="checkbox" name="is_urgent" <?php if(old('is_urgent',$row->is_urgent)): ?> checked <?php endif; ?> value="1"> <?php echo e(__("Enable Urgent")); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-title"><strong><?php echo e(__("Department")); ?></strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="">
                                            <select name="category_id" class="form-control">
                                                <option value=""><?php echo e(__("-- Please Select --")); ?></option>
                                                <?php
                                                $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                                                    foreach ($categories as $category) {
                                                        $selected = '';
                                                        if (old('category_id', $row->category_id) == $category->id)
                                                            $selected = 'selected';

                                                        $translate = $category->translateOrOrigin(app()->getLocale());
                                                        printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $translate->name);
                                                        $traverse($category->children, $prefix . '-');
                                                    }
                                                };
                                                $traverse($categories);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-title"><strong><?php echo e(__("Ship Type")); ?></strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="">
                                            <select name="job_type_id" class="form-control">
                                                <option value=""><?php echo e(__("-- Please Select --")); ?></option>
                                                <?php
                                                    foreach ($job_types as $job_type) {
                                                        $selected = '';
                                                        if (old('job_type_id', $row->job_type_id) == $job_type->id)
                                                            $selected = 'selected';
                                                        printf("<option value='%s' %s>%s</option>", $job_type->id, $selected, $job_type->name);
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <?php if(is_admin()): ?>
                                <div class="panel">
                                    <div class="panel-title"><strong><?php echo e(__("Principal")); ?></strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <?php
                                            $company = !empty($row->company_id) ? \Modules\Company\Models\Company::find($row->company_id) : false;
                                            \App\Helpers\AdminForm::select2('company_id', [
                                                'configs' => [
                                                    'ajax'        => [
                                                        'url' => route('company.admin.getForSelect2'),
                                                        'dataType' => 'json'
                                                    ],
                                                    'allowClear'  => true,
                                                    'placeholder' => __('-- Select Principal --')
                                                ]
                                            ], !empty($company->id) ? [
                                                $company->id,
                                                $company->name . ' (#' . $company->id . ')'
                                            ] : false)
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(is_default_lang()): ?>
                            <div class="panel">
                                <div class="panel-title"><strong><?php echo e(__('Feature Image')); ?></strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('thumbnail_id',old('thumbnail_id', $row->thumbnail_id)); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php  ?>
<?php $__env->startSection('script.body'); ?>
    <?php echo App\Helpers\MapEngine::scripts(); ?>

    <script>
        jQuery(function ($) {
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [<?php echo e(old('map_lat', $row->map_lat) ?? "51.505"); ?>, <?php echo e(old('map_lng', $row->map_lng) ?? "-0.09"); ?>],
                zoom:<?php echo e(old('map_zoom', $row->map_zoom) ?? "8"); ?>,
                ready: function (engineMap) {
                    <?php if(old('map_lat', $row->map_lat) && old('map_lng', $row->map_lng)): ?>
                    engineMap.addMarker([<?php echo e(old('map_lat', $row->map_lat)); ?>, <?php echo e(old('map_lng', $row->map_lng)); ?>], {
                        icon_options: {}
                    });
                    <?php endif; ?>
                    engineMap.on('click', function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                    engineMap.on('zoom_changed', function (zoom) {
                        $("input[name=map_zoom]").attr("value", zoom);
                    });
                    engineMap.searchBox($('#customPlaceAddress'),function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                    engineMap.searchBox($('.bravo_searchbox'),function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                }
            });

            $('#job_type_id').select2();
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/modules/Job/Views/admin/job/detail.blade.php ENDPATH**/ ?>