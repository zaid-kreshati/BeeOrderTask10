<?php

namespace App\Services;
use App\Models\Subtask;

use App\Repositories\SubtaskRepository;

class SubtaskService
{
    protected $subtaskRepository;

    public function __construct(SubtaskRepository $subtaskRepository)
    {
        $this->subtaskRepository = $subtaskRepository;
    }

    /**
     * Create a new subtask.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): Subtask
    {
         return $this->subtaskRepository->create($data);

    }

    /**
     * Update an existing subtask.
     *
     * @param Subtask $subtask
     * @param array $data
     * @return mixed
     */
    public function update( $id, array $data)
    {
        return $this->subtaskRepository->update($id, $data);

    }

    public function getSubTaskByTask( $taskId)
    {
        return $this->subtaskRepository->getSubTaskByTask($taskId);

    }

    /**
     * Delete a subtask.
     *
     * @param Subtask $subtask
     * @return bool|null
     */
    public function delete( $id)
    {
         $this->subtaskRepository->delete($id);
    }

    /**
     * Restore a deleted subtask.
     *
     * @param int $id
     * @return Subtask|null
     */
    public function restore(int $id)
    {
        $subtask = $this->subtaskRepository->restore($id);
        return $subtask;
    }

}
