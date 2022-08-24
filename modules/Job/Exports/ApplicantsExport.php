<?php
namespace Modules\Job\Exports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\Job\Models\JobCandidate;
use Modules\User\Models\Subscriber;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicantsExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function collection()
    {
        $candidate_id = request()->input('candidate_id');

        $rows = JobCandidate::with(['jobInfo', 'candidateInfo', 'cvInfo', 'company', 'company.getAuthor'])
            ->whereHas('jobInfo', function ($q){
                $job_id = request()->input('job_id');
                $company_id = request()->input('company_id');
                if (!Auth::user()->hasPermission('job_manage_others')) {
                    $company_id = Auth::user()->company->id ?? '';
                    $q->where('company_id', $company_id);
                }
                if( $company_id && Auth::user()->hasPermission('job_manage_others')){
                    $q->where('company_id', $company_id);
                }
                if($job_id){
                    $q->where("id", $job_id);
                }
            });

        if( $candidate_id && Auth::user()->hasPermission('job_manage_others')){
            $rows->where('candidate_id', $candidate_id);
        }
        $rows = $rows->orderBy('id', 'desc')->get();
        return $rows;
    }

    /**
     * @var Subscriber $jobCandidate
     * @return array
     */
    public function map($jobCandidate): array
    {
        return [
            ltrim($jobCandidate->remarks,"=-"),
            ltrim($jobCandidate->crew_code,"=-"),
            ltrim($jobCandidate->date_of_entry,"=-"),
            ltrim($jobCandidate->source,"=-"),
            ltrim($jobCandidate->last_name,"=-"),
            ltrim($jobCandidate->first_name,"=-"),
            ltrim($jobCandidate->applied_position,"=-"),
            ltrim($jobCandidate->department,"=-"),
            ltrim($jobCandidate->gender,"=-"),
            ltrim($jobCandidate->d_o_b,"=-"),
            ltrim($jobCandidate->age,"=-"),
            ltrim($jobCandidate->vaccination_yf,"=-"),
            ltrim($jobCandidate->vaccination_covid_19,"=-"),
            ltrim($jobCandidate->cid,"=-"),
            ltrim($jobCandidate->coc,"=-"),
            ltrim($jobCandidate->rating_able,"=-"),
            ltrim($jobCandidate->ccm,"=-"),
            ltrim($jobCandidate->experience,"=-"),
            ltrim($jobCandidate->application_form,"=-"),
            ltrim($jobCandidate->contact_no,"=-"),
            ltrim($jobCandidate->email,"=-"),
            ltrim($jobCandidate->interview_date,"=-"),
            ltrim($jobCandidate->interview_by,"=-"),
            ltrim($jobCandidate->interview_result,"=-"),
            ltrim($jobCandidate->approved_as,"=-"),
            ltrim($jobCandidate->status,"=-"),
            ltrim($jobCandidate->candidateInfo->getAuthor->getDisplayName() ?? '',"=-"),
            ltrim($jobCandidate->jobInfo->title,"=-"),
            ltrim($jobCandidate->message,"=-"),
            ltrim(display_date($jobCandidate->created_date),"=-"),
            
        ];
    }

    public function headings(): array
    {
        return [
            'remarks',
            'crew_code',
            'date_of_entry',
            'source',
            'last_name',
            'first_name',
            'applied_position',
            'department',
            'gender',
            'd.o.b',
            'age',
            'vaccination_yf',
            'vaccination_covid_19',
            'cid',
            'coc',
            'rating_able',
            'ccm',
            'experience',
            'application_form',
            'contact_no',
            'email',
            'interview_date',
            'interview_by',
            'interview_result',
            'approved_as',
            'Status',
            'Candidate',
            'Job Title',
            'Message',
            'Date Applied',
            
        ];
    }
}
