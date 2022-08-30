<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.user.title')); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.users.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th rowspan="5">
                            <?php echo e(trans('cruds.user.fields.photo')); ?>

                        </th>
                        <td>
                            <?php if($user->photo): ?>
                                <a href="<?php echo e($user->photo->getUrl()); ?>" target="_blank" style="display: inline-block">
                                    <img src="<?php echo e($user->photo->getUrl('thumb')); ?>">
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.id')); ?>

                        </th>
                        <td>
                            <?php echo e($user->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.name')); ?>

                        </th>
                        <td>
                            <?php echo e($user->name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.first_name')); ?>

                        </th>
                        <td>
                            <?php echo e($user->first_name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.last_name')); ?>

                        </th>
                        <td>
                            <?php echo e($user->last_name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.gender')); ?>

                        </th>
                        <td>
                            <?php echo e(App\Models\User::GENDER_SELECT[$user->gender] ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.email')); ?>

                        </th>
                        <td>
                            <?php echo e($user->email); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.email_verified_at')); ?>

                        </th>
                        <td>
                            <?php echo e($user->email_verified_at); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.verified')); ?>

                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" <?php echo e($user->verified ? 'checked' : ''); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.two_factor')); ?>

                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" <?php echo e($user->two_factor ? 'checked' : ''); ?>>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.roles')); ?>

                        </th>
                        <td>
                            <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $roles): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="label label-info"><?php echo e($roles->title); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.ktp')); ?>

                        </th>
                        <td>
                            <?php echo e($user->ktp); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.passport')); ?>

                        </th>
                        <td>
                            <?php echo e($user->passport); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.visa')); ?>

                        </th>
                        <td>
                            <?php echo e($user->visa); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.bst_ccm')); ?>

                        </th>
                        <td>
                            <?php echo e($user->bst_ccm); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.cv')); ?>

                        </th>
                        <td>
                            <?php if($user->cv): ?>
                                <a href="<?php echo e($user->cv->getUrl()); ?>" target="_blank">
                                    <?php echo e(trans('global.view_file')); ?>

                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.skk')); ?>

                        </th>
                        <td>
                            <?php if($user->skk): ?>
                                <a href="<?php echo e($user->skk->getUrl()); ?>" target="_blank">
                                    <?php echo e(trans('global.view_file')); ?>

                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.country')); ?>

                        </th>
                        <td>
                            <?php echo e($user->country); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.state')); ?>

                        </th>
                        <td>
                            <?php echo e($user->state); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.city')); ?>

                        </th>
                        <td>
                            <?php echo e($user->city); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.address')); ?>

                        </th>
                        <td>
                            <?php echo e($user->address); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.b_o_d')); ?>

                        </th>
                        <td>
                            <?php echo e($user->b_o_d); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.office_registered')); ?>

                        </th>
                        <td>
                            <?php echo e($user->office_registered->city ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.vc_yf')); ?>

                        </th>
                        <td>
                            <?php echo e(App\Models\User::VC_YF_RADIO[$user->vc_yf] ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.vc_covid')); ?>

                        </th>
                        <td>
                            <?php echo e(App\Models\User::VC_COVID_RADIO[$user->vc_covid] ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.age')); ?>

                        </th>
                        <td>
                            <?php echo e($user->age); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.cid')); ?>

                        </th>
                        <td>
                            <?php echo e(App\Models\User::CID_RADIO[$user->cid] ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.coc')); ?>

                        </th>
                        <td>
                            <?php echo e(App\Models\User::COC_SELECT[$user->coc] ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.rating_able')); ?>

                        </th>
                        <td>
                            <?php echo e(App\Models\User::RATING_ABLE_RADIO[$user->rating_able] ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.ccm')); ?>

                        </th>
                        <td>
                            <?php echo e(App\Models\User::CCM_RADIO[$user->ccm] ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.experience')); ?>

                        </th>
                        <td>
                            
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.application_form')); ?>

                        </th>
                        <td>
                            <?php echo e(App\Models\User::APPLICATION_FORM_RADIO[$user->application_form] ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.user.fields.contact_no')); ?>

                        </th>
                        <td>
                            <?php echo e($user->contact_no); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.users.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.relatedData')); ?>

    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#candidate_sgps" role="tab" data-toggle="tab">
                <?php echo e(trans('cruds.sgp.title')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#int_by_sgps" role="tab" data-toggle="tab">
                <?php echo e(trans('cruds.sgp.title')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#candidate_departures" role="tab" data-toggle="tab">
                <?php echo e(trans('cruds.departure.title')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#candidate_interviews" role="tab" data-toggle="tab">
                <?php echo e(trans('cruds.interview.title')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                <?php echo e(trans('cruds.userAlert.title')); ?>

            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="candidate_sgps">
            <?php if ($__env->exists('admin.users.relationships.candidateSgps', ['sgps' => $user->candidateSgps])) echo $__env->make('admin.users.relationships.candidateSgps', ['sgps' => $user->candidateSgps], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane" role="tabpanel" id="int_by_sgps">
            <?php if ($__env->exists('admin.users.relationships.intBySgps', ['sgps' => $user->intBySgps])) echo $__env->make('admin.users.relationships.intBySgps', ['sgps' => $user->intBySgps], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane" role="tabpanel" id="candidate_departures">
            <?php if ($__env->exists('admin.users.relationships.candidateDepartures', ['departures' => $user->candidateDepartures])) echo $__env->make('admin.users.relationships.candidateDepartures', ['departures' => $user->candidateDepartures], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane" role="tabpanel" id="candidate_interviews">
            <?php if ($__env->exists('admin.users.relationships.candidateInterviews', ['interviews' => $user->candidateInterviews])) echo $__env->make('admin.users.relationships.candidateInterviews', ['interviews' => $user->candidateInterviews], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            <?php if ($__env->exists('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])) echo $__env->make('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/resources/views/admin/users/show.blade.php ENDPATH**/ ?>