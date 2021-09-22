<?php

namespace App\Http\Requests;

use App\Models\TaskTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaskTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_tag_create');
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
