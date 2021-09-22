<?php

namespace App\Http\Requests;

use App\Models\IncomeCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIncomeCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('income_category_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
