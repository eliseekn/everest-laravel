@extends('layout.dashboard')

@section('title', "Comments | {$comments[0]->post->title}")

@section('content')
    <div class="container mt-5">
        <h1>Comments ({{ count($comments) }})</h1>
        <h4 class="fst-italic mb-5">{{ $comments[0]->post->title }}</h4>

        @if ($message = Session::pull('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Author</th>
                    <th scope="col">Content</th>
                    <th scope="col">Created at</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                @foreach($comments as $key => $comment)
                <tr valign="middle">
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $comment->author }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($comment->content, 290, $end='[...]') }}</td>
                    <td>{{ \Carbon\Carbon::parse($comment->created_at)->locale('en_EN')->isoFormat('Do MMM YYYY') }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <form action="{{ route('post.comment.destroy', ['post' => $comments[0]->post->id, 'comment' => $comment->id]) }}" method="POST">
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
                @if ($comments->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link text-dark" href="{{ $comments->previousPageUrl() }}">
                        &laquo;
                    </a>
                </li>
                @endif

                @if ($comments->hasPages())
                <li class="page-item page-link text-dark">
                    Page {{ $comments->currentPage() }}/{{ $comments->lastPage() }}
                </li>
                @endif
                
                @if ($comments->currentPage() < $comments->lastPage())
                <li class="page-item">
                    <a class="page-link text-dark" href="{{ $comments->nextPageUrl() }}">
                        &raquo;
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
@endsection
