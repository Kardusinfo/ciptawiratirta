@extends('Layout::auth.app')

@section('content')
<div class="row">
    <div class="col-md-4 mx-auto">
        <div class="text-center">
        <br>
        @if ($site_logo = setting_item('logo_id'))
            <div class="logo">
                <a href="{{ url('/') }}">
                    @php $logo = get_file_url($site_logo,'full') @endphp
                    <img src="{{ $logo }}" alt="{{ setting_item('site_title') }}">
                </a>
            </div>
        @endif
        <br>

        {{-- <div class="image-layer" style="background-image: url({{ asset('popup.png') }});"></div> --}}
        <div class="outer-box">
            <!-- Login Form -->
            <div class="login-form default-form bravo-login-form-page bravo-login-page">
                @if ($site_title = setting_item('site_title'))
                    <h3>{{ __('Create a :site_title Account', ['site_title' => $site_title]) }}</h3>
                @else
                    <h3>{{ __('Register') }}</h3>
                @endif
                @include('Layout::auth.register-form', ['captcha_action' => 'register_normal'])
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
