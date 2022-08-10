<!-- Preloader -->
@php $site_favicon = setting_item('site_favicon') @endphp
@if (setting_item('enable_preloader'))
    <div class="preloader bc-preload">
        <span class="text">{{ __('LOADING') }}</span>
        @if ($site_favicon)
            <img class="icon" src="{{ get_file_url($site_favicon, 'full') }}"
                alt="{{ setting_item('site_title') }}" />
        @endif
    </div>
@endif

@php

$header_class = $header_style = $row->header_style ?? 'normal';
$logo_id = setting_item('logo_id');
$logo_white_id = setting_item('logo_white_id');

if ($header_style == 'header-style-two') {
    $logo_id = setting_item('logo_white_id');
}

if (empty($is_home) && $header_style == 'normal' && empty($disable_header_shadow)) {
    $header_class = ' header-shaddow';
}

@endphp
@if ($header_style == 'normal')
    <!-- Header Span -->
    <span class="header-span"></span>
@endif

<!-- Main Header-->
<header class="main-header header-style-two {{ $header_class }}">
{{-- <header class="main-header header-style-two fixed-header animated slideInDown"> --}}
    <!-- Main box -->
    <div class="main-box">
        <!--Nav Outer -->
        <div class="nav-outer">
            <div class="logo-box">
                <div class="logo">
                    <a href="{{ home_url() }}" class="logo_1" style="display: block">
                        @if ($logo_id)
                            @php $logo = get_file_url($logo_id,'full') @endphp
                            <img src="{{ $logo }}" alt="{{ setting_item('site_title') }}">
                        @else
                            <img src="{{ asset('/images/logo.svg') }}" alt="logo">
                            {{-- @php $logo_white = get_file_url($logo_white_id,'full') @endphp --}}
                            {{-- @php $logo_white_id = setting_item('logo_white_id'); @endphp --}}

                            {{-- <img src="{{ $logo_white_id }}" alt="{{ setting_item('site_title') }}"> --}}
                        @endif
                    </a>
                    <a href="{{ home_url() }}" class="logo_2" style="display: none">
                        @if ($logo_white_id)
                            @php $logo2 = get_file_url($logo_white_id,'full') @endphp
                            <img src="{{ $logo2 }}" alt="{{ setting_item('site_title') }}">
                        @else
                            <img src="{{ asset('/images/logo.svg') }}" alt="logo">
                            {{-- @php $logo_white = get_file_url($logo_white_id,'full') @endphp --}}
                            {{-- @php $logo_white_id = setting_item('logo_white_id'); @endphp --}}

                            {{-- <img src="{{ $logo_white_id }}" alt="{{ setting_item('site_title') }}"> --}}
                        @endif
                    </a>
                </div>
            </div>

            <nav class="nav main-menu">
                {{-- <div class="dropmenu-right dropdown show">
                <ul class="dropdown-menu text-left" aria-labelledby="Our Services">
                    <li class="menu-hr"><a href="{{ url('/page/manning-services') }}">{{ __('Manning Services') }}</a></li>
                    <li class="menu-hr"><a href="{{ url('/page/insurance') }}">{{ __('Insurance') }}</a></li>
                </ul>
                </div> --}}
                <?php generate_menu('primary'); ?>
            </nav>
            <!-- Main Menu End-->
        </div>

        <div class="outer-box">
            {{-- <ul class="navigation" id="navbar" aria-labelledby="Our Services">
                <li class="depth-0"><a href="{{ url('/page/manning-services') }}">{{ __('Manning Services') }}</a></li>
                <li class="depth-0"><a href="{{ url('/page/insurance') }}">{{ __('Insurance') }}</a></li>
            </ul> --}}
            <ul class="multi-lang">
                @include('Language::frontend.switcher-dropdown')
            </ul>
            <a href="{{ route('user.wishList.index') }}" class="menu-btn mr-3 ml-2">
                @if (auth()->check())
                    <span class="count wishlist_count text-center">{{ (int) auth()->user()->wishlist_count }}</span>
                @endif
                {{-- <span class="icon la la-bookmark-o"></span> --}}
            </a>
            @if (!(isset($exception) && $exception->getStatusCode() == 404))
                <!-- Login/Register -->
                <div class="btn-box">
                    @if (!Auth::id())
                        <a href="#"
                            class="theme-btn btn-style-three bc-call-modal login">{{ __('Login') }}</a>
                    @else
                        @php
                            $editProfile = route('user.admin.detail', ['id' => Auth::id()]);
                        @endphp
                        <div class="login-item dropmenu-right dropdown show">
                            <a href="#" class="is_login dropdown-toggle" id="dropdownMenuUser"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if ($avatar_url = Auth::user()->getAvatarUrl())
                                    <img class="avatar" src="{{ $avatar_url }}"
                                        alt="{{ Auth::user()->getDisplayName() }}">
                                @else
                                    <span class="avatar-text">{{ ucfirst(Auth::user()->getDisplayName()[0]) }}</span>
                                @endif
                                <span
                                    class="full-name">{{ __('Hi, :Name', ['name' => Auth::user()->getDisplayName()]) }}</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu text-left" aria-labelledby="dropdownMenuUser">
                                {{-- @if (Modules\Gig\Models\Gig::isEnable())
                                    <li>
                                        @has_permission('gig_manage')
                                        <a href="{{ route('seller.dashboard') }}">{{ __('Seller Dashboard') }}</a>
                                        <a href="{{ route('seller.orders') }}">{{ __('Gig Orders') }}</a>
                                    @else
                                        <a href="{{ route('buyer.orders') }}">{{ __('Gig Orders') }}</a>
                                        @end_has_permission
                                    </li>
                                @endif --}}
                                <li class="@if (Auth::user()->hasPermission('dashboard_vendor_access')) menu-hr @endif">
                                    <a href="{{ route('user.profile.index') }}">{{ __('My profile') }}</a>
                                </li>
                                @if (setting_item('inbox_enable'))
                                    <li class="menu-hr"><a href="{{ route('user.chat') }}">{{ __('Messages') }}</a>
                                    </li>
                                @endif
                                <li class="menu-hr"><a
                                        href="{{ route('user.change_password') }}">{{ __('Change password') }}</a>
                                </li>
                                @if (is_employer())
                                    <li class="menu-hr"><a
                                            href="{{ route('job.admin.index') }}">{{ __('My Jobs') }}</a></li>
                                    <li class="menu-hr"><a
                                            href="{{ route('job.admin.allApplicants') }}">{{ __('All Applicants') }}</a>
                                    </li>
                                    {{-- <li class="menu-hr"><a href="{{ route('user.plan') }}">{{ __('My Plans') }}</a>
                                    </li> --}}
                                    {{-- <li class="menu-hr"><a href="{{ route('user.order') }}">{{ __('My Orders') }}</a>
                                    </li> --}}
                                    {{-- <li class="menu-hr"><a
                                            href="{{ route('company.admin.myContact') }}">{{ __('My Contact') }}</a>
                                    </li> --}}
                                @endif
                                @if (is_candidate() && !is_admin())
                                    <li class="menu-hr"><a
                                            href="{{ route('candidate.admin.myApplied') }}">{{ __('My Applied') }}</a>
                                    </li>
                                @endif
                                <li class="menu-hr">
                                    <a href="{{ url('/admin') }}">
                                        @if (is_admin())
                                            {{ __('Admin Dashboard') }}
                                        @elseif(is_candidate())
                                            {{-- {{ __('Candidate Dashboard') }} --}}
                                        @else
                                            {{ __('Employer Dashboard') }}
                                        @endif
                                    </a>
                                </li>
                                <li class="menu-hr">
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    @endif
                    {{-- @if (is_employer())
                        <div class="d-flex align-items-center">
                            <a href="{{ route('job.admin.create') }}" class="theme-btn @if ($header_style == 'header-style-two') btn-style-five @else btn-style-one @endif @if (!auth()->check()) bc-call-modal login @endif">{{ __("Job Post") }}</a>
                        </div>
                    @endif --}}
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo">
            <a href="{{ url(app_get_locale(false, '/')) }}">
                @if ($logo= setting_item('logo_id'))
                    @php $logo = get_file_url($logo,'full') @endphp
                    <img src="{{ $logo }}" alt="{{ setting_item('site_title') }}">
                @else
                    <img src="{{ asset('/images/logo.svg') }}" alt="logo">
                @endif
            </a>
        </div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">

            <div class="outer-box">
                <!-- Login/Register -->
                <div class="login-box">
                    @if (!Auth::id())
                        <a href="#" class="bc-call-modal login"><span class="icon-user"></span></a>
                    @else
                        @php
                            $editProfile = route('user.admin.detail', ['id' => Auth::id()]);
                        @endphp
                        <a href="#" class="is_login dropdown-toggle" id="dropdownMenuUser" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            @if ($avatar_url = Auth::user()->getAvatarUrl())
                                <img class="avatar" src="{{ $avatar_url }}"
                                    alt="{{ Auth::user()->getDisplayName() }}">
                            @else
                                <span class="avatar-text">{{ ucfirst(Auth::user()->getDisplayName()[0]) }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu text-left" aria-labelledby="dropdownMenuUser">

                            <li class="@if (Auth::user()->hasPermission('dashboard_vendor_access')) menu-hr @endif">
                                <a href="{{ route('user.profile.index') }}">{{ __('My profile') }}</a>
                            </li>
                            @if (setting_item('inbox_enable'))
                                <li class="menu-hr"><a href="{{ route('user.chat') }}">{{ __('Messages') }}</a></li>
                            @endif
                            <li class="menu-hr"><a
                                    href="{{ route('user.change_password') }}">{{ __('Change password') }}</a></li>
                            @if (is_employer())
                                <li class="menu-hr"><a href="{{ route('job.admin.index') }}">{{ __('My Jobs') }}</a>
                                </li>
                                <li class="menu-hr"><a
                                        href="{{ route('job.admin.allApplicants') }}">{{ __('All Applicants') }}</a>
                                </li>
                            @endif
                            @if (is_candidate() && !is_admin())
                                <li class="menu-hr"><a
                                        href="{{ route('candidate.admin.myApplied') }}">{{ __('My Applied') }}</a>
                                </li>
                            @endif
                            <li class="menu-hr">
                                <a href="{{ url('/admin') }}">
                                    @if (is_admin())
                                        {{ __('Admin Dashboard') }}
                                    @elseif(is_candidate())
                                        {{ __('Candidate Dashboard') }}
                                    @else
                                        {{ __('Employer Dashboard') }}
                                    @endif
                                </a>
                            </li>
                            <li class="menu-hr">
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            </li>
                        </ul>
                    @endif
                </div>

                <a href="#nav-mobile" class="mobile-nav-toggler"><span class="flaticon-menu-1"></span></a>
            </div>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
</header>
<!--End Main Header -->

@section('footer')
<script>
    const headerStyleTwo = document.getElementsByClassName('slideInDown');
    
    $(window).on('scroll', function() {
        if ($('.slideInDown').length > 0) {
            $('.logo_2').show();
            $('.logo_1').hide();
            $('.nav.main-menu ul .depth-1 a').attr('style', 'color:#051650 !important');
            $('.main-header.header-style-two.header-shaddow .main-box .outer-box .login-item .is_login').attr('style', 'color:#ffffff !important');
            // console.log($('#id_logo').val())
        }else{
            $('.logo_2').hide();
            $('.logo_1').show();
            $('.nav.main-menu ul .depth-1 a').attr('style', 'color:#051650 !important');
            $('.main-header.header-style-two.header-shaddow .main-box .outer-box .login-item .is_login').attr('style', 'color:#051650 !important');

            // $('.logo_1').hide();
            // console.log($('#id_logo_two').val())
        }
});
</script>
@endsection

<style>
    .depth-1 a {
        color: black !important;
    }

    .main-header.header-style-two.header-shaddow .main-box .outer-box .login-item .is_login {
        color: #051650;
    }
</style>