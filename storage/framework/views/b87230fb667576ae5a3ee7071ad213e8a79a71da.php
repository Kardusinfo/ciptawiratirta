<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sgp_create')): ?>
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="<?php echo e(route('admin.sgps.create')); ?>">
                <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.sgp.title_singular')); ?>

            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                <?php echo e(trans('global.app_csvImport')); ?>

            </button>
            <?php echo $__env->make('csvImport.modal', ['model' => 'Sgp', 'route' => 'admin.sgps.parseCsvImport'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.sgp.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Sgp">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.id')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.remarks')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.crew_code')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.date_of_entry')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.source')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.candidate')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.email')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.applied_position')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.department')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.gender')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.d_o_b')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.age')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.vc_yf')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.vc_covid')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.cid')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.coc')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.rating_able')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.ccm')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.experience')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.application_form')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.contact_no')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.email')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.int_by')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.user.fields.email')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.int_date')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.int_result')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.sgp.fields.approved_as')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.job.fields.slug')); ?>

                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $sgps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sgp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-entry-id="<?php echo e($sgp->id); ?>">
                            <td>

                            </td>
                            <td>
                                <?php echo e($sgp->id ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->remarks ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->crew_code ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->date_of_entry ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e(App\Models\Sgp::SOURCE_SELECT[$sgp->source] ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->candidate->name ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->candidate->email ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->applied_position->title ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->department->department_name ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->gender ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->d_o_b ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->age ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->vc_yf ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->vc_covid ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->cid ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->coc ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->rating_able ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->ccm ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->experience ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->application_form ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->contact_no ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->email ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->int_by->name ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->int_by->email ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->int_date ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e(App\Models\Sgp::INT_RESULT_RADIO[$sgp->int_result] ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->approved_as->title ?? ''); ?>

                            </td>
                            <td>
                                <?php echo e($sgp->approved_as->slug ?? ''); ?>

                            </td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sgp_show')): ?>
                                    <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.sgps.show', $sgp->id)); ?>">
                                        <?php echo e(trans('global.view')); ?>

                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sgp_edit')): ?>
                                    <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.sgps.edit', $sgp->id)); ?>">
                                        <?php echo e(trans('global.edit')); ?>

                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sgp_delete')): ?>
                                    <form action="<?php echo e(route('admin.sgps.destroy', $sgp->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
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
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sgp_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.sgps.massDestroy')); ?>",
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
  let table = $('.datatable-Sgp:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/resources/views/admin/sgps/index.blade.php ENDPATH**/ ?>