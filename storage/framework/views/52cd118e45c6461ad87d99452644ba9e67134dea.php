<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_create')): ?>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('admin.users.create')); ?>">
                <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.user.title_singular')); ?>

            </a>
        </div>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.user.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.id')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.name')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.first_name')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.last_name')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.gender')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.email')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.email_verified_at')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.verified')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.two_factor')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.roles')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.ktp')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.passport')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.visa')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.bst_ccm')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.cv')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.skk')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.country')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.state')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.city')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.address')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.b_o_d')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.office_registered')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.vc_yf')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.vc_covid')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.age')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.cid')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.coc')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.rating_able')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.ccm')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.experience')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.application_form')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.contact_no')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.photo')); ?>

                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-entry-id="<?php echo e($user->id); ?>">
                            <td>

                            </td>
                            <td>
                                <?php echo e($user->id ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->name ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->first_name ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->last_name ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e(App\Models\User::GENDER_SELECT[$user->gender] ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->email ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->email_verified_at ?? ''); ?>

                            </td>
                            <td>
                                <span style="display:none"><?php echo e($user->verified ?? ''); ?></span>
                                <input type="checkbox" disabled="disabled" <?php echo e($user->verified ? 'checked' : ''); ?>>
                            </td>
                            <td>
                                <span style="display:none"><?php echo e($user->two_factor ?? ''); ?></span>
                                <input type="checkbox" disabled="disabled" <?php echo e($user->two_factor ? 'checked' : ''); ?>>
                            </td>
                            <td>
                                <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge badge-info"><?php echo e($item->title); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>
                                <?php echo e($user->ktp ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->passport ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->visa ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->bst_ccm ?? ''); ?>

                            </td>
                            <td>
                                <?php if($user->cv): ?>
                                    <a href="<?php echo e($user->cv->getUrl()); ?>" target="_blank">
                                        <?php echo e(trans('global.view_file')); ?>

                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($user->skk): ?>
                                    <a href="<?php echo e($user->skk->getUrl()); ?>" target="_blank">
                                        <?php echo e(trans('global.view_file')); ?>

                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e($user->country ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->state ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->city ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->address ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->b_o_d ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->office_registered->city ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e(App\Models\User::VC_YF_RADIO[$user->vc_yf] ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e(App\Models\User::VC_COVID_RADIO[$user->vc_covid] ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->age ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e(App\Models\User::CID_RADIO[$user->cid] ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e(App\Models\User::COC_SELECT[$user->coc] ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e(App\Models\User::RATING_ABLE_RADIO[$user->rating_able] ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e(App\Models\User::CCM_RADIO[$user->ccm] ?? ''); ?>

                            </td>
                            <td>
                                <?php if($user->experience != null): ?>
                                <?php $__currentLoopData = $user->experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge badge-info"><?php echo e($item->value); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e(App\Models\User::APPLICATION_FORM_RADIO[$user->application_form] ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($user->contact_no ?? ''); ?>

                            </td>
                            <td>
                                <?php if($user->photo): ?>
                                    <a href="<?php echo e($user->photo->getUrl()); ?>" target="_blank" style="display: inline-block">
                                        <img src="<?php echo e($user->photo->getUrl('thumb')); ?>">
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_show')): ?>
                                    <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.users.show', $user->id)); ?>">
                                        <?php echo e(trans('global.view')); ?>

                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_edit')): ?>
                                    <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.users.edit', $user->id)); ?>">
                                        <?php echo e(trans('global.edit')); ?>

                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_delete')): ?>
                                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                        <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                                    </form>
                                <?php endif; ?>

                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.users.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')

        return
      }

      if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
<?php endif; ?>

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/resources/views/admin/users/index.blade.php ENDPATH**/ ?>