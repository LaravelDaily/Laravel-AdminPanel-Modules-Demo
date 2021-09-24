<?php

namespace Modules\TaskManagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\TaskManagement\Entities\Task;

class TasksCalendarController extends Controller
{
    public function index()
    {
        $events = Task::whereNotNull('due_date')->get();

        return view('taskmanagement::admin.tasksCalendars.index', compact('events'));
    }
}
