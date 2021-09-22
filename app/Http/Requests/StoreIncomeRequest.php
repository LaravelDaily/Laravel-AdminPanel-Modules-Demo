<?php

namespace App\Http\Requests;

use App\Models\Income;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIncomeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('income_create');
    }

    public function rules()
    {
        return [
            'entry_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'amount' => [
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
