<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaskStatusRequest;
use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('task_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskStatuses = TaskStatus::all();

        return view('admin.taskStatuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taskStatuses.create');
    }

    public function store(StoreTaskStatusRequest $request)
    {
        $taskStatus = TaskStatus::create($request->all());

        return redirect()->route('admin.task-statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        abort_if(Gate::denies('task_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taskStatuses.edit', compact('taskStatus'));
    }

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $taskStatus->update($request->all());

        return redirect()->route('admin.task-statuses.index');
    }

    public function show(TaskStatus $taskStatus)
    {
        abort_if(Gate::denies('task_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taskStatuses.show', compact('taskStatus'));
    }

    public function destroy(TaskStatus $taskStatus)
    {
        abort_if(Gate::denies('task_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taskStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskStatusRequest $request)
    {
        TaskStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
