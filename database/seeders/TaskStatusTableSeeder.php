<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

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
