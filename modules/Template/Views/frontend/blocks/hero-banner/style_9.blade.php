<style>
    .banner-section-nine {
        position: relative;
        background-repeat: no-repeat;
        height: 80vh;
    }

    .banner-section-nine::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
    }

    .modal-container {
        background: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center;
        /* pointer-events: none; */
        /* opacity: 0; */
        display: none;
    }

    .modal-custom {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        max-width: 100%;
        height: auto;
        max-height: 80%;
    }

    .modal-image {
        width: 600px;
        max-width: 100%;
        height: auto;
        max-height: 80%;
    }

    .modal-close {
        position: absolute;
        top: 0;
        right: 0;
        width: 32px;
        height: 32px;
        z-index: 9999;
        background: #0e0e0e;
        cursor: pointer;
    }

    .modal-close:hover {
        background: #474747;
    }

    .modal-close-line {
        position: absolute;
        top: 16px;
        right: 8px;
        width: 16px;
        height: 2px;
        background: #fefefe;
    }

    .modal-close-line.one {
        transform: rotate(45deg);
    }

    .modal-close-line.two {
        transform: rotate(-45deg);
    }
</style>
<section class="banner-section-nine"
    style="background-image: url(@if (!empty($banner_image)) {{ $banner_image_url }} @endif)">
    <div class="auto-container">
        <div class="cotnent-box">

            <div class="title-box wow fadeInUp" data-wow-delay='300ms'>
                <h3>{!! $title !!}</h3>
                <div class="text">{{ $sub_title }}</div>
            </div>

            {{-- <div id="popup" class="hidden">
                <div class="bg-close">
                    <img src="quit.png" alt='quit' class='close-popup' id='close-popup' />
                </div>
                <div id="popup-img" class="img">
                    <img src="popup.png" />
                </div>
            </div> --}}

            <div id="modal_container" class="modal-container">
                <div class="modal-custom">
                    {{-- Image --}}
                    <a class="go-to" href="/page/recruitment-procedure">

                        {{-- <img class="modal-image" src="popup.png" /> --}}

                        @if ($logo_id = setting_item('banner_id'))
                            @php $logo = get_file_url($logo_id,'full') @endphp
                            <img src="{{ $logo }}" style="border-radius: 5px">
                        @else
                            <img src="{{ asset('/popup.png') }}" alt="logo">
                        @endif

                    </a>
                    {{-- Close --}}
                    <div id="modal_close" class="modal-close">
                        <span class="modal-close-line one"></span>
                        <span class="modal-close-line two"></span>
                    </div>
                </div>
            </div>

            <!-- Job Search Form -->
            {{-- <div class="job-search-form wow">
                <form method="get" action="{{ route('job.search') }}">
                    <div class="row">
                        <!-- Form Group -->
                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                            <label>{{ __("What job are you looking for") }}?</label>
                            <span class="icon flaticon-search-1"></span>
                            <input type="text" name="field_name" placeholder="{{ __("Job title...") }}">
                        </div>

                        <!-- Form Group -->
                        @if ($location_style == 'autocomplete')
                            @php
                                $location_name = "";
                                $list_json = [];
                                $location_id = request()->get('location');
                                $traverse = function ($locations, $prefix = '') use (&$traverse, &$list_json, &$location_name, $location_id) {
                                    foreach ($locations as $location) {
                                        $translate = $location->translateOrOrigin(app()->getLocale());
                                        if ($location_id == $location->id) {
                                            $location_name = $translate->name;
                                        }
                                        $list_json[] = [
                                            'id'    => $location->id,
                                            'title' => $prefix.' '.$translate->name,
                                        ];
                                        $traverse($location->children, $prefix.'-');
                                    }
                                };
                                $traverse($list_locations);
                            @endphp
                            <div class="form-group col-lg-3 col-md-12 col-sm-12 location smart-search">
                                <label>{{ __("Where") }}?</label>
                                <input type="text" class="smart-search-location parent_text form-control" placeholder="{{__("All City")}}" value="{{ $location_name }}" data-onLoad="{{__("Loading...")}}"
                                       data-default="{{ json_encode($list_json) }}">
                                <input type="hidden" class="child_id" name="location" value="{{ $location_id }}">
                                <span class="icon flaticon-map-locator"></span>
                            </div>
                        @else
                            <div class="form-group col-lg-3 col-md-12 col-sm-12 location bc-select-has-delete">
                                <label>{{ __("Where") }}?</label>
                                <span class="icon flaticon-map-locator"></span>
                                <select class="chosen-select" name="location">
                                    <option value="">{{ __("All City") }}</option>
                                    @php
                                        $traverse = function ($locations, $prefix = '') use (&$traverse) {
                                            foreach ($locations as $location) {
                                                $translate = $location->translateOrOrigin(app()->getLocale());
                                                printf("<option value='%s'>%s</option>", $location->id, $prefix . ' ' . $translate->name);
                                                $traverse($location->children, $prefix . '-');
                                            }
                                        };
                                        $traverse($list_locations);
                                    @endphp
                                </select>
                            </div>
                        @endif
                        <!-- Form Group -->
                        <div class="form-group col-lg-3 col-md-12 col-sm-12 category">
                            <label>{{ __("Categories") }}</label>
                            <span class="icon flaticon-briefcase"></span>
                            <select class="chosen-select">
                                <option value="">{{ __('All Categories')}}</option>
                                @foreach ($list_categories as $cat)
                                    @php
                                        $translate = $cat->translateOrOrigin(app()->getLocale());
                                    @endphp
                                    <option value="{{ $cat->id }}" @if ($cat->id == request()->get('category')) selected @endif  >{{ $translate->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group col-lg-2 col-md-12 col-sm-12 text-right">
                            <button type="submit" class="theme-btn btn-style-two">{{ __("Find Jobs") }}</button>
                        </div>
                    </div>
                </form>
            </div> --}}
            <!-- Job Search Form -->

            <!-- Fun Fact Section -->
            @if (!empty($list_counter))
                <div class="fun-fact-section">
                    <div class="row">
                        <!--Column-->
                        @foreach ($list_counter as $counter)
                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                                <div class="count-box"><span class="count-text" data-speed="3000"
                                        data-stop="{{ $counter['title'] }}">0</span></div>
                                <h4 class="counter-title">{{ $counter['sub_title'] }}</h4>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- Fun Fact Section -->
        </div>
    </div>
</section>

@yield('script.body')
<script type="text/javascript">
    window.onload = function() {
        var modal_container = document.getElementById("modal_container");
        var modal_close = document.getElementById("modal_close");

        setTimeout((event) => {
            modal_container.style.display = 'block';
        }, 2000);

        modal_close.onclick = function() {
            modal_container.style.display = 'none';
        }
    }
</script>
