<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Exception;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('post', compact('post'));
    }

    public function store(StorePostRequest $storePostRequest)
    {
        $image = $storePostRequest->file('image');
        $image->move(storage_path('app/public'), $image->getClientOriginalName());

        $data = $storePostRequest->validated();
        $data['image'] = $image->getClientOriginalName();

        $post = new Post();
        $post->fill($data);
        $post->user_id = $storePostRequest->user()->id;
        $post->setSlug();
        $post->save();

        return back()->with('success', 'Post has been created successfully');
    }

    public function update(UpdatePostRequest $updatePostRequest, int $id)
    {
        Post::where('id', $id)->update($updatePostRequest->validated());

        if ($updatePostRequest->hasFile('image')) {
            $image = $updatePostRequest->file('image');
            $image->move(storage_path('app/public'));
        }

        return back()->with('success', 'Post has been updated successfully');
    }

    public function destroy(int $id)
    {
        $post = Post::find($id);
        
        try {
            unlink(storage_path("app/public/{$post->image}"));
        } catch (Exception $e) {}

        $post->delete();

        return back()->with('success', 'Post has been deleted successfully');
    }
}
