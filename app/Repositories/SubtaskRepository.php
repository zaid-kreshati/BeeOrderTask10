<?php

namespace App\Repositories;

use App\Models\Subtask;
use App\Models\Comment;

class SubtaskRepository
{
    /**
     * Create a new subtask.
     *
     * @param array $data
     * @return Subtask
     */
    public function create(array $data): Subtask
    {
        return Subtask::create($data);
    }

    public function getSubTaskByTask( $taskId)
    {
        return Subtask::where('task_id',$taskId)->get();
    }

    /**
     * Update an existing subtask.
     *
     * @param Subtask $subtask
     * @param array $data
     * @return Subtask
     */
    public function update( $id, array $data)
    {

        // Find the task
        $subtask = Subtask::findOrFail($id);


        // Update the subtask
        $subtask->update($data);

        // Get the task associated with the subtask
        //$task = $subtask->task;

        // Check if all subtasks of the task are marked as "Done"
        // $allDone = $task->subtasks->every(function ($subtask) {
        //     return $subtask->status === 'Done';
        // });

        // Update the task status if all subtasks are "Done"
        // if ($allDone) {
        //     $task->update(['status' => 'Done']);
        // }

        return $subtask;
    }


    /**
     * Delete a subtask and its associated comments.
     *
     * @param Subtask $subtask
     * @return bool|null
     */
    public function delete( $id): ?bool
    {

        $subtask = Subtask::findOrFail($id);

        return $subtask->delete();
    }

    /**
     * Restore a deleted subtask.
     *
     * @param int $id
     * @return Subtask|null
     */
    public function restore(int $id)
    {
        $subtask = Subtask::withTrashed()->find($id);
        if ($subtask) {
            $subtask->restore();
        }
    }
}
