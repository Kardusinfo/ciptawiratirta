<?php $__env->startSection('head'); ?>
    <style>
    .form-group { 
        content:"*";
        color:red;
    }
    </style>
    <link href="<?php echo e(asset('module/user/css/user.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <h3 class="title py-4"><?php echo e(__('My Profile')); ?></h3>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form action="<?php echo e(url('admin/module/user/store/' . ($row->id ?? -1))); ?>" method="post" class="default-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="status" value="<?php echo e($row->status); ?>">
        <div class="row">
            <div class="col-lg-9">
                <div class="panel mb-4" style="height: auto;">
                    <div class="panel-title"><strong><?php echo e(__('User Info')); ?></strong></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label><?php echo e(__('E-mail')); ?></label>
                            <input type="text" name="email" value="<?php echo e(old('email', $row->email)); ?>"
                                placeholder="<?php echo e(__('E-mail')); ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('First Name')); ?></label>
                                        <input type="text" value="<?php echo e(old('first_name', $row->first_name)); ?>"
                                            name="first_name" placeholder="<?php echo e(__('First name')); ?>" class="form-control">
                                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div style="color:red">*Required</div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Last Name')); ?></label>
                                        <input type="text" value="<?php echo e(old('last_name', $row->last_name)); ?>"
                                            name="last_name" placeholder="<?php echo e(__('Last name')); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Whatsapp No')); ?></label>
                            <input type="text" value="<?php echo e(old('phone', $row->phone)); ?>" name="phone"
                                placeholder="<?php echo e(__('Phone Number')); ?>" class="form-control">
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div style="color:red">*Required</div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label><?php echo e(__('ID Card/KTP')); ?></label>
                            <input type="text" value="<?php echo e(old('ktp', $row->ktp)); ?>" name="ktp"
                                placeholder="<?php echo e(__('Nomor KTP')); ?>" class="form-control">
                            <?php $__errorArgs = ['ktp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div style="color:red">*Required</div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label><?php echo e(__('D.O.B')); ?></label>
                            <input type="text"
                                value="<?php echo e(old('birthday', $row->birthday ? display_date($row->birthday) : '')); ?>"
                                name="birthday" placeholder="<?php echo e(__('Tanggal Lahir (Wajib)')); ?>"
                                class="form-control has-datepicker" autocomplete="off">
                            
                        </div>
                            <?php $__errorArgs = ['birthday'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div style="color:red">*Required</div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__('Background/Experience')); ?></label>
                            <textarea name="bio" rows="5" class="form-control"><?php echo e(strip_tags(old('bio', $row->bio))); ?></textarea>
                            <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div style="color:red">*Required</div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <input type="hidden" value="<?php echo e(old('role_id', $row->role_id)); ?>" name="role_id"
                                placeholder="<?php echo e(__('role_id')); ?>" class="form-control">
                        <div class="form-group">
                            <label for="education_level"><?php echo e(__("CWT Office Register")); ?></label>
                            <select class="form-control" id="education_level" name="education_level">
                                <option value="" <?php if(old('education_level', $row->education_level) == ''): ?> selected <?php endif; ?> ><?php echo e(__("Select")); ?></option>
                                <option value="Jakarta" <?php if(old('education_level', $row->education_level) == 'Jakarta'): ?> selected <?php endif; ?> ><?php echo e(__("Jakarta")); ?></option>
                                <option value="Bali" <?php if(old('education_level', $row->education_level) == 'Bali'): ?> selected <?php endif; ?> ><?php echo e(__("Bali")); ?></option>
                                <option value="Yogyakarta" <?php if(old('education_level', $row->education_level) == 'Yogyakarta'): ?> selected <?php endif; ?> ><?php echo e(__("Yogyakarta")); ?></option>
                                <option value="Surabaya" <?php if(old('education_level', $row->education_level) == 'Surabaya'): ?> selected <?php endif; ?> ><?php echo e(__("Surabaya")); ?></option>
                                <option value="Bandung" <?php if(old('education_level', $row->education_level) == 'Bandung'): ?> selected <?php endif; ?> ><?php echo e(__("Bandung")); ?></option>
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gender"><?php echo e(__('Gender')); ?></label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="" <?php if(old('gender',  $row->gender) == ''): ?> selected <?php endif; ?>>
                                    <?php echo e(__('Select')); ?></option>
                                <option value="male" <?php if(old('gender',  $row->gender) == 'male'): ?> selected <?php endif; ?>>
                                    <?php echo e(__('Male')); ?></option>
                                <option value="female" <?php if(old('gender',  $row->gender) == 'female'): ?> selected <?php endif; ?>>
                                    <?php echo e(__('Female')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo e(old('first_name', $row->first_name)); ?>" name="title" placeholder="<?php echo e(__("Title")); ?>" class="form-control">
                <?php if($row->hasRole('candidate')): ?>
                    
                    
                <?php endif; ?>
                <div class="mb-4">
                    <button class="theme-btn btn-style-one" type="submit"><i class="fa fa-save"
                            style="padding-right: 5px"></i> <?php echo e(__('Save Changes')); ?></button>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="panel">
                    <div class="panel-title"><strong><?php echo e(__('CV (Max 4 MB)')); ?></strong></div>
                    <div class="panel-body">
                        <div class="form-group-item">
                            <div class="g-items-header">
                                <div class="row">
                                    <div class="col-md-2"><?php echo e(__('Default')); ?></div>
                                    <div class="col-md-8"><?php echo e(__('Name')); ?></div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                            <?php echo \Modules\Media\Helpers\FileHelper::fieldFileUpload('cvs', @$cvs, 'cvs'); ?>

                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-title"><strong><?php echo e(__('SKK (Max 4 MB)')); ?></strong></div>
                    <div class="panel-body">
                        <div class="form-group-item">
                            <div class="g-items-header">
                                <div class="row">
                                    <div class="col-md-2"><?php echo e(__('Default')); ?></div>
                                    <div class="col-md-8"><?php echo e(__('Name')); ?></div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                            <?php echo \Modules\Media\Helpers\FileHelper::fieldFileUpload('skk', @$skk, 'skk'); ?>

                        </div>
                    </div>
                </div>

                


                <div class="panel">
                    <div class="panel-title"><strong><?php echo e(__('Photo formal (Required)')); ?></strong></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('avatar_id', old('avatar_id', $row->avatar_id)); ?>

                        </div>
                    </div>
                </div>
                
                <div class="mb-4 text-right">
                    <button class="theme-btn btn-style-one" type="submit"><i class="fa fa-save"
                            style="padding-right: 5px"></i> <?php echo e(__('Save Changes')); ?></button>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php echo App\Helpers\MapEngine::scripts(); ?>

    <script type="text/javascript" src="<?php echo e(asset('libs/daterange/moment.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('libs/daterange/daterangepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/select2/js/select2.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $(function() {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            });
        });
    </script>
    
    <script>
        <?php if($row->hasRole('candidate') || !empty($candidate_create)): ?>
            $(document).ready(function() {
                $('#categories').select2();
                $('#skills').select2();
            });

            let mapLat = <?php echo e(!empty($row->candidate) ? $row->candidate->map_lat ?? '51.505' : '51.505'); ?>;
            let mapLng = <?php echo e(!empty($row->candidate) ? $row->candidate->map_lng ?? '-0.09' : '-0.09'); ?>;
            let mapZoom = <?php echo e(!empty($row->candidate) ? $row->candidate->map_zoom ?? '8' : '8'); ?>;

            jQuery(function($) {
                new BravoMapEngine('map_content', {
                    disableScripts: true,
                    fitBounds: true,
                    center: [mapLat, mapLng],
                    zoom: mapZoom,
                    ready: function(engineMap) {
                        engineMap.addMarker([mapLat, mapLng], {
                            icon_options: {}
                        });
                        engineMap.on('click', function(dataLatLng) {
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        });
                        engineMap.on('zoom_changed', function(zoom) {
                            $("input[name=map_zoom]").attr("value", zoom);
                        });
                        engineMap.searchBox($('#customPlaceAddress'), function(dataLatLng) {
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        });
                        engineMap.searchBox($('.bravo_searchbox'), function(dataLatLng) {
                            engineMap.clearMarkers();
                            engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        });
                    }
                });

            })
    engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        });
                    }
                });

            })
  engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        });
                    }
                });

            })
   engineMap.addMarker(dataLatLng, {
                                icon_options: {}
                            });
                            $("input[name=map_lat]").attr("value", dataLatLng[0]);
                            $("input[name=map_lng]").attr("value", dataLatLng[1]);
                        });
                    }
                });

            })
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/modules/User/Views/frontend/profile.blade.php ENDPATH**/ ?>