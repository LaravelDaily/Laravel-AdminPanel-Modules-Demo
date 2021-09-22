<?php

namespace App\Http\Requests;

use App\Models\TaskStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaskStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_status_create');
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
