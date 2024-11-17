<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Task;
use App\Models\Subtask;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class CommentRepository
{

    public function getComments($type, $id, $userIds)
    {
            return Comment::where('commentable_type', $type)
                ->where('commentable_id', $id)
                ->whereIn('user_id', $userIds)
                ->get();
    }

    public function CommentByUser()
    {
        $user_id=Auth::id();
            return Comment::where('user_id', $user_id)
                ->get();
    }

    public function CommentByLeader()
    {
            return Comment::all();
    }




    public function createComment(array $data)
    {

        $commentableType = $data['commentable_type'];
        $commentableId = $data['commentable_id'];

        if ($commentableType === 'Task') {
            $commentable = Task::findOrFail($commentableId);
        } elseif ($commentableType === 'Subtask') {
            $commentable = Subtask::findOrFail($commentableId);
        } else {

            return response()->json(['error' => 'Invalid commentable type.'], 400);
        }

        $user_id=Auth::id();
        $user=User::findOrFail($user_id);

        $commentData = [
            'comment' => $data['comment'],
            'user_id' => $user_id,
            'user_name' => $user->name,
            'commentable_type' => $commentableType,
            'commentable_id'=>$commentableId,

        ];


        return Comment::create($commentData);
    }

    public function updateComment($id, array $data)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($data);
        return $comment;
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
    }

    public function restoreComment($id)
    {
        $comment = Comment::withTrashed()->findOrFail($id);
        $comment->restore();
    }


}
