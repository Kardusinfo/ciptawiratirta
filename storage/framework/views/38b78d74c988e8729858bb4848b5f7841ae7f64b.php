<?php $__env->startSection('content'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.edit')); ?> <?php echo e(trans('cruds.user.title_singular')); ?>

        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route('admin.users.update', [$user->id])); ?>" enctype="multipart/form-data">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-9">
                        
                        <div class="form-group">
                            <label for="first_name"><?php echo e(trans('cruds.user.fields.first_name')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('first_name') ? 'is-invalid' : ''); ?>" type="text"
                                name="first_name" id="first_name" value="<?php echo e(old('first_name', $user->first_name)); ?>">
                            <?php if($errors->has('first_name')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.first_name_helper')); ?></label></span>
                        </div>
                        <div class="form-group">
                            <label for="last_name"><?php echo e(trans('cruds.user.fields.last_name')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('last_name') ? 'is-invalid' : ''); ?>" type="text"
                                name="last_name" id="last_name" value="<?php echo e(old('last_name', $user->last_name)); ?>">
                            <?php if($errors->has('last_name')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.last_name_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="contact_no"><?php echo e(trans('cruds.user.fields.contact_no')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('contact_no') ? 'is-invalid' : ''); ?>"
                                type="text" name="contact_no" id="contact_no"
                                value="<?php echo e(old('contact_no', $user->contact_no)); ?>">
                            <?php if($errors->has('contact_no')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.contact_no_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(trans('cruds.user.fields.gender')); ?><span style="color:red">*</span></label>
                            <select class="form-control <?php echo e($errors->has('gender') ? 'is-invalid' : ''); ?>" name="gender"
                                id="gender">
                                <option value disabled <?php echo e(old('gender', null) === null ? 'selected' : ''); ?>>
                                    <?php echo e(trans('global.pleaseSelect')); ?></option>
                                <?php $__currentLoopData = App\Models\User::GENDER_SELECT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"
                                        <?php echo e(old('gender', $user->gender) === (string) $key ? 'selected' : ''); ?>>
                                        <?php echo e($label); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('gender')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.gender_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email"><?php echo e(trans('cruds.user.fields.email')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>" type="email"
                                name="email" id="email" value="<?php echo e(old('email', $user->email)); ?>" required>
                            <?php if($errors->has('email')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.email_helper')); ?></span>
                        </div>
                        <?php if(Auth::user()->roles()->first() != null): ?>
                            <div class="form-group">
                                <label class="required" for="password">ID Passport</label>
                                <input class="form-control <?php echo e($errors->has('password') ? 'is-invalid' : ''); ?>"
                                    type="password" name="password" id="password">
                                <?php if($errors->has('password')): ?>
                                    
                                    <div style="color:red">Required</div>
                                <?php endif; ?>
                                <span class="help-block"><?php echo e(trans('cruds.user.fields.password_helper')); ?></span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="roles"><?php echo e(trans('cruds.user.fields.roles')); ?><span style="color:red">*</span></label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0"><?php echo e(trans('global.select_all')); ?></span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0"><?php echo e(trans('global.deselect_all')); ?></span>
                                </div>
                                <select class="form-control select2 <?php echo e($errors->has('roles') ? 'is-invalid' : ''); ?>"
                                    name="roles[]" id="roles" multiple required>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>"
                                            <?php echo e(in_array($id, old('roles', [])) || $user->roles->contains($id) ? 'selected' : ''); ?>>
                                            <?php echo e($role); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('roles')): ?>
                                    
                                    <div style="color:red">Required</div>
                                <?php endif; ?>
                                <span class="help-block"><?php echo e(trans('cruds.user.fields.roles_helper')); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="ktp"><?php echo e(trans('cruds.user.fields.ktp')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('ktp') ? 'is-invalid' : ''); ?>" type="text"
                                name="ktp" id="ktp" value="<?php echo e(old('ktp', $user->ktp)); ?>">
                            <?php if($errors->has('ktp')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.ktp_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="country"><?php echo e(trans('cruds.user.fields.country')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('country') ? 'is-invalid' : ''); ?>" type="text"
                                name="country" id="country" value="<?php echo e(old('country', $user->country)); ?>">
                            <?php if($errors->has('country')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.country_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="state"><?php echo e(trans('cruds.user.fields.state')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('state') ? 'is-invalid' : ''); ?>" type="text"
                                name="state" id="state" value="<?php echo e(old('state', $user->state)); ?>">
                            <?php if($errors->has('state')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.state_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="city"><?php echo e(trans('cruds.user.fields.city')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('city') ? 'is-invalid' : ''); ?>" type="text"
                                name="city" id="city" value="<?php echo e(old('city', $user->city)); ?>">
                            <?php if($errors->has('city')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.city_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="address"><?php echo e(trans('cruds.user.fields.address')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?>" type="text"
                                name="address" id="address" value="<?php echo e(old('address', $user->address)); ?>">
                            <?php if($errors->has('address')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.address_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="b_o_d">B.O.D<span style="color:red">*</span></label>
                            <input class="form-control date <?php echo e($errors->has('b_o_d') ? 'is-invalid' : ''); ?>"
                                type="date" name="b_o_d" id="b_o_d" value="<?php echo e(old('b_o_d', $user->b_o_d)); ?>">
                            <?php if($errors->has('b_o_d')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.b_o_d_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="office_registered_id"><?php echo e(trans('cruds.user.fields.office_registered')); ?><span style="color:red">*</span></label>
                            <select
                                class="form-control select2 <?php echo e($errors->has('office_registered') ? 'is-invalid' : ''); ?>"
                                name="office_registered_id" id="office_registered_id">
                                <?php $__currentLoopData = $office_registereds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>"
                                        <?php echo e((old('office_registered_id') ? old('office_registered_id') : $user->office_registered->id ?? '') == $id ? 'selected' : ''); ?>>
                                        <?php echo e($entry); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('office_registered')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.office_registered_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="age"><?php echo e(trans('cruds.user.fields.age')); ?><span style="color:red">*</span></label>
                            <input class="form-control <?php echo e($errors->has('age') ? 'is-invalid' : ''); ?>" type="text"
                                name="age" id="age" value="<?php echo e(old('age', $user->age)); ?>">
                            <?php if($errors->has('age')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.age_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(trans('cruds.user.fields.rating_able')); ?></label>
                            <?php $__currentLoopData = App\Models\User::RATING_ABLE_RADIO; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check <?php echo e($errors->has('rating_able') ? 'is-invalid' : ''); ?>">
                                    <input class="form-check-input" type="radio" id="rating_able_<?php echo e($key); ?>"
                                        name="rating_able" value="<?php echo e($key); ?>"
                                        <?php echo e(old('rating_able', $user->rating_able) === (string) $key ? 'checked' : ''); ?>>
                                    <label class="form-check-label"
                                        for="rating_able_<?php echo e($key); ?>"><?php echo e($label); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.rating_able_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="experiences"><?php echo e(trans('cruds.user.fields.experience')); ?></label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all"
                                    style="border-radius: 0"><?php echo e(trans('global.select_all')); ?></span>
                                <span class="btn btn-info btn-xs deselect-all"
                                    style="border-radius: 0"><?php echo e(trans('global.deselect_all')); ?></span>
                            </div>
                            <select class="form-control select2 <?php echo e($errors->has('experiences') ? 'is-invalid' : ''); ?>"
                                name="experiences[]" id="experiences" multiple>
                                <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id); ?>"
                                        <?php echo e(in_array($id, old('experiences', [])) || $user->experiences->contains($id) ? 'selected' : ''); ?>>
                                        <?php echo e($experience); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.experience_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(trans('cruds.user.fields.application_form')); ?></label>
                            <?php $__currentLoopData = App\Models\User::APPLICATION_FORM_RADIO; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check <?php echo e($errors->has('application_form') ? 'is-invalid' : ''); ?>">
                                    <input class="form-check-input" type="radio"
                                        id="application_form_<?php echo e($key); ?>" name="application_form"
                                        value="<?php echo e($key); ?>"
                                        <?php echo e(old('application_form', $user->application_form) === (string) $key ? 'checked' : ''); ?>>
                                    <label class="form-check-label"
                                        for="application_form_<?php echo e($key); ?>"><?php echo e($label); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.application_form_helper')); ?></span>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="photo">Photo<span style="color:red">*</span></label>
                            <div class="needsclick dropzone <?php echo e($errors->has('photo') ? 'is-invalid' : ''); ?>"
                                id="photo-dropzone">
                            </div>
                            <?php if($errors->has('photo')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.photo_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="cv">CV<span style="color:red">*</span></label>
                            <div class="needsclick dropzone <?php echo e($errors->has('cv') ? 'is-invalid' : ''); ?>"
                                id="cv-dropzone">
                            </div>
                            <?php if($errors->has('cv')): ?>
                                
                                <div style="color:red">Required</div>
                            <?php endif; ?>
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.cv_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="skk">Surat Keterangan Kerja</label>
                            <div class="needsclick dropzone <?php echo e($errors->has('skk') ? 'is-invalid' : ''); ?>"
                                id="skk-dropzone">
                            </div>
                            
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.skk_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="passport">Passport ID</label>
                            <input class="form-control <?php echo e($errors->has('passport') ? 'is-invalid' : ''); ?>"
                                type="text" name="passport" id="passport"
                                value="<?php echo e(old('passport', $user->passport)); ?>">
                            
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.passport_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="visa">Visa ID</label>
                            <input class="form-control <?php echo e($errors->has('visa') ? 'is-invalid' : ''); ?>" type="text"
                                name="visa" id="visa" value="<?php echo e(old('visa', $user->visa)); ?>">
                            
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.visa_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="seaman_book">Seaman Book</label>
                            <input class="form-control <?php echo e($errors->has('seaman_book') ? 'is-invalid' : ''); ?>" type="text"
                                name="seaman_book" id="seaman_book" value="<?php echo e(old('seaman_book', $user->seamen_book)); ?>">
                            
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="ccm">CCM Number</label>
                            <input class="form-control <?php echo e($errors->has('ccm') ? 'is-invalid' : ''); ?>" type="text"
                                name="ccm" id="ccm" value="<?php echo e(old('ccm', $user->ccm)); ?>">
                            
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="ccm">CID Number</label>
                            <input class="form-control <?php echo e($errors->has('cid') ? 'is-invalid' : ''); ?>" type="text"
                                name="cid" id="cid" value="<?php echo e(old('cid', $user->cid)); ?>">
                            
                            
                        </div>
                        <div class="form-group">
                            <label>COC</label>
                            <div class="form-check <?php echo e($errors->has('coc') ? 'is-invalid' : ''); ?>">
                                <input class="form-check-input" type="text" id="coc"
                                    name="coc" value="<?php echo e(old('coc', $user->coc)); ?>">
                            </div>
                            
                            
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.coc_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="bst_ccm">BST/CCM</label>
                            <input class="form-control <?php echo e($errors->has('bst_ccm') ? 'is-invalid' : ''); ?>" type="text"
                                name="bst_ccm" id="bst_ccm" value="<?php echo e(old('bst_ccm', $user->bst_ccm)); ?>">
                            
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.bst_ccm_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(trans('cruds.user.fields.vc_yf')); ?></label>
                            
                            
                            
                            <input class="form-control <?php echo e($errors->has('vc_yf') ? 'is-invalid' : ''); ?>" type="date"
                                name="vc_yf" id="vc_yf" value="<?php echo e(old('vc_yf', $user->vc_yf)); ?>">
                            
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.vc_yf_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo e(trans('cruds.user.fields.vc_covid')); ?></label>
                            
                            
                            
                            <input class="form-control <?php echo e($errors->has('vc_covid') ? 'is-invalid' : ''); ?>" type="date"
                                name="vc_covid" id="vc_covid" value="<?php echo e(old('vc_covid', $user->vc_covid)); ?>">
                            <span class="help-block"><?php echo e(trans('cruds.user.fields.vc_covid_helper')); ?></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                <?php echo e(trans('global.save')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        Dropzone.options.cvDropzone = {
            url: '<?php echo e(route('admin.users.storeMedia')); ?>',
            maxFilesize: 20, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            params: {
                size: 20
            },
            success: function(file, response) {
                $('form').find('input[name="cv"]').remove()
                $('form').append('<input type="hidden" name="cv" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="cv"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                <?php if(isset($user) && $user->cv): ?>
                    var file = <?php echo json_encode($user->cv); ?>

                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="cv" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                <?php endif; ?>
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.skkDropzone = {
            url: '<?php echo e(route('admin.users.storeMedia')); ?>',
            maxFilesize: 20, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            params: {
                size: 20
            },
            success: function(file, response) {
                $('form').find('input[name="skk"]').remove()
                $('form').append('<input type="hidden" name="skk" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="skk"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                <?php if(isset($user) && $user->skk): ?>
                    var file = <?php echo json_encode($user->skk); ?>

                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="skk" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                <?php endif; ?>
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.photoDropzone = {
            url: '<?php echo e(route('admin.users.storeMedia')); ?>',
            maxFilesize: 20, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            params: {
                size: 20,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                <?php if(isset($user) && $user->photo): ?>
                    var file = <?php echo json_encode($user->photo); ?>

                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                <?php endif; ?>
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>