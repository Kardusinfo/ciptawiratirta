@extends ('layouts.app')
@section ('content')
    @if($row->template_id)
        <div class="page-template-content page-{{$row->slug}}">
            {!! $row->getProcessedContent() !!}
        </div>
    @else
        <section class="tnc-section">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <h2>{{$translation->title}}</h2>
                    <div class="text"><a href="{{ home_url() }}">{{ __("Home") }}</a> / {{$translation->title}}</div>
                </div>
                <div class="blog-content">
                    {!! $translation->content !!}
                </div>
            </div>
        </section>
    @endif
@endsection

<style>
    .tnc-section .blog-content img {
        border-radius: 8px;
        margin-bottom: 24px;
    }
</style>

@section('footer')
<script>
$(window).on('scroll', function() {
    if ($('.slideInDown').length > 0) {
        $('.logo_2').show();
        $('.logo_1').hide();

        $('.nav.main-menu ul .depth-1 a').attr('style', 'color:#051650 !important');

        $('.main-header.header-style-two.header-shaddow .main-box .outer-box .login-item .is_login').attr('style', 'color:#ffffff !important');
        $('.main-header.header-style-two.header-shaddow.fixed-header.animated.slideInDown .main-box .outer-box .login-item .is_login').attr('style', 'color:#ffffff !important');
    }else{
        $('.logo_2').hide();
        $('.logo_1').show();

        $('.nav.main-menu ul .depth-1 a').attr('style', 'color:#051650 !important');
        
        $('.main-header.header-style-two.header-shaddow .main-box .outer-box .login-item .is_login').attr('style', 'color:#051650 !important');
        $('.main-header.header-style-two.header-shaddow.fixed-header.animated.slideInDown .main-box .outer-box .login-item .is_login').attr('style', 'color:#ffffff !important');

    }
    });
</script>
@endsection