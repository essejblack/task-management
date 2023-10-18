<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Task::insert([
            [
                'title' => 'Task 1',
                'description' => 'task one',
                'order' => 1,
            ],
            [
                'title' => 'Task 2',
                'description' => 'task two',
                'order' => 2,
            ]
        ]);
    }
}
