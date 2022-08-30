<?php
namespace Modules\Job\Models;

use App\BaseModel;
use Modules\Candidate\Models\Candidate;
use Modules\Candidate\Models\CandidateCvs;
use Modules\Company\Models\Company;

class JobCandidate extends BaseModel
{
    // protected $table = 'bc_job_candidates';
    public $table = 'sgps';
    protected $fillable = [
        'job_id',
        'candidate_id',
        'company_id',
        'cv_id',
        'message',
        // 'job_id',
        'status',
        'crew_code',
        'date_of_entry',
        'source',
        'applied_position',
        'department',
        'd_o_b',
        'vaccination_yf',
        'vaccination_covid_19',
        'cid',
        'coc',
        'rating_able',
        'ccm',
        'application_form',
        'interview_date',
        'interview_by',
        'interview_result',
        'approved_as',
        'last_name',
        'first_name',
        'gender',
        'age',
        'experience',
        'contact_no',
        'email',
        'remarks'
    ];

    public function jobInfo()
    {
        return $this->hasOne(Job::class, "id", 'job_id');
    }

    public function candidateInfo()
    {
        return $this->hasOne(Candidate::class, "id", 'candidate_id');
    }

    public function cvInfo()
    {
        return $this->hasOne(CandidateCvs::class, "id", 'cv_id');
    }

    public function company(){
        return $this->hasOne(Company::class,'id','company_id');
    }
}
