<?php
namespace Modules\Job\Admin;

use App\Notifications\PrivateChannelServices;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\AdminController;
use Modules\Job\Models\JobCategory as Category;
use Modules\Job\Events\EmployerChangeApplicantsStatus;
use Modules\Job\Exports\ApplicantsExport;
use Modules\Job\Models\Job;
use Modules\Job\Models\JobCandidate;
use Modules\Job\Models\JobTranslation;
use Modules\Job\Models\JobType;
use Modules\Language\Models\Language;
use Modules\Location\Models\Location;
use Modules\Skill\Models\Skill;

class JobController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/job');
        if(!is_admin()){
            $this->middleware('verified');
        }
    }

    public function index(Request $request)
    {
        $this->checkPermission('job_manage');
        $job_query = Job::query()->with(['location', 'category', 'company'])->orderBy('id', 'desc');
        $title = $request->query('s');
        $cate = $request->query('category_id');
        $company_id = $request->query('company_id');
        if ($cate) {
            $job_query->where('category_id', $cate);
        }
        if($company_id){
            $job_query->where('company_id', $company_id);
        }
        if ($title) {
            $job_query->where('title', 'LIKE', '%' . $title . '%');
            $job_query->orderBy('title', 'asc');
        }
        if(!is_admin()){
            $company_id = Auth::user()->company->id ?? '';
            $job_query->where('company_id', $company_id);
        }

        $data = [
            'rows'        => $job_query->paginate(20),
            'breadcrumbs' => [
                [
                    'name' => __('Job'),
                    'url'  => 'admin/module/job'
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            "languages"=>Language::getActive(false),
            "locale"=>\App::getLocale(),
            'page_title'=>__("Jobs Management")
        ];
        return view('Job::admin.job.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('job_manage');

        if(!is_admin()){
            if(!auth()->user()->checkJobPlan()) {
                return redirect(route('user.plan'));
            }elseif(!auth()->user()->checkJobPostingMaximum()){
                return redirect(route('job.admin.index'))->with('error', __('You posted the maximum number of jobs') );
            }
        }

        $row = new Job();
        $row->fill([
            'status' => 'publish',
        ]);
        $data = [
            'categories'        => Category::get()->toTree(),
            'job_types' => JobType::query()->where('status', 'publish')->get(),
            'job_skills' => Skill::query()->where('status', 'publish')->get(),
            'job_location'     => Location::where('status', 'publish')->get()->toTree(),
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('Job'),
                    'url'  => 'admin/module/job'
                ],
                [
                    'name'  => __('Add Job'),
                    'class' => 'active'
                ],
            ],
            'translation' => new JobTranslation()
        ];
        return view('Job::admin.job.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('job_manage');

        $row = Job::with('skills')->find($id);

        $translation = $row->translateOrOrigin($request->query('lang'));
        $company_id = Auth::user()->company->id ?? '';

        if (empty($row)) {
            return redirect(route('job.admin.index'));
        }elseif(!is_admin() && $company_id != $row->company_id){
            return redirect(route('job.admin.index'));
        }

        $data = [
            'row'  => $row,
            'translation'  => $translation,
            'categories' => Category::query()->where('status', 'publish')->get()->toTree(),
            'job_location' => Location::query()->where('status', 'publish')->get()->toTree(),
            'job_types' => JobType::query()->where('status', 'publish')->get(),
            'job_skills' => Skill::query()->where('status', 'publish')->get(),
            'enable_multi_lang'=>true,
            'breadcrumbs' => [
                [
                    'name' => __('Job'),
                    'url'  => 'admin/module/job'
                ],
                [
                    'name'  => $row->title,
                    'class' => 'active'
                ],
            ],
        ];
        return view('Job::admin.job.detail', $data);
    }

    public function store(Request $request, $id){
        $this->checkPermission('job_manage');

        if(!empty($request->input('salary_max')) && (int)$request->input('salary_max') > 0 && !empty($request->input('salary_min')) && (int)$request->input('salary_min') > 0) {
            $check = Validator::make($request->input(), [
                'salary_max' => 'required|gt:salary_min'
            ]);
            if (!$check->validated()) {
                return back()->withInput($request->input());
            }
        }

        if(!is_admin() and !auth()->user()->checkJobPlan()){
            return redirect(route('user.plan'));
        }

        if($id>0){
            $row = Job::find($id);
            if (empty($row)) {
                return redirect(route('job.admin.index'));
            }
        }else{

            $row = new Job();
            $row->status = "publish";
        }
        $input = $request->input();
        $attr = [
            'title',
            'content',
            'category_id',
            'thumbnail_id',
            'location_id',
            'company_id',
            'job_type_id',
            'expiration_date',
            'hours',
            'hours_type',
            'salary_min',
            'salary_max',
            'salary_type',
            'gender',
            'map_lat',
            'map_lng',
            'map_zoom',
            'experience',
            'is_featured',
            'is_urgent',
            'status',
            'create_user',
            'apply_type',
            'apply_link',
            'apply_email',
            'wage_agreement',
            'gallery',
            'video',
            'video_cover_id'
        ];
        if (!empty($input['wage_agreement'])){
            $input['salary_min'] = 0;
            $input['salary_max'] = 0;
        }
        $row->fillByAttr($attr, $input);
        if($request->input('slug')){
            $row->slug = $request->input('slug');
        }
        if(empty($request->input('create_user'))){
            $row->create_user = Auth::id();
        }
        if(empty($request->input('company_id')) && !is_admin()){
            $user = User::with('company')->find(Auth::id());
            if(!empty($user->company)){
                $row->company_id = $user->company->id;
            }
        }

        $res = $row->saveOriginOrTranslation($request->query('lang'),true);
        $row->skills()->sync($request->input('job_skills') ?? []);

        if ($res) {
            if($id > 0 ){
                return back()->with('success',  __('Job updated') );
            }else{
                return redirect(route('job.admin.edit',$row->id))->with('success', __('Job created') );
            }
        }
    }

    public function bulkEdit(Request $request)
    {
        if(!is_admin() and !auth()->user()->checkJobPlan()){
            return redirect(route('user.plan'));
        }
        $this->checkPermission('job_manage');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Job::where("id", $id);
                if (!$this->hasPermission('job_manage_others')) {
                    $company_id = Auth::user()->company->id ?? '';
                    $query->where('company_id', $company_id);
                    $this->checkPermission('job_manage');
                }
                $query->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Job::where("id", $id);
                if (!$this->hasPermission('job_manage_others')) {
                    $company_id = Auth::user()->company->id ?? '';
                    $query->where('company_id', $company_id);
                    $this->checkPermission('job_manage');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }

    public function statusApplicants(Request $request){
        $this->setActiveMenu('admin/module/job/all-applicants');
        $candidate_id = $request->query('candidate_id');
        $rows = JobCandidate::with(['jobInfo', 'candidateInfo', 'cvInfo', 'company', 'company.getAuthor'])
            ->whereHas('jobInfo', function ($q) use($request){
                $job_id = $request->query('job_id');
                $company_id = $request->query('company_id');
                if (!$this->hasPermission('job_manage_others')) {
                    $company_id = Auth::user()->company->id ?? '';
                    $q->where('company_id', $company_id);
                }
                if( $company_id && $this->hasPermission('job_manage_others')){
                    $q->where('company_id', $company_id);
                }
                if($job_id){
                    $q->where("id", $job_id);
                }
            });

        if( $candidate_id && $this->hasPermission('job_manage_others')){
            $rows->where('candidate_id', $candidate_id);
        }

        $rows = $rows->orderBy('id', 'desc')
            ->paginate(20);
        $data = [
            'rows' => $rows
        ];
        return view('Job::admin.job.status-applicants', $data);
    }

    public function statusapplicantsChangeStatus($status, $id){
        $this->checkPermission('job_manage');

        $row = JobCandidate::with('jobInfo', 'jobInfo.user', 'candidateInfo', 'company', 'company.getAuthor')
            ->where('id', $id);

        if (!$this->hasPermission('job_manage_others')) {
            $row = $row->whereHas('jobInfo', function ($q){
                $company_id = Auth::user()->company->id ?? '';
                $q->where('company_id', $company_id);
            });
        };
        $row = $row->first();
        if (empty($row)){
            return redirect()->back()->with('error', __('Item not found!'));
        }

        
        if($status == 'edit'){
            $data = JobCandidate::find($id);
            $user = User::find($data->candidate_id);
            $job = Job::find($data->job_id);
            // $data = array_merge(['crew_code' => 1234], $data);
            // var_dump($data);die;
            // return redirect()->back()->with('success', __('Update success!'));
            return view('Job::admin.job.edit-applicants', compact('data','user','job'));
            // echo 'edit';die;
        }

        $old_status = $row->status;
        if($status != 'approved' && $status != 'rejected' && $status != 'completed' && $status != 'pending'){
            return redirect()->back()->with('error', __('Status unavailable'));
        }

        $row->status = $status;
        $row->save();
        //Send Notify and email
        // if($status == 'update'){
        //     // $request = new Request();
        //     $request = $status;
        //     var_dump($request);die;
            
        // }

        if($old_status != $status) {
            event(new EmployerChangeApplicantsStatus($row));
            return redirect()->back()->with('success', __('Update success!'));
        }   
    }

    public function statusapplicantsUpdate(Request $request){
        // var_dump($request->all());die;
        $this->checkPermission('job_manage');

        $row = JobCandidate::with('jobInfo', 'jobInfo.user', 'candidateInfo', 'company', 'company.getAuthor')
            ->where('id', $request->input('id'));

        if (!$this->hasPermission('job_manage_others')) {
            $row = $row->whereHas('jobInfo', function ($q){
                $company_id = Auth::user()->company->id ?? '';
                $q->where('company_id', $company_id);
            });
        };
        $row = $row->first();
        if (empty($row)){
            return redirect()->back()->with('error', __('Item not found!'));
        }
        $row->status = $request->input('status');
        $row->email = $request->input('email');
        $row->remarks = $request->input('remarks');
        $row->crew_code = $request->input('crew_code');
        $row->date_of_entry = $request->input('date_of_entry');
        $row->source = $request->input('source');
        $row->last_name = $request->input('last_name');
        $row->applied_position = $request->input('applied_position');
        $row->department = $request->input('department');
        $row->gender = $request->input('gender');
        $row->d_o_b = $request->input('d_o_b');
        $row->age = $request->input('age');
        $row->vaccination_yf = $request->input('vaccination_yf');
        $row->vaccination_covid_19 = $request->input('vaccination_covid_19');
        $row->cid = $request->input('cid');
        $row->coc = $request->input('coc');
        $row->ccm = $request->input('ccm');
        $row->rating_able = $request->input('rating_able');
        $row->experience = $request->input('experience');
        $row->application_form = $request->input('application_form');
        $row->contact_no = $request->input('contact_no');
        $row->interview_date = $request->input('interview_date');
        $row->interview_by = $request->input('interview_by');
        $row->interview_result = $request->input('interview_result');
        $row->approved_as = $request->input('approved_as');
        $row->save();
        return redirect('admin/module/job/all-applicants')->with('success', __('Update success!'));
    }

    public function statusapplicantsBulkEdit(Request $request){
        $this->checkPermission('job_manage');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        foreach ($ids as $id) {
            $query = JobCandidate::with('jobInfo', 'jobInfo.user', 'candidateInfo', 'company', 'company.getAuthor')->where('id', $id);
            if (!$this->hasPermission('job_manage_others')) {
                $query = $query->whereHas('jobInfo', function ($q){
                    $company_id = Auth::user()->company->id ?? '';
                    $q->where('company_id', $company_id);
                });
            }
            $query = $query->first();
            $old_status = $query->status;
            $query->status = $action;
            $query->save();
            //Send Notify and Email
            if($old_status != $action) {
                event(new EmployerChangeApplicantsStatus($query));
            }

        }
        return redirect()->back()->with('success', __('Update success!'));
    }

    public function statusapplicantsExport(){
        return (new ApplicantsExport())->download('applicants-' . date('M-d-Y') . '.xlsx');
    }

    public function meetingApplicants(Request $request){
        $this->setActiveMenu('admin/module/job/all-applicants');
        $candidate_id = $request->query('candidate_id');
        $rows = JobCandidate::with(['jobInfo', 'candidateInfo', 'cvInfo', 'company', 'company.getAuthor'])
            ->whereHas('jobInfo', function ($q) use($request){
                $job_id = $request->query('job_id');
                $company_id = $request->query('company_id');
                if (!$this->hasPermission('job_manage_others')) {
                    $company_id = Auth::user()->company->id ?? '';
                    $q->where('company_id', $company_id);
                }
                if( $company_id && $this->hasPermission('job_manage_others')){
                    $q->where('company_id', $company_id);
                }
                if($job_id){
                    $q->where("id", $job_id);
                }
            });

        if( $candidate_id && $this->hasPermission('job_manage_others')){
            $rows->where('candidate_id', $candidate_id);
        }

        $rows = $rows->orderBy('id', 'desc')
            ->paginate(20);
        $data = [
            'rows' => $rows
        ];
        return view('Job::admin.job.meeting-applicants', $data);
    }

    public function meetingapplicantsChangeStatus($status, $id){
        $this->checkPermission('job_manage');

        $row = JobCandidate::with('jobInfo', 'jobInfo.user', 'candidateInfo', 'company', 'company.getAuthor')
            ->where('id', $id);

        if (!$this->hasPermission('job_manage_others')) {
            $row = $row->whereHas('jobInfo', function ($q){
                $company_id = Auth::user()->company->id ?? '';
                $q->where('company_id', $company_id);
            });
        };
        $row = $row->first();
        if (empty($row)){
            return redirect()->back()->with('error', __('Item not found!'));
        }

        
        if($status == 'edit'){
            $data = JobCandidate::find($id);
            $user = User::find($data->candidate_id);
            $job = Job::find($data->job_id);
            // $data = array_merge(['crew_code' => 1234], $data);
            // var_dump($data);die;
            // return redirect()->back()->with('success', __('Update success!'));
            return view('Job::admin.job.edit-applicants', compact('data','user','job'));
            // echo 'edit';die;
        }

        $old_status = $row->status;
        if($status != 'approved' && $status != 'rejected' && $status != 'completed' && $status != 'pending'){
            return redirect()->back()->with('error', __('Status unavailable'));
        }

        $row->status = $status;
        $row->save();
        //Send Notify and email
        // if($status == 'update'){
        //     // $request = new Request();
        //     $request = $status;
        //     var_dump($request);die;
            
        // }

        if($old_status != $status) {
            event(new EmployerChangeApplicantsStatus($row));
            return redirect()->back()->with('success', __('Update success!'));
        }   
    }

    public function meetingapplicantsUpdate(Request $request){
        // var_dump($request->all());die;
        $this->checkPermission('job_manage');

        $row = JobCandidate::with('jobInfo', 'jobInfo.user', 'candidateInfo', 'company', 'company.getAuthor')
            ->where('id', $request->input('id'));

        if (!$this->hasPermission('job_manage_others')) {
            $row = $row->whereHas('jobInfo', function ($q){
                $company_id = Auth::user()->company->id ?? '';
                $q->where('company_id', $company_id);
            });
        };
        $row = $row->first();
        if (empty($row)){
            return redirect()->back()->with('error', __('Item not found!'));
        }
        $row->status = $request->input('status');
        $row->email = $request->input('email');
        $row->remarks = $request->input('remarks');
        $row->crew_code = $request->input('crew_code');
        $row->date_of_entry = $request->input('date_of_entry');
        $row->source = $request->input('source');
        $row->last_name = $request->input('last_name');
        $row->applied_position = $request->input('applied_position');
        $row->department = $request->input('department');
        $row->gender = $request->input('gender');
        $row->d_o_b = $request->input('d_o_b');
        $row->age = $request->input('age');
        $row->vaccination_yf = $request->input('vaccination_yf');
        $row->vaccination_covid_19 = $request->input('vaccination_covid_19');
        $row->cid = $request->input('cid');
        $row->coc = $request->input('coc');
        $row->ccm = $request->input('ccm');
        $row->rating_able = $request->input('rating_able');
        $row->experience = $request->input('experience');
        $row->application_form = $request->input('application_form');
        $row->contact_no = $request->input('contact_no');
        $row->interview_date = $request->input('interview_date');
        $row->interview_by = $request->input('interview_by');
        $row->interview_result = $request->input('interview_result');
        $row->approved_as = $request->input('approved_as');
        $row->save();
        return redirect('admin/module/job/all-applicants')->with('success', __('Update success!'));
    }

    public function meetingapplicantsBulkEdit(Request $request){
        $this->checkPermission('job_manage');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        foreach ($ids as $id) {
            $query = JobCandidate::with('jobInfo', 'jobInfo.user', 'candidateInfo', 'company', 'company.getAuthor')->where('id', $id);
            if (!$this->hasPermission('job_manage_others')) {
                $query = $query->whereHas('jobInfo', function ($q){
                    $company_id = Auth::user()->company->id ?? '';
                    $q->where('company_id', $company_id);
                });
            }
            $query = $query->first();
            $old_status = $query->status;
            $query->status = $action;
            $query->save();
            //Send Notify and Email
            if($old_status != $action) {
                event(new EmployerChangeApplicantsStatus($query));
            }

        }
        return redirect()->back()->with('success', __('Update success!'));
    }

    public function meetingapplicantsExport(){
        return (new ApplicantsExport())->download('applicants-' . date('M-d-Y') . '.xlsx');
    }

    public function allApplicants(Request $request){
        $this->setActiveMenu('admin/module/job/all-applicants');
        $candidate_id = $request->query('candidate_id');
        $rows = JobCandidate::with(['jobInfo', 'candidateInfo', 'cvInfo', 'company', 'company.getAuthor'])
            ->whereHas('jobInfo', function ($q) use($request){
                $job_id = $request->query('job_id');
                $company_id = $request->query('company_id');
                if (!$this->hasPermission('job_manage_others')) {
                    $company_id = Auth::user()->company->id ?? '';
                    $q->where('company_id', $company_id);
                }
                if( $company_id && $this->hasPermission('job_manage_others')){
                    $q->where('company_id', $company_id);
                }
                if($job_id){
                    $q->where("id", $job_id);
                }
            });

        if( $candidate_id && $this->hasPermission('job_manage_others')){
            $rows->where('candidate_id', $candidate_id);
        }

        $rows = $rows->orderBy('id', 'desc')
            ->paginate(20);

        // $rows1 = $rows->where('status','pending')->orderBy('id', 'desc')
        //     ->paginate(20);

        // $rows2 = $rows->where('status','pending')->orderBy('id', 'desc')
        //     ->paginate(20);
            
        $data = [
            'rows' => $rows,
            // 'rows1' => $rows1,
            // 'rows2' => $rows2
        ];
        return view('Job::admin.job.all-applicants', $data);
    }

    public function applicantsChangeStatus($status, $id){
        $this->checkPermission('job_manage');

        $row = JobCandidate::with('jobInfo', 'jobInfo.user', 'candidateInfo', 'company', 'company.getAuthor')
            ->where('id', $id);

        if (!$this->hasPermission('job_manage_others')) {
            $row = $row->whereHas('jobInfo', function ($q){
                $company_id = Auth::user()->company->id ?? '';
                $q->where('company_id', $company_id);
            });
        };
        $row = $row->first();
        if (empty($row)){
            return redirect()->back()->with('error', __('Item not found!'));
        }

        
        if($status == 'edit'){
            $data = JobCandidate::find($id);
            $user = User::find($data->candidate_id);
            $job = Job::find($data->job_id);
            // $data = array_merge(['crew_code' => 1234], $data);
            // var_dump($data);die;
            // return redirect()->back()->with('success', __('Update success!'));
            return view('Job::admin.job.edit-applicants', compact('data','user','job'));
            // echo 'edit';die;
        }

        $old_status = $row->status;
        if($status != 'approved' && $status != 'rejected' && $status != 'completed' && $status != 'pending'){
            return redirect()->back()->with('error', __('Status unavailable'));
        }

        $row->status = $status;
        $row->save();
        //Send Notify and email
        // if($status == 'update'){
        //     // $request = new Request();
        //     $request = $status;
        //     var_dump($request);die;
            
        // }

        if($old_status != $status) {
            event(new EmployerChangeApplicantsStatus($row));
            return redirect()->back()->with('success', __('Update success!'));
        }   
    }

    public function applicantsUpdate(Request $request){
        // var_dump($request->all());die;
        $this->checkPermission('job_manage');

        $row = JobCandidate::with('jobInfo', 'jobInfo.user', 'candidateInfo', 'company', 'company.getAuthor')
            ->where('id', $request->input('id'));

        if (!$this->hasPermission('job_manage_others')) {
            $row = $row->whereHas('jobInfo', function ($q){
                $company_id = Auth::user()->company->id ?? '';
                $q->where('company_id', $company_id);
            });
        };
        $row = $row->first();
        if (empty($row)){
            return redirect()->back()->with('error', __('Item not found!'));
        }
        $row->status = $request->input('status');
        $row->email = $request->input('email');
        $row->remarks = $request->input('remarks');
        $row->crew_code = $request->input('crew_code');
        $row->date_of_entry = $request->input('date_of_entry');
        $row->source = $request->input('source');
        $row->last_name = $request->input('last_name');
        $row->applied_position = $request->input('applied_position');
        $row->department = $request->input('department');
        $row->gender = $request->input('gender');
        $row->d_o_b = $request->input('d_o_b');
        $row->age = $request->input('age');
        $row->vaccination_yf = $request->input('vaccination_yf');
        $row->vaccination_covid_19 = $request->input('vaccination_covid_19');
        $row->cid = $request->input('cid');
        $row->coc = $request->input('coc');
        $row->ccm = $request->input('ccm');
        $row->rating_able = $request->input('rating_able');
        $row->experience = $request->input('experience');
        $row->application_form = $request->input('application_form');
        $row->contact_no = $request->input('contact_no');
        $row->interview_date = $request->input('interview_date');
        $row->interview_by = $request->input('interview_by');
        $row->interview_result = $request->input('interview_result');
        $row->approved_as = $request->input('approved_as');
        $row->save();
        return redirect('admin/module/job/all-applicants')->with('success', __('Update success!'));
    }

    public function applicantsBulkEdit(Request $request){
        $this->checkPermission('job_manage');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        foreach ($ids as $id) {
            $query = JobCandidate::with('jobInfo', 'jobInfo.user', 'candidateInfo', 'company', 'company.getAuthor')->where('id', $id);
            if (!$this->hasPermission('job_manage_others')) {
                $query = $query->whereHas('jobInfo', function ($q){
                    $company_id = Auth::user()->company->id ?? '';
                    $q->where('company_id', $company_id);
                });
            }
            $query = $query->first();
            $old_status = $query->status;
            $query->status = $action;
            $query->save();
            //Send Notify and Email
            if($old_status != $action) {
                event(new EmployerChangeApplicantsStatus($query));
            }

        }
        return redirect()->back()->with('success', __('Update success!'));
    }

    public function applicantsExport(Request $request){

        // $company = \Modules\Company\Models\Company::find(Request()->input('company_id'));
        // $candidate = \App\Models\User::find(Request()->input('candidate_id'));
        // $job = \Modules\Job\Models\Job::find(Request()->input('job_id'));
        // $data = [];
        // array_push($data,$company);
        // array_push($data, $candidate);
        // array_push($data, $job);
        return (new ApplicantsExport())->download('applicants-' . date('M-d-Y') . '.xlsx');
    }

    public function getForSelect2(Request $request)
    {
        $q = $request->query('q');
        $query = Job::select('id', 'title as text')->where("status","publish");
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        if(!is_admin()){
            $company_id = Auth::user()->company->id ?? '';
            $query->where('company_id', $company_id);
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }
}
