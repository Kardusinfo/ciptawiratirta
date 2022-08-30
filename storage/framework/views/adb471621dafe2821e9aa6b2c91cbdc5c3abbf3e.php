<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            <?php echo e(trans('panel.site_title')); ?>

        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="<?php echo e(route("admin.home")); ?>" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                <?php echo e(trans('global.dashboard')); ?>

            </a>
        </li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sgp_access')): ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route("admin.sgps.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/sgps") || request()->is("admin/sgps/*") ? "c-active" : ""); ?>">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.sgp.title')); ?>

                </a>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_management_access')): ?>
            <li class="c-sidebar-nav-dropdown <?php echo e(request()->is("admin/permissions*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/roles*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/users*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/audit-logs*") ? "c-show" : ""); ?>">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.userManagement.title')); ?>

                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.permissions.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.permission.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.roles.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.role.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.users.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.user.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('audit_log_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.audit-logs.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.auditLog.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('basic_c_r_m_access')): ?>
            <li class="c-sidebar-nav-dropdown <?php echo e(request()->is("admin/offices*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/jobs*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/principals*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/ships*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/departments*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/crm-statuses*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/crm-customers*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/crm-notes*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/crm-documents*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/user-alerts*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/experiences*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/interviews*") ? "c-show" : ""); ?> <?php echo e(request()->is("admin/departures*") ? "c-show" : ""); ?>">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                    </i>
                    <?php echo e(trans('cruds.basicCRM.title')); ?>

                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('office_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.offices.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/offices") || request()->is("admin/offices/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.office.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('job_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.jobs.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/jobs") || request()->is("admin/jobs/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-id-card c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.job.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('principal_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.principals.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/principals") || request()->is("admin/principals/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.principal.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ship_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.ships.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/ships") || request()->is("admin/ships/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-ship c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.ship.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('department_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.departments.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/departments") || request()->is("admin/departments/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-dolly-flatbed c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.department.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm_status_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.crm-statuses.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/crm-statuses") || request()->is("admin/crm-statuses/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.crmStatus.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm_customer_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.crm-customers.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/crm-customers") || request()->is("admin/crm-customers/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.crmCustomer.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm_note_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.crm-notes.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/crm-notes") || request()->is("admin/crm-notes/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-sticky-note c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.crmNote.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm_document_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.crm-documents.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/crm-documents") || request()->is("admin/crm-documents/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.crmDocument.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_alert_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.user-alerts.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.userAlert.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('experience_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.experiences.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/experiences") || request()->is("admin/experiences/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.experience.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('interview_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.interviews.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/interviews") || request()->is("admin/interviews/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fab fa-internet-explorer c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.interview.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('departure_access')): ?>
                        <li class="c-sidebar-nav-item">
                            <a href="<?php echo e(route("admin.departures.index")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/departures") || request()->is("admin/departures/*") ? "c-active" : ""); ?>">
                                <i class="fa-fw fas fa-anchor c-sidebar-nav-icon">

                                </i>
                                <?php echo e(trans('cruds.departure.title')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <li class="c-sidebar-nav-item">
            <a href="<?php echo e(route("admin.systemCalendar")); ?>" class="c-sidebar-nav-link <?php echo e(request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : ""); ?>">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                <?php echo e(trans('global.systemCalendar')); ?>

            </a>
        </li>
        <?php ($unread = \App\Models\QaTopic::unreadCount()); ?>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(route("admin.messenger.index")); ?>" class="<?php echo e(request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : ""); ?> c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span><?php echo e(trans('global.messages')); ?></span>
                    <?php if($unread > 0): ?>
                        <strong>( <?php echo e($unread); ?> )</strong>
                    <?php endif; ?>

                </a>
            </li>
            <?php if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('profile_password_edit')): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link <?php echo e(request()->is('admin/users/'. Auth::user()->id) || request()->is('admin/users/'. Auth::user()->id .'/*') ? 'c-active' : ''); ?>" href="<?php echo e(url('admin/users/'. Auth::user()->id .'/edit')); ?>">
                        <i class="fa-fw fas fa-user c-sidebar-nav-icon">
                        </i>
                        <?php echo e(trans('Update Profile')); ?>

                    </a>
                </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link <?php echo e(request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : ''); ?>" href="<?php echo e(route('profile.password.edit')); ?>">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            <?php echo e(trans('global.change_password')); ?>

                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    <?php echo e(trans('global.logout')); ?>

                </a>
            </li>
    </ul>

</div><?php /**PATH /Users/failamir/Sites/localhost/superio200/resources/views/partials/menu.blade.php ENDPATH**/ ?>