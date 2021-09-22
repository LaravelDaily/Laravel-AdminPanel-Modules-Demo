<?php

namespace App\Http\Requests;

use App\Models\TaskStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaskStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('task_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:task_statuses,id',
        ];
    }
}
