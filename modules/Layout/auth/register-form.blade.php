<form class="form bravo-form-register" method="post">
    @csrf
    <form method="post" action="#">
        <div class="form-group">
            <div class="btn-box row">
                {{-- <div class="col-lg-6 col-md-12"> --}}
                <input class="checked" style="display: none" type="radio" name="type" id="checkbox1" value="candidate"
                    checked />
                {{-- <label for="checkbox1" class="theme-btn btn-style-four"><i class="la la-user"></i> {{ __("Candidate") }}</label> --}}
                {{-- </div> --}}
                {{-- <div class="col-lg-6 col-md-12"> --}}
                <input class="checked"style="display: none" type="radio" name="type" id="checkbox2"
                    value="employer" />
                {{-- <label for="checkbox2" class="theme-btn btn-style-four"><i class="la la-briefcase"></i> {{ __("Employer") }}</label> --}}
                {{-- </div> --}}
            </div>
        </div>

        <div class="form-group text-left">
            <label>{{ __('Email address') }}</label>
            <input type="email" name="email" placeholder="{{ __('Email address') }}" required>
            <span class="invalid-feedback error error-email"></span>
        </div>

        <div class="form-group text-left">
            <label>{{ __('Password') }}</label>
            <input id="password-field" type="password" name="password" value=""
                placeholder="{{ __('Password') }}">
            <span class="invalid-feedback error error-password"></span>
        </div>

        <div class="form-group text-left">
            <label>{{ __('Retype Password') }}</label>
            <input id="password-field" type="password" name="retype_password" value=""
                placeholder="{{ __('Retype Password') }}">
            <span class="invalid-feedback error error-password"></span>
        </div>
        @php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); @endphp
        <input id="password-field" type="hidden" name="job" value="{{ $_GET['job'] }}"
        placeholder="{{ __('Retype Password') }}">
        <div class="form-group text-left">
            <label>{{ __('No HP') }}</label>
            <input id="password-field" type="text" name="phone" value=""
                placeholder="{{ __('Phone Number') }}">
            <span class="invalid-feedback error error-password"></span>
        </div>

<<<<<<< HEAD
        {{-- @php
            $job = \Modules\Job\Models\Job::with('category','company')->get();
        @endphp
        <div class="form-group">
            
=======
        @php
            $job = \Modules\Job\Models\Job::with('category','company')->get();
        @endphp
        <div class="form-group">
            {{-- @dump($job[0]->category->name) --}}
>>>>>>> origin/back
            <label>{{ __('Posisi') }}</label>
            <select name="job_id" id="job_id" class="form-control">
                @foreach ($job as $item)
                    <option value="{{ $item->id }}">{{ $item->title . ' | ' . $item->category->name . ' | ' . $item->company->name}}</option>
                @endforeach
<<<<<<< Updated upstream
        </div>
=======
            </select>
        </div> --}}
{{-- >>>>>>> Stashed changes --}}
        @if (setting_item('recaptcha_enable'))
            <div class="form-group">
                {{ recaptcha_field($captcha_action ?? 'register') }}
                <span class="invalid-feedback error error-recaptcha"></span>
            </div>
        @endif

        <div class="form-group">
            <button class="theme-btn btn-style-one " type="submit" name="Register">{{ __('Sign Up') }}
                <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
            </button>
        </div>
    </form>
    @if (setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable'))
        <div class="bottom-box">
            <div class="divider"><span>or</span></div>
            <div class="btn-box row">
                @if (setting_item('facebook_enable'))
                    <div class="col-lg-6 col-md-12">
                        <a href="{{ url('/social-login/facebook') }}"
                            class="theme-btn social-btn-two facebook-btn btn_login_fb_link"><i
                                class="fab fa-facebook-f"></i>{{ __('Facebook') }}</a>
                    </div>
                @endif
                @if (setting_item('google_enable'))
                    <div class="col-lg-6 col-md-12">
                        <a href="{{ url('social-login/google') }}"
                            class="theme-btn social-btn-two google-btn btn_login_gg_link"><i
                                class="fab fa-google"></i>{{ __('Google') }}</a>
                    </div>
                @endif
            </div>
        </div>
    @endif
</form>

<script type="text/javascript">
    $('#country').change(function(){
    var country_id = $(this).val();    
    if(country_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_id="+country_id,
           success:function(res){ 
           console.log(res);              
            if(res){
                $("#state").empty();
                $("#state").append('<option>Select</option>');
                $.each(res,function(key){
                    $("#state").append('<option value="'+res[key].id+'">'+res[key].title+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }      
   });
    $('#state').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('get-city-list')}}?state_id="+stateID,
           success:function(res){               
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+res[key].id+'">'+res[key].title+'</option>');
                });
           
            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }
        
   });
</script>