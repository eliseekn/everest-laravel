@extends('layout.main')

@section('title', "{$post->title} | Le blog de l'Everest")
@section('description', $post->title)

@section('content')
    <section class="container w-50 my-5">
        <article class="card mb-5">
            <img src="{{ asset("storage/{$post->image}") }}" class="card-img-top" alt="Image de l'article">
            
            <div class="card-body">
                <h2 class="card-title post-title">{{ $post->title }}</h2>
                <p class="card-text mt-3 text-justify">{{ $post->content }}</p>
                <a href="{{ url('/') }}" class="btn btn-dark">Go back home</a>
            </div>
        </article>

        <h3 class="mt-5">Comments ({{ count($post->comments) }})</h3>

        <div class="mt-3">
            @foreach($post->comments as $comment)
            <p class="fw-bold">{{ $comment->author }}</p>
            <p class="fst-italic">{{ $comment->content }}</p>
            @endforeach
        </div>

        <h4 class="mt-5">Leave a comment</h4>

        @if ($message = Session::pull('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <form action="{{ route('post.comment.store', $post->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="email" value="{{ old('author') ?? '' }}" name="author" id="author" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control" required>{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-dark">Save</button>
        </form>
    </section>
@endsection