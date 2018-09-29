@extends('partials.layouts.site')
@section('content')

<div class="container">
    <div class="columns has-lateral-padding-45 is-multiline">
        <div class="column is-6">
            <div class="columns is-multiline">
				@if (count($articles) > 0)
					<div class="column is-12">
						<div class="is-divider" data-content="Artigos"></div>
					</div>
					@foreach ($articles as $article)
						<div class="column is-12">
							<div class="work">
								<div class="work-title">{{ $article->title }}</div>
								<div class="meta">
									<span>Postado em {{ $article->created_at }}</span>
									<a data-title="{{ $article->title }}" data-abstract="{{ $article->abstract }}" data-file="{{ $article->getFilePath("/storage/") }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if (count($others) > 0)
					<div class="column is-12">
						<div class="is-divider" data-content="Outros"></div>
					</div>
					@foreach ($others as $other)
						<div class="column is-12">
							<div class="work">
								<div class="work-title">{{ $other->title }}</div>
								<div class="meta">
									<span>Postado em {{ $other->created_at }}</span>
									<a data-title="{{ $other->title }}" data-abstract="{{ $other->abstract }}" data-file="{{ $other->getFilePath("/storage/") }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if (count($laws) > 0)
					<div class="column is-12">
						<div class="is-divider" data-content="Leis"></div>
					</div>
					@foreach ($laws as $law)
						<div class="column is-12">
							<div class="work">
								<div class="work-title">{{ $law->title }}</div>
								<div class="meta">
									<span>Postado em {{ $law->created_at }}</span>
									<a data-title="{{ $law->title }}" data-abstract="{{ $law->abstract }}" data-file="{{ $law->getFilePath("/storage/") }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
            </div>
		</div>
		<div class="column is-6">
			<div class="columns is-multiline">
					@if (count($charts) > 0)
					<div class="column is-12">
						<div class="is-divider" data-content="Cartilhas"></div>
					</div>
					@foreach ($charts as $chart)
						<div class="column is-12">
							<div class="work">
								<div class="work-title">{{ $chart->title }}</div>
								<div class="meta">
									<span>Postado em {{ $chart->created_at }}</span>
									<a data-title="{{ $chart->title }}" data-abstract="{{ $chart->abstract }}" data-file="{{ $chart->getFilePath("/storage/") }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if (count($books) > 0)
					<div class="column is-12">
						<div class="is-divider" data-content="Livros"></div>
					</div>
					@foreach ($books as $book)
						<div class="column is-12">
							<div class="work">
								<div class="work-title">{{ $book->title }}</div>
								<div class="meta">
									<span>Postado em {{ $book->created_at }}</span>
									<a data-title="{{ $book->title }}" data-abstract="{{ $book->abstract }}" data-file="{{ $book->getFilePath("/storage/") }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
				@if (count($reviews) > 0)
					<div class="column is-12">
						<div class="is-divider" data-content="Resenhas"></div>
					</div>
					@foreach ($reviews as $review)
						<div class="column is-12">
							<div class="work">
								<div class="work-title">{{ $review->title }}</div>
								<div class="meta">
									<span>Postado em {{ $review->created_at }}</span>
									<a data-title="{{ $review->title }}" data-abstract="{{ $review->abstract }}" data-file="{{ $review->getFilePath("/storage/") }}">Ver mais</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
    </div>
</div>
{{-- Modal com informações do item --}}
<div class="modal">
    <div class="modal-background"></div>
    <button class="modal-close is-large"></button>
    <div class="modal-content">
        <div class="card is-primary">
            <header class="card-header">
                <p class="card-header-title is-centered has-text-centered"></p>
            </header>
            <div class="card-content">
                <div class="content has-text-white has-text-centered"></div>
                <a target="_blank" class="button is-fullwidth is-white m-b-10"></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
		modal.initModal('.modal', '.meta a', '.modal-close');
		myscripts.workScript();
    });
</script>
@endsection