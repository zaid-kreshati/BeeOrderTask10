<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Subtask;
use App\Models\User;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getComments($type, $id)
    {
        $userId = Auth::id();
        $userIds = Auth::user()->hasRole('leader') ? User::pluck('id')->toArray() : [$userId];

        return $this->commentRepository->getComments($type, $id, $userIds);
    }

    public function CommentByUser()
    {
        return $this->commentRepository->CommentByUser();
    }

    public function CommentByLeader()
    {
        return $this->commentRepository->CommentByLeader();
    }


    public function createComment(array $data)
    {



        $comment = $this->commentRepository->createComment($data);


        return $comment;
    }

    public function updateComment($id, array $data)
    {
        $comment = $this->commentRepository->updateComment($id, $data);


        return $comment;
    }

    public function deleteComment($id)
    {
        $comment = $this->commentRepository->deleteComment($id);


        return $comment;
    }

    public function restoreComment($id)
    {
         $this->commentRepository->restoreComment($id);
    }
}
