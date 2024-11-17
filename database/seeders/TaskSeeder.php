<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Categories;
use App\Models\Task;
use App\Models\User_Task;
use App\Models\Cat_Task;
use App\Models\Subtask;
use App\Models\Comment;
use App\Enums\TaskStatus;

class TaskSeeder extends Seeder
{
    /**
     * Seed the tasks table.
     *
     * @return void
     */
    public function run()
    {
        // Generate dummy data for tasks
        $tasks = [
            [
                'task_description' => 'task1',
                'end_flag' => false,
                'dead_line' => now()->addDays(7),


            ],
            [
                'task_description' => 'task2',
                'end_flag' => false,
                'dead_line' => now()->addDays(5),

            ],
            [
                'task_description' => 'task3',
                'end_flag' => false,
                'dead_line' => now()->addDays(3),

            ],
            [
                'task_description' => 'task4',
                'end_flag' => true,
                'dead_line' => now()->addDays(2),

            ],
            [
                'task_description' => 'task5',
                'end_flag' => true,
                'dead_line' => now()->addDays(2),

            ],
            [
                'task_description' => 'task6',
                'end_flag' => true,
                'dead_line' => now()->addDays(2),

            ],
            [
                'task_description' => 'task7',
                'end_flag' => true,
                'dead_line' => now()->addDays(2),

            ],
            [
                'task_description' => 'task8',
                'end_flag' => true,
                'dead_line' => now()->addDays(2),

            ],
            [
                'task_description' => 'task9',
                'end_flag' => true,
                'dead_line' => now()->addDays(2),

            ],
        ];

        foreach ($tasks as $taskData) {
            // Create task
            $task = Task::create($taskData);

            // Get all users and categories
            $users = User::all();
            $categories = Categories::all();

            // Randomly select users and categories
            $randomUsers = $users->random(rand(2, $users->count()));
            $randomCategories = $categories->random(rand(1, $categories->count()));

            // Attach users to the task
            foreach ($randomUsers as $user) {
                User_Task::create([
                    'task_id' => $task->id,
                    'user_id' => $user->id,
                ]);
            }

            // Attach categories to the task
            foreach ($randomCategories as $category) {
                Cat_Task::create([
                    'task_id' => $task->id,
                    'categories_id' => $category->id,
                ]);
            }

            // Create subtasks for the task
            $subtaskCounter = 1; // Initialize counter
            $numberOfSubtasks = rand(2, 5); // Random number of subtasks between 2 and 5

            for ($i = 0; $i < $numberOfSubtasks; $i++) {
                $subtaskName = 'Subtask ' . $subtaskCounter++; // Increment counter and create unique name

                $subtask = Subtask::create([
                    'name' => $subtaskName,
                    'task_id' => $task->id,
                ]);

                // Create comments for each subtask
                $randomUser = $randomUsers->random();
                Comment::create([
                    'commentable_type' => 'Subtask',
                    'commentable_id' => $subtask->id,
                    'comment' => 'Comment for ' . $subtaskName,
                    'user_id' => $randomUser->id,

                ]);
            }

            // Create comments for the task
            $randomUser = $randomUsers->random();
            Comment::create([
                'commentable_type' => 'Task',
                'commentable_id' => $task->id,
                'comment' => 'Comment for ' . $task->task_description,
                'user_id' => $randomUser->id,

            ]);
        }
    }
}
