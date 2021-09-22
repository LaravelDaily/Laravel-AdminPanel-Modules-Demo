<?php

namespace App\Http\Requests;

use App\Models\ExpenseCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExpenseCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('expense_category_create');
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
