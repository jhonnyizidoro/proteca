@extends('partials.layouts.site')
@section('content')

<div class="container">
	{{-- Vídeos em destaque --}}
    <div class="columns is-multiline is-centered">
		<div class="column is-8">
			<div class="video-frame">
				<iframe src="https://www.youtube.com/embed/8MRdu6LW80w?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
		</div>
		<div class="column is-4">
			<ul class="video-list">
				<span class="title">Assista também</span>
				<li><a href="">Lorem ipsum dolor sit amet consectetur.</a></li>
				<li><a href="">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore dolores accusamus!</a></li>
				<li><a href="">Lorem ipsum dolor sit amet consectetur.</a></li>
				<li><a href="">Lorem ipsum dolor sit amet consectetur.</a></li>
				<li><a href="">Lorem ipsum dolor sit amet consectetur.</a></li>
			</ul>
		</div>
	</div>
    {{-- Notícias em destaque --}}
    <div class="columns is-multiline is-centered">
        <div class="column is-12">
            <div class="is-divider" data-content="Destaques"></div>
        </div>
        @foreach ($featureds as $key => $featured)
            <div class="column is-12">
                <div class="post {{ $key % 2 == 0 ? '' : 'alt' }}">
                    <div class="meta">
                        <img class="photo" src="/storage/{{ $featured->thumbnail }}">
                        <ul class="details">
                            <li class="author">{{ $featured->user()->first()->name }}</li>
                            <li class="date">{{ $featured->created_at }}</li>
                        </ul>
                    </div>
                    <div class="description">
                        <h1>{{ $featured->title }}</h1>
                        <p>{{ $featured->getPrologue() }}</p>
                        <p class="read-more"><a href="{{ route('post', $featured->url) }}">Ler mais<i class="fas fa-arrow-right"></i></a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Itens da biblioteca, últumas notícias --}}
    <div class="columns has-lateral-padding-45">
        <div class="column is-5">
            <div class="columns is-multiline">
                <div class="column is-12">
                    <div class="is-divider" data-content="Últimas Notícias"></div>
                </div>
                @foreach ($newposts as $newpost)
                    <div class="column is-12">
                        <div class="post is-vertical">
                            <div class="meta">
                                <img class="photo black-and-white" src="/storage/{{ $newpost->thumbnail }}">
                                <ul class="details">
                                    <li class="author">{{ $newpost->user()->first()->name }}</li>
                                    <li class="date">{{ $newpost->created_at }}</li>
                                </ul>
                            </div>
                            <div class="description">
                                <h1>{{ $newpost->title }}</h1>
                                <p class="read-more"><a href="{{ route('post', $newpost->url) }}">Ler mais<i class="fas fa-arrow-right"></i></a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="column is-7">
            <div class="columns is-multiline">
                <div class="column is-12">
                    <div class="is-divider" data-content="Itens recentes da biblioteca"></div>
                </div>
                @foreach ($works as $work)
					<div class="column is-12">
						<div class="work">
							<div class="work-title">{{ $work->title }}</div>
							<div class="meta">
								<span>Postado em {{ $work->created_at }}</span>
								<a data-title="{{ $work->title }}" data-abstract="{{ $work->abstract }}" data-file="{{ $work->getFilePath("/storage/") }}">Ver mais</a>
							</div>
						</div>
					</div>
                @endforeach
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