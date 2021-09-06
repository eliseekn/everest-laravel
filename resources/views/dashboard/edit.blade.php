@extends('layout.dashboard')

@section('title', 'Edit post')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-5">Edit post</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($message = Session::pull('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" value="{{ old('title') ?? $post->title }}" name="title" id="title" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" class="form-control" required>{{ old('content') ?? $post->content }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-dark">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
