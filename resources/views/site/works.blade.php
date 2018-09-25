@extends('partials.layouts.site')
@section('content')

<div class="container">
    <div class="columns has-lateral-padding-45 is-multiline">
        <div class="column is-6">
            <div class="columns is-multiline">
				@if (count($articles) > 0)
					<div class="column is-12">
						<div class="is-divider m-b-0" data-content="Artigos"></div>
					</div>
					@foreach ($articles as $article)
						<div class="column is-12">
							<div class="work">
								<a class="work-title" href="#">{{ $article->title }}</a>
								<div class="meta">
									<span>Postado em {{ $article->created_at }}</span>
									<a download href="/storage/{{ $article->file }}">Download</a>
									<a href="/storage/{{ $article->file }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if (count($charts) > 0)
					<div class="column is-12">
						<div class="is-divider m-b-0" data-content="Cartilhas"></div>
					</div>
					@foreach ($charts as $chart)
						<div class="column is-12">
							<div class="work">
								<a class="work-title" href="#">{{ $chart->title }}</a>
								<div class="meta">
									<span>Postado em {{ $chart->created_at }}</span>
									<a download href="/storage/{{ $chart->file }}">Download</a>
									<a href="/storage/{{ $chart->file }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if (count($laws) > 0)
					<div class="column is-12">
						<div class="is-divider m-b-0" data-content="Leis"></div>
					</div>
					@foreach ($laws as $law)
						<div class="column is-12">
							<div class="work">
								<a class="work-title" href="#">{{ $law->title }}</a>
								<div class="meta">
									<span>Postado em {{ $law->created_at }}</span>
									<a download href="/storage/{{ $law->file }}">Download</a>
									<a href="/storage/{{ $law->file }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
            </div>
		</div>
		<div class="column is-6">
			<div class="columns is-multiline">
				@if (count($books) > 0)
					<div class="column is-12">
						<div class="is-divider m-b-0" data-content="Livros"></div>
					</div>
					@foreach ($books as $book)
						<div class="column is-12">
							<div class="work">
								<a class="work-title" href="#">{{ $book->title }}</a>
								<div class="meta">
									<span>Postado em {{ $book->created_at }}</span>
									<a download href="/storage/{{ $book->file }}">Download</a>
									<a href="/storage/{{ $book->file }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if (count($others) > 0)
					<div class="column is-12">
						<div class="is-divider m-b-0" data-content="Outros"></div>
					</div>
					@foreach ($others as $other)
						<div class="column is-12">
							<div class="work">
								<a class="work-title" href="#">{{ $other->title }}</a>
								<div class="meta">
									<span>Postado em {{ $other->created_at }}</span>
									<a download href="/storage/{{ $other->file }}">Download</a>
									<a href="/storage/{{ $other->file }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if (count($reviews) > 0)
					<div class="column is-12">
						<div class="is-divider m-b-0" data-content="Resenhas"></div>
					</div>
					@foreach ($reviews as $review)
						<div class="column is-12">
							<div class="work">
								<a class="work-title" href="#">{{ $review->title }}</a>
								<div class="meta">
									<span>Postado em {{ $review->created_at }}</span>
									<a download href="/storage/{{ $review->file }}">Download</a>
									<a href="/storage/{{ $review->file }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
    </div>
</div>
@endsection