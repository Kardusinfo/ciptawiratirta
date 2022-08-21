<?php $__env->startSection('title', 'All Applicants'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-4">
            <h1 class="title-bar"><?php echo e(__('All Applicants')); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-end ">
            
            <div class="col-left">
                <form method="get" action="<?php echo e(route('job.admin.allApplicants')); ?> "
                    class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <?php if(is_admin()): ?>
                        <?php
                        $company = \Modules\Company\Models\Company::find(Request()->input('company_id'));
                        \App\Helpers\AdminForm::select2(
                            'company_id',
                            [
                                'configs' => [
                                    'ajax' => [
                                        'url' => route('company.admin.getForSelect2'),
                                        'dataType' => 'json',
                                    ],
                                    'allowClear' => true,
                                    'placeholder' => __('-- Select Company --'),
                                ],
                            ],
                            !empty($company->id) ? [$company->id, $company->name . ' (#' . $company->id . ')'] : false,
                        );
                        
                        $candidate = \App\User::find(Request()->input('candidate_id'));
                        \App\Helpers\AdminForm::select2(
                            'candidate_id',
                            [
                                'configs' => [
                                    'ajax' => [
                                        'url' => route('candidate.admin.getForSelect2'),
                                        'dataType' => 'json',
                                    ],
                                    'allowClear' => true,
                                    'placeholder' => __('-- Select Candidate --'),
                                ],
                            ],
                            !empty($candidate->id) ? [$candidate->id, $candidate->getDisplayName() . ' (#' . $candidate->id . ')'] : false,
                        );
                        ?>
                    <?php endif; ?>
                    <?php
                        $job = \Modules\Job\Models\Job::find(Request()->input('job_id'));
                        \App\Helpers\AdminForm::select2(
                            'job_id',
                            [
                                'configs' => [
                                    'ajax' => [
                                        'url' => route('job.admin.getForSelect2'),
                                        'dataType' => 'json',
                                    ],
                                    'allowClear' => true,
                                    'placeholder' => __('-- Select Job --'),
                                ],
                            ],
                            !empty($job->id) ? [$job->id, $job->title . ' (#' . $job->id . ')'] : false,
                        );
                    ?>

                    <button class="btn-info btn btn-icon btn_search" type="submit"><?php echo e(__('Search')); ?></button>
                </form>
                <form method="post" action="<?php echo e(route('job.admin.applicants.bulkEdit')); ?>"
                        class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row">
                        <?php echo e(csrf_field()); ?>

                        <select name="action" class="form-control">
                            <option value=""><?php echo e(__(' Bulk Actions ')); ?></option>
                            <option value="approved"><?php echo e(__('Approved')); ?></option>
                            <option value="rejected"><?php echo e(__('Rejected')); ?></option>
                        </select>
                        <button data-confirm="<?php echo e(__('Do you want to delete?')); ?>"
                            class="btn-info btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Apply')); ?></button>
                        <a class="btn btn-warning btn-icon ml-3" href="<?php echo e(route('job.admin.applicants.export')); ?>"
                            target="_blank" title="<?php echo e(__('Export to excel')); ?>"><i
                                class="icon ion-md-cloud-download"></i>&nbsp;<?php echo e(__('Export')); ?>

                        </a>
                </form>
            </div>
        </div>
        <div class="row">
           
        </div>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                font-family: Arial;
            }

            /* Style the tab */
            .tab {
                overflow: hidden;
                border: 1px solid #ccc;
                background-color: #f1f1f1;
            }

            /* Style the buttons inside the tab */
            .tab button {
                background-color: inherit;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                transition: 0.3s;
                font-size: 17px;
            }

            /* Change background color of buttons on hover */
            .tab button:hover {
                background-color: #ddd;
            }

            /* Create an active/current tablink class */
            .tab button.active {
                background-color: #ccc;
            }

            /* Style the tab content */
            .tabcontent {
                display: none;
                padding: 6px 12px;
                border: 1px solid #ccc;
                border-top: none;
            }
        </style>
        

            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'Paris')">(<?php echo e(\Modules\Job\Models\JobCandidate::where('status', 'pending')->count()); ?>) Profile Not Completed</button>
                <button class="tablinks" onclick="openCity(event, 'London')">(<?php echo e(\Modules\Job\Models\JobCandidate::where('status', 'profile_completed')->count()); ?>) Ready to Approve</button>
                <button class="tablinks" onclick="openCity(event, 'Tokyo')">(<?php echo e(\Modules\Job\Models\JobCandidate::where('status', 'approved')->count()); ?>) Approved</button>
                <button class="tablinks" onclick="openCity(event, 'Kelsi')">(<?php echo e(\Modules\Job\Models\JobCandidate::where('status', 'rejected')->count()); ?>) Rejected</button>
                <button class="tablinks" onclick="openCity(event, 'Andri')">All</button>
            </div>


            <div id="London" class="tabcontent">
                <h3>Profile Completed</h3>
                <p>Sudah Lengkap dan Siap di Approve Atau Reject.</p>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form action="" class="bravo-form-item">
                                <div class="table-responsive">
                                    <table class="table table-hover table-vertical-middle">
                                        <thead>
                                            <tr>
                                                <th class="title"> <?php echo e(__('Action')); ?></th>
                                                <th width="60px"><input type="checkbox" class="check-all"></th>
    
                                                <th class="title"> <?php echo e(__('Candidate')); ?></th>
                                                <th> <?php echo e(__('Job Title')); ?></th>
                                                <th width="150px"> <?php echo e(__('CV')); ?></th>
                                                <th width="150px"> <?php echo e(__('Date Applied')); ?></th>
                                                <th width="100px"> <?php echo e(__('Status')); ?></th>
                                                
                                                <th width="100px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($rows->total() > 0): ?>
                                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($row->status == 'profile_completed'): ?>
                                                    <tr class="<?php echo e($row->status); ?>">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <?php echo e(__('Actions')); ?>

                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('job.admin.applicants.changeStatus', ['status' => 'edit', 'id' => $row->id])); ?>"><?php echo e(__('Approved ')); ?></a>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('job.admin.applicants.changeStatus', ['status' => 'rejected', 'id' => $row->id])); ?>"><?php echo e(__('Rejected')); ?></a>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="modal-applied-<?php echo e($row->id); ?>">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
    
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                <?php echo e(__('Applied Detail')); ?></h4>
                                                                        </div>
    
                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Candidate:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                                                    target="_blank">
                                                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Job Title:')); ?></div>
                                                                                        <div class="val">
                                                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('CV:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                                                    target="_blank" download>
                                                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Message:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e($row->message); ?></div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Date Applied:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e(display_date($row->created_at)); ?>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Status:')); ?></div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal"><?php echo e(__('Close')); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="<?php echo e($row->id); ?>">
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                    target="_blank">
                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="title">
                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                    target="_blank" download>
                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e(display_date($row->created_at)); ?></td>
                                                        <td><span
                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                        </td>
                                                        
                                                    </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7"><?php echo e(__('No data')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <?php echo e($rows->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div id="Paris" class="tabcontent">
                <h3>Pending</h3>
                <p>Cek Kelengkapan Pelamar.</p>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form action="" class="bravo-form-item">
                                <div class="table-responsive">
                                    <table class="table table-hover table-vertical-middle">
                                        <thead>
                                            <tr>
                                                <th class="title"> <?php echo e(__('Action')); ?></th>
                                                <th width="60px"><input type="checkbox" class="check-all"></th>
    
                                                <th class="title"> <?php echo e(__('Candidate')); ?></th>
                                                <th> <?php echo e(__('Job Title')); ?></th>
                                                <th width="150px"> <?php echo e(__('CV')); ?></th>
                                                <th width="150px"> <?php echo e(__('Date Applied')); ?></th>
                                                <th width="100px"> <?php echo e(__('Status')); ?></th>
                                                
                                                <th width="100px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($rows->total() > 0): ?>
                                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($row->status == 'pending'): ?>
                                                    <tr class="<?php echo e($row->status); ?>">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <?php echo e(__('Actions')); ?>

                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    
                                                                    <a class="dropdown-item" href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>" data-toggle="modal"
                                                                        data-target="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"><?php echo e(__('Detail')); ?></a>
                                                                        <a class="dropdown-item"
                                                                        href="<?php echo e(route('job.admin.applicants.changeStatus', ['status' => 'profile_completed', 'id' => $row->id])); ?>"><?php echo e(__('Approved Kelengkapan')); ?></a>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('job.admin.applicants.changeStatus', ['status' => 'pending', 'id' => $row->id])); ?>"><?php echo e(__('Rejected Kelengkapan')); ?></a>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="modal-applied-<?php echo e($row->id); ?>">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
    
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                <?php echo e(__('Applied Detail')); ?></h4>
                                                                        </div>
    
                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Candidate:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                                                    target="_blank">
                                                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Job Title:')); ?></div>
                                                                                        <div class="val">
                                                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('CV:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                                                    target="_blank" download>
                                                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Message:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e($row->message); ?></div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Date Applied:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e(display_date($row->created_at)); ?>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Status:')); ?></div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal"><?php echo e(__('Close')); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="<?php echo e($row->id); ?>">
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                    target="_blank">
                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="title">
                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                    target="_blank" download>
                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e(display_date($row->created_at)); ?></td>
                                                        <td><span
                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                        </td>
                                                        
                                                    </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7"><?php echo e(__('No data')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <?php echo e($rows->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div id="Tokyo" class="tabcontent">
                <h3>Approved</h3>
                <p>Pelamar yang Sudah di Approved.</p>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form action="" class="bravo-form-item">
                                <div class="table-responsive">
                                    <table class="table table-hover table-vertical-middle">
                                        <thead>
                                            <tr>
                                                <th class="title"> <?php echo e(__('Action')); ?></th>
                                                <th width="60px"><input type="checkbox" class="check-all"></th>
    
                                                <th class="title"> <?php echo e(__('Candidate')); ?></th>
                                                <th> <?php echo e(__('Job Title')); ?></th>
                                                <th width="150px"> <?php echo e(__('CV')); ?></th>
                                                <th width="150px"> <?php echo e(__('Date Applied')); ?></th>
                                                <th width="100px"> <?php echo e(__('Status')); ?></th>
                                                <th width="100px"> <?php echo e(__('Remarks')); ?></th>
                                                <th width="100px"> <?php echo e(__('Crew Code')); ?></th>
                                                <th width="100px"> <?php echo e(__('Source')); ?></th>
                                                <th width="100px"> <?php echo e(__('Applied Position')); ?></th>
                                                <th width="100px"> <?php echo e(__('Department')); ?></th>
                                                <th width="100px"> <?php echo e(__('Gender')); ?></th>
                                                <th width="100px"> <?php echo e(__('D.O.B')); ?></th>
                                                <th width="100px"> <?php echo e(__('Age')); ?></th>
                                                <th width="100px"> <?php echo e(__('vaccination yf')); ?></th>
                                                <th width="100px"> <?php echo e(__('vaccination covid 19')); ?></th>
                                                <th width="100px"> <?php echo e(__('CID')); ?></th>
                                                <th width="100px"> <?php echo e(__('COC')); ?></th>
                                                <th width="100px"> <?php echo e(__('Rating Able')); ?></th>
                                                <th width="100px"> <?php echo e(__('CCM')); ?></th>
                                                <th width="100px"> <?php echo e(__('Experience')); ?></th>
                                                <th width="100px"> <?php echo e(__('Application Form')); ?></th>
                                                <th width="100px"> <?php echo e(__('Contact No')); ?></th>
                                                <th width="100px"> <?php echo e(__('interview date')); ?></th>
                                                <th width="100px"> <?php echo e(__('interview by')); ?></th>
                                                <th width="100px"> <?php echo e(__('interview result')); ?></th>
                                                <th width="100px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($rows->total() > 0): ?>
                                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($row->status == 'approved'): ?>
                                                    <tr class="<?php echo e($row->status); ?>">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <?php echo e(__('Actions')); ?>

                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('job.admin.applicants.changeStatus', ['status' => 'rejected', 'id' => $row->id])); ?>"><?php echo e(__('Rejected')); ?></a>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="modal-applied-<?php echo e($row->id); ?>">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
    
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                <?php echo e(__('Applied Detail')); ?></h4>
                                                                        </div>
    
                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Candidate:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                                                    target="_blank">
                                                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Job Title:')); ?></div>
                                                                                        <div class="val">
                                                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('CV:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                                                    target="_blank" download>
                                                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Message:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e($row->message); ?></div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Date Applied:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e(display_date($row->created_at)); ?>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Status:')); ?></div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal"><?php echo e(__('Close')); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="<?php echo e($row->id); ?>">
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                    target="_blank">
                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="title">
                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                    target="_blank" download>
                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e(display_date($row->created_at)); ?></td>
                                                        <td><span
                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                        </td>
                                                        <td><?php echo e($row->remarks); ?></td>
                                                        <td><?php echo e($row->crew_code); ?></td>
                                                        <td><?php echo e($row->source); ?></td>
                                                        <td><?php echo e($row->applied_position); ?></td>
                                                        <td><?php echo e($row->department); ?></td>
                                                        <td><?php echo e($row->gender); ?></td>
                                                        <td><?php echo e($row->d_o_b); ?></td>
                                                        <td><?php echo e($row->age); ?></td>
                                                        <td><?php echo e($row->vaccination_yf); ?></td>
                                                        <td><?php echo e($row->vaccination_covid_19); ?></td>
                                                        <td><?php echo e($row->cid); ?></td>
                                                        <td><?php echo e($row->coc); ?></td>
                                                        <td><?php echo e($row->rating_able); ?></td>
                                                        <td><?php echo e($row->ccm); ?></td>
                                                        <td><?php echo e($row->experience); ?></td>
                                                        <td><?php echo e($row->application_form); ?></td>
                                                        <td><?php echo e($row->contact_no); ?></td>
                                                        <td><?php echo e($row->interview_date); ?></td>
                                                        <td><?php echo e($row->interview_by); ?></td>
                                                        <td><?php echo e($row->interview_result); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7"><?php echo e(__('No data')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <?php echo e($rows->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div id="Kelsi" class="tabcontent">
                <h3>Rejected Applicants</h3>
                <p>Pelamar yang ditolak.</p>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form action="" class="bravo-form-item">
                                <div class="table-responsive">
                                    <table class="table table-hover table-vertical-middle">
                                        <thead>
                                            <tr>
                                                <th class="title"> <?php echo e(__('Action')); ?></th>
                                                <th width="60px"><input type="checkbox" class="check-all"></th>
    
                                                <th class="title"> <?php echo e(__('Candidate')); ?></th>
                                                <th> <?php echo e(__('Job Title')); ?></th>
                                                <th width="150px"> <?php echo e(__('CV')); ?></th>
                                                <th width="150px"> <?php echo e(__('Date Applied')); ?></th>
                                                <th width="100px"> <?php echo e(__('Status')); ?></th>
                                                
                                                <th width="100px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($rows->total() > 0): ?>
                                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($row->status == 'rejected'): ?>
                                                    <tr class="<?php echo e($row->status); ?>">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <?php echo e(__('Actions')); ?>

                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    
                                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                                        data-target="#modal-applied-<?php echo e($row->id); ?>"><?php echo e(__('Detail')); ?></a>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('job.admin.applicants.changeStatus', ['status' => 'edit', 'id' => $row->id])); ?>"><?php echo e(__('Approved')); ?></a>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="modal-applied-<?php echo e($row->id); ?>">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
    
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                <?php echo e(__('Applied Detail')); ?></h4>
                                                                        </div>
    
                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Candidate:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                                                    target="_blank">
                                                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Job Title:')); ?></div>
                                                                                        <div class="val">
                                                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('CV:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                                                    target="_blank" download>
                                                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Message:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e($row->message); ?></div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Date Applied:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e(display_date($row->created_at)); ?>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Status:')); ?></div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal"><?php echo e(__('Close')); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="<?php echo e($row->id); ?>">
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                    target="_blank">
                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="title">
                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                    target="_blank" download>
                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e(display_date($row->created_at)); ?></td>
                                                        <td><span
                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                        </td>
                                                        
                                                    </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7"><?php echo e(__('No data')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <?php echo e($rows->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div id="Andri" class="tabcontent">
                <h3>All Applicants</h3>
                <p>Tokyo is the capital of Japan.</p>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form action="" class="bravo-form-item">
                                <div class="table-responsive" id="horizontal">
                                    <table class="table table-hover table-vertical-middle">
                                        <thead>
                                            <tr>
                                                <th class="title"> <?php echo e(__('Action')); ?></th>
                                                <th width="60px"><input type="checkbox" class="check-all"></th>
    
                                                <th class="title"> <?php echo e(__('Candidate')); ?></th>
                                                <th> <?php echo e(__('Job Title')); ?></th>
                                                <th width="150px"> <?php echo e(__('CV')); ?></th>
                                                <th width="150px"> <?php echo e(__('Date Applied')); ?></th>
                                                <th width="100px"> <?php echo e(__('Status')); ?></th>
                                                
                                                <th width="100px"> <?php echo e(__('interview date')); ?></th>
                                                <th width="100px"> <?php echo e(__('interview by')); ?></th>
                                                <th width="100px"> <?php echo e(__('interview result')); ?></th>
                                                <th width="100px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($rows->total() > 0): ?>
                                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="<?php echo e($row->status); ?>">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <?php echo e(__('Actions')); ?>

                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('job.admin.applicants.changeStatus', ['status' => 'edit', 'id' => $row->id])); ?>"><?php echo e(__('Edit')); ?></a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                                        data-target="#modal-applied-<?php echo e($row->id); ?>"><?php echo e(__('Detail')); ?></a>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('job.admin.applicants.changeStatus', ['status' => 'approved', 'id' => $row->id])); ?>"><?php echo e(__('Approved')); ?></a>
                                                                    <a class="dropdown-item"
                                                                        href="<?php echo e(route('job.admin.applicants.changeStatus', ['status' => 'rejected', 'id' => $row->id])); ?>"><?php echo e(__('Rejected')); ?></a>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="modal-applied-<?php echo e($row->id); ?>">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
    
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                <?php echo e(__('Applied Detail')); ?></h4>
                                                                        </div>
    
                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Candidate:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                                                    target="_blank">
                                                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Job Title:')); ?></div>
                                                                                        <div class="val">
                                                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('CV:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                                                    target="_blank" download>
                                                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                                                </a>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Message:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e($row->message); ?></div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Date Applied:')); ?></div>
                                                                                        <div class="val">
                                                                                            <?php echo e(display_date($row->created_at)); ?>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            <?php echo e(__('Status:')); ?></div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal"><?php echo e(__('Close')); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="<?php echo e($row->id); ?>">
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->candidateInfo->getAuthor->getDisplayName())): ?>
                                                                <a href="<?php echo e($row->candidateInfo->getDetailUrl()); ?>"
                                                                    target="_blank">
                                                                    <img src="<?php echo e($row->candidateInfo->getAuthor->getAvatarUrl()); ?>"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    <?php echo e($row->candidateInfo->getAuthor->getDisplayName() ?? ''); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="title">
                                                            <a href="<?php echo e($row->jobInfo->getDetailUrl()); ?>"
                                                                target="_blank"><?php echo e($row->jobInfo->title); ?></a>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($row->cvInfo->file_id)): ?>
                                                                <?php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) ?>
                                                                <a href="<?php echo e(\Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id)); ?>"
                                                                    target="_blank" download>
                                                                    <?php echo e($file->file_name . '.' . $file->file_extension); ?>

                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e(display_date($row->created_at)); ?></td>
                                                        <td><span
                                                                class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                                        </td>
                                                        
                                                        <td><?php echo e($row->interview_date); ?></td>
                                                        <td><?php echo e($row->interview_by); ?></td>
                                                        <td><?php echo e($row->interview_result); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="7"><?php echo e(__('No data')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <?php echo e($rows->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>

            <script>
                function openCity(evt, cityName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " active";
                }
            </script>

        
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/failamir/Sites/localhost/superio200/modules/Job/Views/admin/job/all-applicants.blade.php ENDPATH**/ ?>