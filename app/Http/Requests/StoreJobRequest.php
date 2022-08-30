<?php

namespace App\Http\Requests;

use App\Models\Job;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJobRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
            'expiration_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'video' => [
                'string',
                'nullable',
            ],
        ];
    }
}
