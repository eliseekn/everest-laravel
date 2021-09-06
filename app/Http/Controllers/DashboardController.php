<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        
        return view('dashboard.index', compact('posts'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function edit(int $postId)
    {
        $post = Post::find($postId);

        return view('dashboard.edit', compact('post'));
    }

    public function comments(int $postId)
    {
        $comments = Comment::where('post_id', $postId)->paginate(2);

        return view('dashboard.comments', compact('comments'));
    }
}
