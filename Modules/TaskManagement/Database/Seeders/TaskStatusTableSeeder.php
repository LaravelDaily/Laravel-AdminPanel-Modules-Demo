<?php

namespace Modules\TaskManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\TaskManagement\Entities\TaskStatus;

class TaskStatusTableSeeder extends Seeder
{
    public function run()
    {
        $taskStatuses = [
            [
                'id'   => 1,
                'name' => 'Open',
            ],
            [
                'id'   => 2,
                'name' => 'In progress',
            ],
            [
                'id'   => 3,
                'name' => 'Closed',
            ],
        ];

        TaskStatus::insert($taskStatuses);
    }
}
