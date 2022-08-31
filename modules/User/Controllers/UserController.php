<?php

namespace Modules\User\Controllers;

use App\Notifications\AdminChannelServices;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Matrix\Exception;
use Modules\Candidate\Models\Candidate;
use Modules\Candidate\Models\CandidateCvs;
use Modules\Candidate\Models\Category;
use Modules\FrontendController;
use Modules\Location\Models\Location;
use Modules\Skill\Models\Skill;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Events\UserSubscriberSubmit;
use Modules\User\Models\Subscriber;
use Modules\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Modules\Vendor\Models\VendorRequest;
use Validator;
use Modules\Booking\Models\Booking;
use App\Helpers\ReCaptchaEngine;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Booking\Models\Enquiry;
use Illuminate\Support\Str;
use Modules\Candidate\Models\CandidateBstCcm;
use Modules\Candidate\Models\CandidatePassport;
use Modules\Candidate\Models\CandidateSkk;
use Modules\Candidate\Models\CandidateVisa;
use Modules\Company\Models\Company;
use Modules\Job\Models\JobCandidate;
use Modules\Job\Models\Job;

class UserController extends FrontendController
{
    use AuthenticatesUsers;

    protected $enquiryClass;
    protected $company;

    public function __construct()
    {
        $this->enquiryClass = Enquiry::class;
        $this->company = Company::class;
        parent::__construct();
    }

    public function dashboard(Request $request)
    {
        $this->checkPermission('dashboard_vendor_access');
        $user_id = Auth::id();
        $data = [
            'cards_report'       => Booking::getTopCardsReportForVendor($user_id),
            'earning_chart_data' => Booking::getEarningChartDataForVendor(strtotime('monday this week'), time(), $user_id),
            'page_title'         => __("Vendor Dashboard"),
            'breadcrumbs'        => [
                [
                    'name'  => __('Dashboard'),
                    'class' => 'active'
                ]
            ]
        ];
        return view('User::frontend.dashboard', $data);
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        $user_id = Auth::id();
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                return $this->sendSuccess([
                    'data' => Booking::getEarningChartDataForVendor(strtotime($from), strtotime($to), $user_id)
                ]);
                break;
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        $data = [
            'row'         => $user,
            'page_title'       => __("Profile"),
            'is_user_page'     => true,
            'locations' => Location::query()->where('status', 'publish')->get()->toTree(),
            'categories' => Category::get()->toTree(),
            'skills' => Skill::query()->where('status', 'publish')->get(),
            'cvs'   => CandidateCvs::query()->where('origin_id', $user->id)->with('media')->get(),
            'skk'   => CandidateSkk::query()->where('origin_id', $user->id)->with('media')->get(),
            'passport'   => CandidatePassport::query()->where('origin_id', $user->id)->with('media')->get(),
            'visa'   => CandidateVisa::query()->where('origin_id', $user->id)->with('media')->get(),
            'bst_ccm'   => CandidateBstCcm::query()->where('origin_id', $user->id)->with('media')->get()
        ];
        return view('User::frontend.profile', $data);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'phone'       => 'required',
            'email'      => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);
        //        $input = $request->except('bio');
        // dd($user->fill($request->input()));
        $user->fill($request->input());
        $user->bio = clean($request->input('bio'));
        $user->birthday = date("Y-m-d", strtotime($user->birthday));
        $user->save();
        return redirect()->back()->with('success', __('Update successfully'));
    }

    public function changePassword(Request $request)
    {
        $data = [
            'breadcrumbs' => [
                [
                    'name' => __('Setting'),
                    'url'  => route("user.profile.index")
                ],
                [
                    'name'  => __('Change Password'),
                    'class' => 'active'
                ]
            ],
            'page_title'  => __("Change Password"),
        ];
        return view('User::frontend.changePassword', $data);
    }

    public function changePasswordUpdate(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", __("Your current password does not matches with the password you provided. Please try again."));
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", __("New Password cannot be same as your current password. Please choose a different password."));
        }
        $request->validate([
            'current-password' => 'required',
            'new-password'     => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with('success', __('Password changed successfully !'));
    }

    public function bookingHistory(Request $request)
    {
        $user_id = Auth::id();
        $data = [
            'bookings'    => Booking::getBookingHistory($request->input('status'), $user_id),
            'statues'     => config('booking.statuses'),
            'breadcrumbs' => [
                [
                    'name'  => __('Booking History'),
                    'class' => 'active'
                ]
            ],
            'page_title'  => __("Booking History"),
        ];
        return view('User::frontend.bookingHistory', $data);
    }

    public function userLogin(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required'
        ];
        $messages = [
            'email.required'    => __('Email is required field'),
            'email.email'       => __('Email invalidate'),
            'password.required' => __('Password is required field'),
        ];
        if (ReCaptchaEngine::isEnable() and setting_item("recaptcha_enable")) {
            $codeCapcha = $request->input('g-recaptcha-response');
            if (!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)) {
                $errors = new MessageBag(['recaptcha' => __('Please verify the captcha')]);
                return response()->json([
                    'error'    => true,
                    'messages' => $errors
                ], 200);
            }
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors()
            ], 200);
        } else {
            $email = $request->input('email');
            $password = $request->input('password');
            if (Auth::attempt([
                'email'    => $email,
                'password' => $password
            ], $request->has('remember'))) {
                if (in_array(Auth::user()->status, ['blocked'])) {
                    Auth::logout();
                    $errors = new MessageBag(['email' => __('Your account has been blocked')]);
                    return response()->json([
                        'error'    => true,
                        'messages' => $errors,
                        'redirect' => false
                    ], 200);
                }
                if ($request->expectsJson() == true) {
                    return response()->json([
                        'error'    => false,
                        'messages' => false,
                        // 'redirect' => $request->input('redirect') ?? $request->headers->get('referer') ?? url(app_get_locale(false, '/'))
                        'redirect' => url('/admin')
                    ], 200);
                } else {
                    //     echo 'Success Login';
                    // redirect('admin');
                    return redirect()->to('/admin')->with('message', 'Success Login.');
                }
            } else {
                $errors = new MessageBag(['email' => __('Email or password incorrect')]);
                return response()->json([
                    'error'    => true,
                    'messages' => $errors,
                    'redirect' => false
                ], 200);
            }
        }
    }

    public function userRegister(Request $request)
    {
        // var_dump($request->all());die;
        $rules = [
            //            'first_name' => [
            //                'required',
            //                'string',
            //                'max:255'
            //            ],
            //            'last_name'  => [
            //                'required',
            //                'string',
            //                'max:255'
            //            ],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password'   => [
                'required',
                'string'
            ],
            //            'phone'       => ['required','unique:users'],
            //            'term'       => ['required'],
        ];
        $messages = [
            // 'phone.required'      => __('Phone is required field'),
            'email.required'      => __('Email is required field'),
            'email.email'         => __('Email invalidate'),
            'password.required'   => __('Password is required field'),
            //'first_name.required' => __('The first name is required field'),
            // 'last_name.required'  => __('The last name is required field'),
            //'term.required'       => __('The terms and conditions field is required'),
        ];
        if (ReCaptchaEngine::isEnable() and setting_item("recaptcha_enable")) {
            $codeCapcha = $request->input('g-recaptcha-response');
            if (!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)) {
                $errors = new MessageBag(['recaptcha' => __('Please verify the captcha')]);
                return response()->json([
                    'error'    => true,
                    'messages' => $errors
                ], 200);
            }
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors()
            ], 200);
        } else {

            $user = User::create([
                // 'first_name' => $request->input('email'),
                // 'last_name'  => $request->input('last_name'),
                'name' => $request->input('email'),
                'email'      => $request->input('email'),
                'slug'      => $request->input('email'),
                'password'   => Hash::make($request->input('password')),
                'status'    => $request->input('publish', 'publish'),
                'phone'    => $request->input('phone'),
            ]);
            event(new Registered($user));
            Auth::loginUsingId($user->id);
            try {
                event(new SendMailUserRegistered($user));
            } catch (Exception $exception) {
                Log::warning("SendMailUserRegistered: " . $exception->getMessage());
            }
            // $role = $request->input('type');
            $role = 'candidate';
            if (in_array($role, ['employer', 'candidate'])) {
                $user->assignRole($role);
                if ($role == 'employer') {
                    $this->company::firstOrCreate(['name' => $request->input('email'), 'owner_id' => $user->id, 'status' => 'draft']);
                }
                if ($role == 'candidate') {
                    Candidate::query()->insert(['id' => $user->id]);
                }
            }

            if ($request->input('job') == 'urgent') {
                return redirect()->to('/job?orderby=urgent&limit=10');
            } else {
                $row = new JobCandidate();
                $row->job_id = Job::where('slug', $request->input('job'))->first()->id;
                $row->candidate_id = $user->id;
                $row->email = $request->input('email');
                $row->contact_no = $request->input('phone');
                $row->status = 'pending';
                // $row->company_id = $company_id;
                $row->save();
                // return response()->json([
                //     'error'    => false,
                //     'messages' => false,
                //     // 'redirect' => $request->input('redirect') ?? $request->headers->get('referer') ?? url(app_get_locale(false, '/'))
                //     'redirect' => url('/admin')
                // ], 200);

                session()->flash('message', "You have successfully registered. Please Verify your Email.");
                return view('auth.login', ['page_title' => __("Login")]);
            }
        }
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);
        $check = Subscriber::withTrashed()->where('email', $request->input('email'))->first();
        if ($check) {
            if ($check->trashed()) {
                $check->restore();
                return $this->sendSuccess([], __('Thank you for subscribing'));
            }
            return $this->sendError(__('You are already subscribed'));
        } else {
            $a = new Subscriber();
            $a->email = $request->input('email');
            $a->first_name = $request->input('first_name');
            $a->last_name = $request->input('last_name');
            $a->save();

            event(new UserSubscriberSubmit($a));

            return $this->sendSuccess([], __('Thank you for subscribing'));
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect(app_get_locale(false, '/'));
    }
}
