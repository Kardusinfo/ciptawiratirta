<?php

namespace App\Http\Requests;

use App\Models\Office;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOfficeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('office_edit');
    }

    public function rules()
    {
        return [
            'city' => [
                'string',
                'nullable',
            ],
        ];
    }
}
