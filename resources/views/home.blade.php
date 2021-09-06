@extends('layout.main')

@section('content')
    <section class="container my-5">
        <div class="row row-cols-2">

            @foreach($posts as $post)
            <article class="col mb-5">
                <div class="card shadow-sm">
                    <img src="{{ asset("storage/{$post->image}") }}" class="card-img-top" alt="Image de l'article">
                    
                    <div class="card-body">
                        <h2 class="card-title post-title">{{ $post->title }}</h2>
                        <p class="card-text mt-3 text-justify">
                            {{ \Illuminate\Support\Str::limit($post->content, 290, $end='[...]') }}
                        </p>
                        <a href="{{ route('post.show', $post->slug) }}" class="btn btn-dark read-more">Read more</a>
                    </div>
                </div>
            </article>
            @endforeach

        </div>
    </section>

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
@endsection
