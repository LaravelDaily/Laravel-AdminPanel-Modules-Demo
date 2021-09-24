<?php

namespace Modules\ContactManagement\Http\Requests;

use Modules\ContactManagement\Entities\ContactCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyContactCompanyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('contact_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:contact_companies,id',
        ];
    }
}
