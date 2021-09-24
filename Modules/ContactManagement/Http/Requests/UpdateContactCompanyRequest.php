<?php

namespace Modules\ContactManagement\Http\Requests;

use Modules\ContactManagement\Entities\ContactCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_company_edit');
    }

    public function rules()
    {
        return [
            'company_name' => [
                'string',
                'nullable',
            ],
            'company_address' => [
                'string',
                'nullable',
            ],
            'company_website' => [
                'string',
                'nullable',
            ],
            'company_email' => [
                'string',
                'nullable',
            ],
        ];
    }
}
