<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function show()
    {
        return view('post');
    }

    public function store(StorePostRequest $storePostRequest)
    {
        $post = new Post();
        $post->fill($storePostRequest->validated());
        $post->user_id = $storePostRequest->user()->id;
        $post->setSlug();
        $post->save();

        $image = $storePostRequest->file('image');
        $image->move(storage_path('app/public'));

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
        Post::where('id', $id)->delete();

        return back()->with('success', 'Post has been deleted successfully');
    }
}
