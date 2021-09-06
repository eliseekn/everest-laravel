@extends('layout.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1>Posts ({{ count($posts) }})</h1>
            <a href="{{ route('post.create') }}" class="btn btn-dark" target="_blank">Create post</a>
        </div>

        @if ($message = Session::pull('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Created at</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                @foreach($posts as $key => $post)
                <tr valign="middle">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td><img src="{{ asset("storage/{$post->image}") }}" alt="Image de l'article" width="200"></td>
                    <td>{{ $post->title }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($post->content, 290, $end='[...]') }}</td>
                    <td>{{ \Carbon\Carbon::parse($post->created_at)->locale('en_EN')->isoFormat('Do MMM YYYY') }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('dashboard.comments', $post->id) }}" title="Comments" target="_blank">
                                <i class="fa fa-comments text-primary"></i>
                            </a>
                            <a href="{{ route('post.edit', $post->id) }}" class="ml-3" title="Edit" target="_blank">
                                <i class="fa fa-edit text-primary"></i>
                            </a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('delete')

                                <button type="submit" class="btn" title="Delete">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <nav class="my-5">
            <ul class="pagination justify-content-center">
                @if ($posts->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link text-dark" href="{{ $posts->previousPageUrl() }}">
                        &laquo;
                    </a>
                </li>
                @endif

                @if ($posts->hasPages())
                <li class="page-item page-link text-dark">
                    Page {{ $posts->currentPage() }}/{{ $posts->lastPage() }}
                </li>
                @endif
                
                @if ($posts->currentPage() < $posts->lastPage())
                <li class="page-item">
                    <a class="page-link text-dark" href="{{ $posts->nextPageUrl() }}">
                        &raquo;
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
@endsection
