<?php

namespace App\Http\Controllers\web;

use App\Services\SubtaskService;
use App\Models\Subtask;
use Illuminate\Http\Request;
use App\Http\Requests\SubTask\updateSubTaskRequest;
use App\Http\Requests\SubTask\storeSubTaskRequest;

class SubTaskController extends Controller
{

    protected $subtaskService;

    public function __construct(SubtaskService $subtaskService)
    {
        $this->subtaskService = $subtaskService;
    }

    public function storeSubtask(storeSubTaskRequest $request)
    {

        // Create the subtask
        $subtask = $this->subtaskService->create($request->only(['task_id', 'name']));


        return response()->json(['success' => true, 'subtask' => $subtask, 'message' => 'Subtask added successfully.']);

        //return response()->json($subtask, 201); // 201 Created status code
    }

    public function update_subtask(updateSubTaskRequest $request,  $id)
    {
        // Update the subtask
        $updatedSubtask = $this->subtaskService->update($id, $request->only('name', 'status'));

        return response()->json([
            'success' => true,
            'subtask' => $updatedSubtask
        ], 200); // 200 OK status code
    }

    public function destroy_subtask(Subtask $subtask)
    {


        // Delete the subtask
        $this->subtaskService->delete($subtask);

        return response()->json([
            'success' => true,
            'message' => 'Subtask deleted successfully.'
        ], 200); // 200 OK status code
    }

    public function restore($id)
    {
        // Restore the subtask
        $this->subtaskService->restore($id);

        return redirect()->back();
    }
}
