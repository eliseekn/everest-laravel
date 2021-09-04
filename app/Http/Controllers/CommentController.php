<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $storeCommentRequest, int $postId)
    {
        $comment = new Comment();
        $comment->fill($storeCommentRequest->validated());
        $comment->post_id = $postId;
        $comment->save();

        return back()->with('success', 'Comment has been created successfully');
    }

    public function destroy(?int $postId, int $id)
    {
        Comment::where('id', $id)->delete();

        return back()->with('success', 'Comment has been deleted successfully');
    }
}
