<!-- Preloader -->
<?php $site_favicon = setting_item('site_favicon') ?>
<?php if(setting_item('enable_preloader')): ?>
    <div class="preloader bc-preload">
        <span class="text"><?php echo e(__('LOADING')); ?></span>
        <?php if($site_favicon): ?>
            <img class="icon" src="<?php echo e(get_file_url($site_favicon, 'full')); ?>"
                alt="<?php echo e(setting_item('site_title')); ?>" />
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php

$header_class = $header_style = $row->header_style ?? 'normal';
$logo_id = setting_item('logo_id');
$logo_white_id = setting_item('logo_white_id');

if ($header_style == 'header-style-two') {
    $logo_id = setting_item('logo_white_id');
}

if (empty($is_home) && $header_style == 'normal' && empty($disable_header_shadow)) {
    $header_class = ' header-shaddow';
}

?>
<?php if($header_style == 'normal'): ?>
    <!-- Header Span -->
    <span class="header-span"></span>
<?php endif; ?>

<!-- Main Header-->
<header class="main-header header-style-two <?php echo e($header_class); ?>">

    <!-- Main box -->
    <div class="main-box">
        <!--Nav Outer -->
        <div class="nav-outer">
            <div class="logo-box">
                <div class="logo">
                    <a href="<?php echo e(home_url()); ?>" class="logo_1" style="display: block">
                        <?php if($logo_id): ?>
                            <?php $logo = get_file_url($logo_id,'full') ?>
                            <img src="<?php echo e($logo); ?>" alt="<?php echo e(setting_item('site_title')); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset('/images/logo.svg')); ?>" alt="logo">
                            
                            

                            
                        <?php endif; ?>
                    </a>
                    <a href="<?php echo e(home_url()); ?>" class="logo_2" style="display: none">
                        <?php if($logo_white_id): ?>
                            <?php $logo2 = get_file_url($logo_white_id,'full') ?>
                            <img src="<?php echo e($logo2); ?>" alt="<?php echo e(setting_item('site_title')); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset('/images/logo.svg')); ?>" alt="logo">
                            
                            

                            
                        <?php endif; ?>
                    </a>
                </div>
            </div>

            <nav class="nav main-menu">
                
                <?php generate_menu('primary'); ?>
            </nav>
            <!-- Main Menu End-->
        </div>

        <div class="outer-box">
            
            <ul class="multi-lang">
                <?php echo $__env->make('Language::frontend.switcher-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </ul>
            <a href="<?php echo e(route('user.wishList.index')); ?>" class="menu-btn mr-3 ml-2">
                <?php if(auth()->check()): ?>
                    <span class="count wishlist_count text-center"><?php echo e((int) auth()->user()->wishlist_count); ?></span>
                <?php endif; ?>
                
            </a>
            <?php if(!(isset($exception) && $exception->getStatusCode() == 404)): ?>
                <!-- Login/Register -->
                <div class="btn-box">
                    <?php if(!Auth::id()): ?>
                        <a href="#"
                            class="theme-btn btn-style-three bc-call-modal login"><?php echo e(__('Login')); ?></a>
                    <?php else: ?>
                        <?php
                            $editProfile = route('user.admin.detail', ['id' => Auth::id()]);
                        ?>
                        <div class="login-item dropmenu-right dropdown show">
                            <a href="#" class="is_login dropdown-toggle" id="dropdownMenuUser"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if($avatar_url = Auth::user()->getAvatarUrl()): ?>
                                    <img class="avatar" src="<?php echo e($avatar_url); ?>"
                                        alt="<?php echo e(Auth::user()->getDisplayName()); ?>">
                                <?php else: ?>
                                    <span class="avatar-text"><?php echo e(ucfirst(Auth::user()->getDisplayName()[0])); ?></span>
                                <?php endif; ?>
                                <span
                                    class="full-name">
                                    
                                </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu text-left" aria-labelledby="dropdownMenuUser">
                                
                                <li class="<?php if(Auth::user()->hasPermission('dashboard_vendor_access')): ?> menu-hr <?php endif; ?>">
                                    <a href="<?php echo e(route('user.profile.index')); ?>"><?php echo e(__('My profile')); ?></a>
                                </li>
                                <?php if(setting_item('inbox_enable')): ?>
                                    <li class="menu-hr"><a href="<?php echo e(route('user.chat')); ?>"><?php echo e(__('Messages')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <li class="menu-hr"><a
                                        href="<?php echo e(route('user.change_password')); ?>"><?php echo e(__('Change password')); ?></a>
                                </li>
                                <?php if(is_employer()): ?>
                                        
                                    
                                    
                                    
                                    
                                <?php endif; ?>
                                <?php if(is_candidate() && !is_admin()): ?>
                                    <li class="menu-hr"><a
                                            href="<?php echo e(route('candidate.admin.myApplied')); ?>"><?php echo e(__('My Applied')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <li class="menu-hr">
                                    <a href="<?php echo e(url('/admin')); ?>">
                                        <?php if(is_admin()): ?>
                                            <?php echo e(__('Admin Dashboard')); ?>

                                        <?php elseif(is_candidate()): ?>
                                            
                                        <?php else: ?>
                                            <?php echo e(__('Employer Dashboard')); ?>

                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="menu-hr">
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo e(__('Logout')); ?></a>
                                </li>
                            </ul>
                            <form id="logout-form" action="<?php echo e(route('auth.logout')); ?>" method="POST"
                                style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </div>
                    <?php endif; ?>
                    
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo">
            <a href="<?php echo e(url(app_get_locale(false, '/'))); ?>">
                <?php if($logo= setting_item('logo_id')): ?>
                    <?php $logo = get_file_url($logo,'full') ?>
                    <img src="<?php echo e($logo); ?>" alt="<?php echo e(setting_item('site_title')); ?>">
                <?php else: ?>
                    <img src="<?php echo e(asset('/images/logo.svg')); ?>" alt="logo">
                <?php endif; ?>
            </a>
        </div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">

            <div class="outer-box">
                <!-- Login/Register -->
                <div class="login-box">
                    <?php if(!Auth::id()): ?>
                        <a href="#" class="bc-call-modal login"><span class="icon-user"></span></a>
                    <?php else: ?>
                        <?php
                            $editProfile = route('user.admin.detail', ['id' => Auth::id()]);
                        ?>
                        <a href="#" class="is_login dropdown-toggle" id="dropdownMenuUser" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <?php if($avatar_url = Auth::user()->getAvatarUrl()): ?>
                                <img class="avatar" src="<?php echo e($avatar_url); ?>"
                                    alt="<?php echo e(Auth::user()->getDisplayName()); ?>">
                            <?php else: ?>
                                <span class="avatar-text"><?php echo e(ucfirst(Auth::user()->getDisplayName()[0])); ?></span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu text-left" aria-labelledby="dropdownMenuUser">

                            <li class="<?php if(Auth::user()->hasPermission('dashboard_vendor_access')): ?> menu-hr <?php endif; ?>">
                                <a href="<?php echo e(route('user.profile.index')); ?>"><?php echo e(__('My profile')); ?></a>
                            </li>
                            <?php if(setting_item('inbox_enable')): ?>
                                <li class="menu-hr"><a href="<?php echo e(route('user.chat')); ?>"><?php echo e(__('Messages')); ?></a></li>
                            <?php endif; ?>
                            <li class="menu-hr"><a
                                    href="<?php echo e(route('user.change_password')); ?>"><?php echo e(__('Change password')); ?></a></li>
                            
                            <?php if(is_candidate() && !is_admin()): ?>
                                <li class="menu-hr"><a
                                        href="<?php echo e(route('candidate.admin.myApplied')); ?>"><?php echo e(__('My Applied')); ?></a>
                                </li>
                            <?php endif; ?>
                            <li class="menu-hr">
                                <a href="<?php echo e(url('/admin')); ?>">
                                    <?php if(is_admin()): ?>
                                        <?php echo e(__('Admin Dashboard')); ?>

                                    <?php elseif(is_candidate()): ?>
                                        <?php echo e(__('Candidate Dashboard')); ?>

                                    <?php else: ?>
                                        <?php echo e(__('Employer Dashboard')); ?>

                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="menu-hr">
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo e(__('Logout')); ?></a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>

                <a href="#nav-mobile" class="mobile-nav-toggler"><span class="flaticon-menu-1"></span></a>
            </div>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
</header>
<!--End Main Header -->



<style>
    .depth-1 a, .depth-0 a {
        /* color: #051650 !important; */
        color: #f9faff !important
    }

    .main-header.header-style-two.header-style-two .depth-0 a{
        color: #ffffff !important;
    }
    .main-header.header-style-two.header-style-two .dropdown.depth-0 ul li a{
        color: #051650 !important;
    }

    .main-header.header-style-two.normal .depth-0 a {
        color: #051650 !important;
    }

    .main-header.header-style-two.normal.fixed-header.animated.slideInDown .depth-0 a {
        color: #ffffff !important;
    }

    .main-header.header-style-two.header-shaddow .main-box .outer-box .login-item .is_login {
        color: #051650;
    }

    .main-header.header-style-two.header-shaddow.fixed-header.animated.slideInDown .main-box .outer-box .login-item .is_login {
        color: #ffffff;
    }

    .main-header.header-style-two.normal .main-box .outer-box .login-item .is_login {
        color: #051650;
    }

    .main-header.header-style-two.normal.fixed-header.animated.slideInDown .main-box .outer-box .login-item .is_login {
        color: #ffffff;
    }

    #nav-mobile .mm-panels #navbar .mm-listview .mm-listitem .mm-listitem__text {
        color: #ffffff !important;
    }
    #nav-mobile .mm-panels #navbar .mm-listview .mm-listitem .mm-listitem__text {
        color: #ffffff !important;
    }


</style><?php /**PATH /home/forkomdi/ciptawiratirta.com/modules/Layout/parts/header.blade.php ENDPATH**/ ?>