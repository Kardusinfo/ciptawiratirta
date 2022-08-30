<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.sgp.title_singular')); ?>

    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route("admin.sgps.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="remarks"><?php echo e(trans('cruds.sgp.fields.remarks')); ?></label>
                <input class="form-control <?php echo e($errors->has('remarks') ? 'is-invalid' : ''); ?>" type="text" name="remarks" id="remarks" value="<?php echo e(old('remarks', '')); ?>">
                <?php if($errors->has('remarks')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('remarks')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.remarks_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="crew_code"><?php echo e(trans('cruds.sgp.fields.crew_code')); ?></label>
                <input class="form-control <?php echo e($errors->has('crew_code') ? 'is-invalid' : ''); ?>" type="text" name="crew_code" id="crew_code" value="<?php echo e(old('crew_code', '')); ?>">
                <?php if($errors->has('crew_code')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('crew_code')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.crew_code_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="date_of_entry"><?php echo e(trans('cruds.sgp.fields.date_of_entry')); ?></label>
                <input class="form-control date <?php echo e($errors->has('date_of_entry') ? 'is-invalid' : ''); ?>" type="text" name="date_of_entry" id="date_of_entry" value="<?php echo e(old('date_of_entry')); ?>">
                <?php if($errors->has('date_of_entry')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('date_of_entry')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.date_of_entry_helper')); ?></span>
            </div>
            <div class="form-group">
                <label><?php echo e(trans('cruds.sgp.fields.source')); ?></label>
                <select class="form-control <?php echo e($errors->has('source') ? 'is-invalid' : ''); ?>" name="source" id="source">
                    <option value disabled <?php echo e(old('source', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = App\Models\Sgp::SOURCE_SELECT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(old('source', '') === (string) $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('source')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('source')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.source_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="candidate_id"><?php echo e(trans('cruds.sgp.fields.candidate')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('candidate') ? 'is-invalid' : ''); ?>" name="candidate_id" id="candidate_id">
                    <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('candidate_id') == $id ? 'selected' : ''); ?>><?php echo e($entry); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('candidate')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('candidate')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.candidate_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="applied_position_id"><?php echo e(trans('cruds.sgp.fields.applied_position')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('applied_position') ? 'is-invalid' : ''); ?>" name="applied_position_id" id="applied_position_id">
                    <?php $__currentLoopData = $applied_positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('applied_position_id') == $id ? 'selected' : ''); ?>><?php echo e($entry); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('applied_position')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('applied_position')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.applied_position_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="department_id"><?php echo e(trans('cruds.sgp.fields.department')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('department') ? 'is-invalid' : ''); ?>" name="department_id" id="department_id">
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('department_id') == $id ? 'selected' : ''); ?>><?php echo e($entry); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('department')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('department')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.department_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="gender"><?php echo e(trans('cruds.sgp.fields.gender')); ?></label>
                <input class="form-control <?php echo e($errors->has('gender') ? 'is-invalid' : ''); ?>" type="text" name="gender" id="gender" value="<?php echo e(old('gender', '')); ?>">
                <?php if($errors->has('gender')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('gender')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.gender_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="d_o_b"><?php echo e(trans('cruds.sgp.fields.d_o_b')); ?></label>
                <input class="form-control <?php echo e($errors->has('d_o_b') ? 'is-invalid' : ''); ?>" type="text" name="d_o_b" id="d_o_b" value="<?php echo e(old('d_o_b', '')); ?>">
                <?php if($errors->has('d_o_b')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('d_o_b')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.d_o_b_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="age"><?php echo e(trans('cruds.sgp.fields.age')); ?></label>
                <input class="form-control <?php echo e($errors->has('age') ? 'is-invalid' : ''); ?>" type="text" name="age" id="age" value="<?php echo e(old('age', '')); ?>">
                <?php if($errors->has('age')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('age')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.age_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="vc_yf"><?php echo e(trans('cruds.sgp.fields.vc_yf')); ?></label>
                <input class="form-control <?php echo e($errors->has('vc_yf') ? 'is-invalid' : ''); ?>" type="text" name="vc_yf" id="vc_yf" value="<?php echo e(old('vc_yf', '')); ?>">
                <?php if($errors->has('vc_yf')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('vc_yf')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.vc_yf_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="vc_covid"><?php echo e(trans('cruds.sgp.fields.vc_covid')); ?></label>
                <input class="form-control <?php echo e($errors->has('vc_covid') ? 'is-invalid' : ''); ?>" type="text" name="vc_covid" id="vc_covid" value="<?php echo e(old('vc_covid', '')); ?>">
                <?php if($errors->has('vc_covid')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('vc_covid')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.vc_covid_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="cid"><?php echo e(trans('cruds.sgp.fields.cid')); ?></label>
                <input class="form-control <?php echo e($errors->has('cid') ? 'is-invalid' : ''); ?>" type="text" name="cid" id="cid" value="<?php echo e(old('cid', '')); ?>">
                <?php if($errors->has('cid')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('cid')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.cid_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="coc"><?php echo e(trans('cruds.sgp.fields.coc')); ?></label>
                <input class="form-control <?php echo e($errors->has('coc') ? 'is-invalid' : ''); ?>" type="text" name="coc" id="coc" value="<?php echo e(old('coc', '')); ?>">
                <?php if($errors->has('coc')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('coc')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.coc_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="rating_able"><?php echo e(trans('cruds.sgp.fields.rating_able')); ?></label>
                <input class="form-control <?php echo e($errors->has('rating_able') ? 'is-invalid' : ''); ?>" type="text" name="rating_able" id="rating_able" value="<?php echo e(old('rating_able', '')); ?>">
                <?php if($errors->has('rating_able')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('rating_able')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.rating_able_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="ccm"><?php echo e(trans('cruds.sgp.fields.ccm')); ?></label>
                <input class="form-control <?php echo e($errors->has('ccm') ? 'is-invalid' : ''); ?>" type="text" name="ccm" id="ccm" value="<?php echo e(old('ccm', '')); ?>">
                <?php if($errors->has('ccm')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('ccm')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.ccm_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="experience"><?php echo e(trans('cruds.sgp.fields.experience')); ?></label>
                <input class="form-control <?php echo e($errors->has('experience') ? 'is-invalid' : ''); ?>" type="text" name="experience" id="experience" value="<?php echo e(old('experience', '')); ?>">
                <?php if($errors->has('experience')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('experience')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.experience_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="application_form"><?php echo e(trans('cruds.sgp.fields.application_form')); ?></label>
                <input class="form-control <?php echo e($errors->has('application_form') ? 'is-invalid' : ''); ?>" type="text" name="application_form" id="application_form" value="<?php echo e(old('application_form', '')); ?>">
                <?php if($errors->has('application_form')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('application_form')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.application_form_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="contact_no"><?php echo e(trans('cruds.sgp.fields.contact_no')); ?></label>
                <input class="form-control <?php echo e($errors->has('contact_no') ? 'is-invalid' : ''); ?>" type="text" name="contact_no" id="contact_no" value="<?php echo e(old('contact_no', '')); ?>">
                <?php if($errors->has('contact_no')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('contact_no')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.contact_no_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="email"><?php echo e(trans('cruds.sgp.fields.email')); ?></label>
                <input class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>" type="text" name="email" id="email" value="<?php echo e(old('email', '')); ?>">
                <?php if($errors->has('email')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('email')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.email_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="int_by_id"><?php echo e(trans('cruds.sgp.fields.int_by')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('int_by') ? 'is-invalid' : ''); ?>" name="int_by_id" id="int_by_id">
                    <?php $__currentLoopData = $int_bies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('int_by_id') == $id ? 'selected' : ''); ?>><?php echo e($entry); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('int_by')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('int_by')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.int_by_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="int_date"><?php echo e(trans('cruds.sgp.fields.int_date')); ?></label>
                <input class="form-control date <?php echo e($errors->has('int_date') ? 'is-invalid' : ''); ?>" type="text" name="int_date" id="int_date" value="<?php echo e(old('int_date')); ?>">
                <?php if($errors->has('int_date')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('int_date')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.int_date_helper')); ?></span>
            </div>
            <div class="form-group">
                <label><?php echo e(trans('cruds.sgp.fields.int_result')); ?></label>
                <?php $__currentLoopData = App\Models\Sgp::INT_RESULT_RADIO; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-check <?php echo e($errors->has('int_result') ? 'is-invalid' : ''); ?>">
                        <input class="form-check-input" type="radio" id="int_result_<?php echo e($key); ?>" name="int_result" value="<?php echo e($key); ?>" <?php echo e(old('int_result', '') === (string) $key ? 'checked' : ''); ?>>
                        <label class="form-check-label" for="int_result_<?php echo e($key); ?>"><?php echo e($label); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($errors->has('int_result')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('int_result')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.int_result_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="approved_as_id"><?php echo e(trans('cruds.sgp.fields.approved_as')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('approved_as') ? 'is-invalid' : ''); ?>" name="approved_as_id" id="approved_as_id">
                    <?php $__currentLoopData = $approved_as; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('approved_as_id') == $id ? 'selected' : ''); ?>><?php echo e($entry); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('approved_as')): ?>
                    <div class="invalid-feedback">
                        <?php echo e($errors->first('approved_as')); ?>

                    </div>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.sgp.fields.approved_as_helper')); ?></span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    <?php echo e(trans('global.save')); ?>

                </button>
            </div>
        </form>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/resources/views/admin/sgps/create.blade.php ENDPATH**/ ?>