<?php
$menus = [
    // 'admin'=>[
    //     'url'   => 'admin',
    //     'title' => __("Dashboard"),
    //     'icon'  => 'icon ion-ios-desktop',
    //     "position"=>0
    // ],
    'menu' => [
        'position' => 60,
        'url' => 'admin/module/core/menu',
        'title' => __('Menu'),
        'icon' => 'icon ion-ios-apps',
        'permission' => 'menu_manage',
    ],
    'general' => [
        'position' => 80,
        'url' => 'admin/module/core/settings/index/general',
        'title' => __('Setting'),
        'icon' => 'icon ion-ios-cog',
        'permission' => 'setting_manage',
        'children' => \Modules\Core\Models\Settings::getSettingPages(),
    ],
    'tools' => [
        'position' => 90,
        'url' => 'admin/module/core/tools',
        'title' => __('Tools'),
        'icon' => 'icon ion-ios-hammer',
        'permission' => 'setting_manage',
        'children' => [
            'language' => [
                'url' => 'admin/module/language',
                'title' => __('Languages'),
                'permission' => 'language_manage',
            ],
            'translations' => [
                'url' => 'admin/module/language/translations',
                'title' => __('Translation Manager'),
                'permission' => 'language_translation',
            ],
            'logs' => [
                'url' => 'admin/logs',
                'title' => __('System Logs'),
                'permission' => 'system_log_view',
            ],
        ],
    ],
];

if (Auth::id()) {
    if (Auth::user()->hasPermission('candidate_manage') && !Auth::user()->hasPermission('candidate_manage_others')) {
        $menus['candidate_my_profile'] = [
            'position' => 27,
            // 'url'        => route('user.admin.detail',['id'=>Auth::id()]),
            'url' => url('user/profile'),
            'title' => __('My Profile'),
            'icon' => 'ion-md-finger-print',
            'permission' => 'candidate_manage',
        ];
        // $menus['candidate_my_contact'] = [
        //     "position"=> 28,
        //     'url'        => route('candidate.admin.myContact'),
        //     'title'      => __("My Contact"),
        //     'icon'       => 'ion-md-mail',
        //     'permission' => 'candidate_manage'
        // ];
    }
}

// Modules
$custom_modules = \Modules\ServiceProvider::getModules();
if (!empty($custom_modules)) {
    foreach ($custom_modules as $module) {
        $moduleClass = '\\Modules\\' . ucfirst($module) . '\\ModuleProvider';
        if (class_exists($moduleClass)) {
            $menuConfig = call_user_func([$moduleClass, 'getAdminMenu']);

            if (!empty($menuConfig)) {
                $menus = array_merge($menus, $menuConfig);
            }

            $menuSubMenu = call_user_func([$moduleClass, 'getAdminSubMenu']);

            if (!empty($menuSubMenu)) {
                foreach ($menuSubMenu as $k => $submenu) {
                    $submenu['id'] = $submenu['id'] ?? '_' . $k;

                    if (!empty($submenu['parent']) and isset($menus[$submenu['parent']])) {
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(
                            \Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                                return $value['position'] ?? 100;
                            }),
                        );
                    }
                }
            }
        }
    }
}

// Plugins Menu
$plugins_modules = \Plugins\ServiceProvider::getModules();
if (!empty($plugins_modules)) {
    foreach ($plugins_modules as $module) {
        $moduleClass = '\\Plugins\\' . ucfirst($module) . '\\ModuleProvider';
        if (class_exists($moduleClass)) {
            $menuConfig = call_user_func([$moduleClass, 'getAdminMenu']);
            if (!empty($menuConfig)) {
                $menus = array_merge($menus, $menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass, 'getAdminSubMenu']);
            if (!empty($menuSubMenu)) {
                foreach ($menuSubMenu as $k => $submenu) {
                    $submenu['id'] = $submenu['id'] ?? '_' . $k;
                    if (!empty($submenu['parent']) and isset($menus[$submenu['parent']])) {
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(
                            \Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                                return $value['position'] ?? 100;
                            }),
                        );
                    }
                }
            }
        }
    }
}

// Custom Menu
$custom_modules = \Custom\ServiceProvider::getModules();
if (!empty($custom_modules)) {
    foreach ($custom_modules as $module) {
        $moduleClass = '\\Custom\\' . ucfirst($module) . '\\ModuleProvider';
        if (class_exists($moduleClass)) {
            $menuConfig = call_user_func([$moduleClass, 'getAdminMenu']);

            if (!empty($menuConfig)) {
                $menus = array_merge($menus, $menuConfig);
            }

            $menuSubMenu = call_user_func([$moduleClass, 'getAdminSubMenu']);

            if (!empty($menuSubMenu)) {
                foreach ($menuSubMenu as $k => $submenu) {
                    $submenu['id'] = $submenu['id'] ?? '_' . $k;
                    if (!empty($submenu['parent']) and isset($menus[$submenu['parent']])) {
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(
                            \Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                                return $value['position'] ?? 100;
                            }),
                        );
                    }
                }
            }
        }
    }
}

// $currentUrl = url(\Modules\Core\Walkers\MenuWalker::getActiveMenu());
// $user = \Illuminate\Support\Facades\Auth::user();
// if (!empty($menus)){
//     foreach ($menus as $k => $menuItem) {

//         if (!empty($menuItem['permission']) and !$user->hasPermission($menuItem['permission'])) {
//             unset($menus[$k]);
//             continue;
//         }
//         $menus[$k]['class'] = $currentUrl == url($menuItem['url']) ? 'active' : '';
//         if (!empty($menuItem['children'])) {
//             $menus[$k]['class'] .= ' has-children';
//             foreach ($menuItem['children'] as $k2 => $menuItem2) {
//                 if (!empty($menuItem2['permission']) and !$user->hasPermission($menuItem2['permission'])) {
//                     unset($menus[$k]['children'][$k2]);
//                     continue;
//                 }
//                 $menus[$k]['children'][$k2]['class'] = $currentUrl == url($menuItem2['url']) ? 'active' : '';
//             }
//         }
//     }

//     //@todo Sort Menu by Position
//     $menus = array_values(\Illuminate\Support\Arr::sort($menus, function ($value) {
//         return $value['position'] ?? 100;
//     }));
// }

?>
{{-- <ul class="main-menu">
    @foreach ($menus as $menuItem)
        @php $menuItem['class'] .= " ".str_ireplace("/","_",$menuItem['url']) @endphp
        <li class="{{$menuItem['class']}} position-{{ $menuItem['position'] }}"><a href="{{ url($menuItem['url']) }}">
                @if (!empty($menuItem['icon']))
                    <span class="icon text-center"><i class="{{$menuItem['icon']}}"></i></span>
                @endif
                {!! clean($menuItem['title'],[
                    'Attr.AllowedClasses'=>null
                ]) !!}
            </a>
            @if (!empty($menuItem['children']))
                <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span>
                <ul class="children">
                    @foreach ($menuItem['children'] as $menuItem2)
                        <li class="{{$menuItem['class']}}"><a href="{{ url($menuItem2['url']) }}">
                                @if (!empty($menuItem2['icon']))
                                    <i class="{{$menuItem2['icon']}}"></i>
                                @endif
                                {!! clean($menuItem2['title'],[
                                    'Attr.AllowedClasses'=>null
                                ]) !!}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul> --}}

@if(Auth::user()->role_id == 1)
<ul class="main-menu">

    <li class=" has-children admin_module_company position-22"><a href="/admin/module/company">
            <span class="icon text-center"><i class="ion-md-bookmarks"></i></span>
            Principal
        </a>
        <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span>
        <ul class="children">
            <li class=" has-children admin_module_company"><a href="/admin/module/company">
                    All Principal</a>
            </li>
            <li class=" has-children admin_module_company"><a href="/admin/module/company/create">
                    Add Principal</a>
            </li>
            <li class=" has-children admin_module_company"><a href="/admin/module/company/attribute">
                    Attributes</a>
            </li>
            <li class=" has-children admin_module_company"><a href="/admin/module/company/category">
                    Ship</a>
            </li>
        </ul>
    </li>

    <li class=" has-children admin_module_job position-24"><a href="/admin/module/job">
            <span class="icon text-center"><i class="ion-ios-briefcase"></i></span>
            Job
        </a>
        <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span>
        <ul class="children">
            <li class=" has-children admin_module_job"><a href="/admin/module/job">
                    All Jobs</a>
            </li>
            <li class=" has-children admin_module_job"><a href="/admin/module/job/create">
                    Add Job</a>
            </li>
            <li class=" has-children admin_module_job"><a href="/admin/module/job/job-type">
                    Job Types</a>
            </li>
            <li class=" has-children admin_module_job"><a href="/admin/module/job/category">
                    Category</a>
            </li>
        </ul>
    </li>

    <li class=" admin_module_job_all-applicants position-25"><a href="/admin/module/job/all-applicants">
            <span class="icon text-center"><i class="ion-ios-briefcase"></i></span>
            All Applicants
        </a>
    </li>

    <li class=" has-children admin_module_news position-10"><a href="/admin/module/news">
            <span class="icon text-center"><i class="ion-md-bookmarks"></i></span>
            News
        </a>
        <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span>
        <ul class="children">
            <li class="active has-children admin_module_news"><a href="/admin/module/news/create">
                    Add News</a>
            </li>
            <li class="active has-children admin_module_news"><a href="/admin/module/news/category">
                    Categories</a>
            </li>
            <li class="active has-children admin_module_news"><a href="/admin/module/news/tag">
                    Tags</a>
            </li>
        </ul>
    </li>

    <li class=" has-children admin_module_candidate position-26"><a href="/admin/module/candidate">
            <span class="icon text-center"><i class="ion-md-bookmarks"></i></span>
            All Candidate
        </a>
        {{-- <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span> --}}
        <ul class="children">
            <li class=" has-children admin_module_candidate"><a href="/admin/module/candidate">
                    All Candidates</a>
            </li>
            <li class=" has-children admin_module_candidate"><a href="/admin/module/user/create?candidate_create=1">
                    Add Candidate</a>
            </li>
            <li class=" has-children admin_module_candidate"><a href="/admin/module/candidate/category">
                    Category</a>
            </li>
        </ul>
    </li>

    <li class=" has-children"><a href="#">
            <span class="icon text-center"><i class="ion-md-bookmarks"></i></span>
            Other Menu
        </a>
        <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span>
        <ul class="children">


            <li class=" admin_module_page position-20"><a href="/admin/module/page">
                    <span class="icon text-center"><i class="icon ion-ios-bookmarks"></i></span>
                    Page
                </a>
            </li>




            <li class=" admin_module_company_my-contact position-28"><a href="/admin/module/company/my-contact">
                    <span class="icon text-center"><i class="ion-md-mail"></i></span>
                    My Contact
                </a>
            </li>
            <li class=" admin_module_skill position-30"><a href="/admin/module/skill">
                    <span class="icon text-center"><i class="icon ion-md-bookmarks"></i></span>
                    Skill
                </a>
            </li>
            <li class=" admin_module_location position-40"><a href="/admin/module/location">
                    <span class="icon text-center"><i class="icon ion-md-compass"></i></span>
                    Location
                </a>
            </li>
            <li class=" admin_module_user_plan position-50"><a href="/admin/module/user/plan">
                    <span class="icon text-center"><i class="icon ion-ios-contacts"></i></span>
                    User Plans
                </a>
            </li>
            <li class=" admin_module_review position-55"><a href="/admin/module/review">
                    <span class="icon text-center"><i class="icon ion-ios-text"></i></span>
                    Reviews
                </a>
            </li>
            <li class=" admin_module_core_menu position-60"><a href="/admin/module/core/menu">
                    <span class="icon text-center"><i class="icon ion-ios-apps"></i></span>
                    Menu
                </a>
            </li>
            <li class=" admin_module_template position-70"><a href="/admin/module/template">
                    <span class="icon text-center"><i class="icon ion-logo-html5"></i></span>
                    Templates
                </a>
            </li>
            <li class=" has-children admin_module_core_settings_index_general position-80"><a
                    href="/admin/module/core/settings/index/general">
                    <span class="icon text-center"><i class="icon ion-ios-cog"></i></span>
                    Setting
                </a>
                {{-- <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span> --}}
                <ul class="children">
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/general">
                            General Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/gig">
                            Gig Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/candidate">
                            Candidate Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/company">
                            Company Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/job">
                            Job Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/news">
                            News Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/order">
                            Order Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/email">
                            Email Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/user">
                            User Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/user_plans">
                            User Plans Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/payment">
                            Payment Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/style">
                            Style Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/advance">
                            Advance Settings</a>
                    </li>
                    <li class=" has-children admin_module_core_settings_index_general"><a
                            href="/admin/module/core/settings/index/sms">
                            Sms Settings</a>
                    </li>
                </ul>
            </li>
            <li class=" has-children admin_module_core_tools position-90"><a href="/admin/module/core/tools">
                    <span class="icon text-center"><i class="icon ion-ios-hammer"></i></span>
                    Tools
                </a>
                {{-- <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span> --}}
                <ul class="children">
                    <li class=" has-children admin_module_core_tools"><a href="/admin/module/language">
                            Languages</a>
                    </li>
                    <li class=" has-children admin_module_core_tools"><a href="/admin/module/language/translations">
                            Translation Manager</a>
                    </li>
                    <li class=" has-children admin_module_core_tools"><a href="/admin/logs">
                            System Logs</a>
                    </li>
                    <li class=" has-children admin_module_core_tools"><a href="/admin/module/core/plugins">
                            Plugins</a>
                    </li>
                </ul>
            </li>
            <li class=" has-children admin_module_user position-100"><a href="/admin/module/user">
                    <span class="icon text-center"><i class="icon ion-ios-contacts"></i></span>
                    Users
                </a>
                {{-- <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span> --}}
                <ul class="children">
                    <li class=" has-children admin_module_user"><a href="/admin/module/user">
                            All Users</a>
                    </li>
                    <li class=" has-children admin_module_user"><a href="/admin/module/user/role">
                            Role Manager</a>
                    </li>
                    <li class=" has-children admin_module_user"><a href="/admin/module/user/subscriber">
                            Subscribers</a>
                    </li>
                </ul>
            </li>
            <li class=" has-children admin_module_contact position-200"><a href="/admin/module/contact">
                    <span class="icon text-center"><i class="icon ion ion-md-stats"></i></span>
                    Report
                </a>
                {{-- <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span> --}}
                <ul class="children">
                    <li class=" has-children admin_module_contact"><a href="/admin/module/contact">
                            Contact Submissions</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

</ul>

@elseif(Auth::user()->role_id != 1)
<li class=" admin_module_job_all-applicants position-25"><a href="/admin/module/job/all-applicants">
    <span class="icon text-center"><i class="ion-ios-briefcase"></i></span>
    My Profile
</a>
</li>


<li class=" admin_module_job_all-applicants position-25"><a href="/admin/module/job/all-applicants">
    <span class="icon text-center"><i class="ion-ios-briefcase"></i></span>
    My Document
</a>
</li>

<li class=" admin_module_job_all-applicants position-25"><a href="/admin/module/job/all-applicants">
    <span class="icon text-center"><i class="ion-ios-briefcase"></i></span>
    My Applied
</a>
</li>

<li class=" admin_module_job_all-applicants position-25"><a href="/admin/module/job/all-applicants">
    <span class="icon text-center"><i class="ion-ios-briefcase"></i></span>
    Departure Scheduled 
</a>
</li>

@endif