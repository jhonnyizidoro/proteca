@extends('partials.layouts.admin')
@section('content')
<div class="container">
    <div class="columns is-multiline">
		<div class="column is-12">
			@include('partials.alerts.status')
			@include('partials.alerts.errors')
		</div>
		{{-- Featured posts --}}
		<div class="column is-6">
			<div class="columns is-multiline">
				<div class="column is-12">
					<div class="is-divider" data-content="Notícias em destaque"></div>
				</div>
				<div class="column is-12">
					<form action="{{ route('admin.featured.post.create') }}" method="post">
						@csrf
						<div class="field has-addons">
							<div class="control is-expanded">
								<input class="input" type="text" name="url" placeholder="Link da notícia" value="{{ old('url') }}">
							</div>
							<div class="control">
								<button class="button is-primary"><i class="fas fa-plus"></i></button>
							</div>
						</div>
					</form>
				</div>
				@foreach ($featuredPosts as $featuredPost)
                    <div class="column is-12">
                        <div class="post is-vertical">
                            <div class="meta">
								<img class="photo" src="{{ $featuredPost->post->thumbnail }}">
								<a href="{{ route('admin.featured.post.delete', $featuredPost->id) }}" class="button is-floating is-square right is-danger"><i class="fas fa-trash"></i></a>
                                <ul class="details">
                                    <li class="author">{{ $featuredPost->post->user()->first()->name }}</li>
                                    <li class="date">{{ $featuredPost->post->created_at }}</li>
                                </ul>
                            </div>
                            <div class="description">
                                <h1><a target="_blank" href="{{ route('post', $featuredPost->post->url) }}">{{ $featuredPost->post->title }}</a></h1>
                            </div>
                        </div>
                    </div>
				@endforeach
			</div>
		</div>
		{{-- Featured Videos --}}
		<div class="column is-6">
			<div class="columns is-multiline">
				<div class="column is-12">
					<div class="is-divider" data-content="Vídeos em destque"></div>
				</div>
				<div class="column is-12">
					<form action="{{ route('admin.featured.video.create') }}" method="post">
						@csrf
						<div class="field has-addons">
							<div class="control is-expanded">
								<input class="input" type="text" name="video_url" placeholder="Link do vídeo" value="{{ old('video_url') }}">
							</div>
							<div class="select control">
								<select name="main">
									<option {{ old('main') === '1' ? 'selected' : '' }} value="1">Tornar principal</option>
									<option {{ old('main') === '0' ? 'selected' : '' }} value="0">Adicionar à lista</option>
								</select>
							</div>
							<div class="control">
								<button class="button is-primary"><i class="fas fa-plus"></i></button>
							</div>
						</div>
					</form>
				</div>
				<div class="column is-12">
					@if($mainFeaturedVideo)
						<div class="iframe-container">
							<iframe src="{{ $mainFeaturedVideo->getVideoEmbedLink() }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
					@endif
					<ul class="video-list m-t-25">
						@foreach ($featuredVideos as $featuredVideo)
							<li>
								<a href="{{ route('admin.featured.video.delete', $featuredVideo->id) }}" class="button is-floating is-square is-danger"><i class="fas fa-trash"></i></a>
								<a class="video-link" target="_blank" href="{{ $featuredVideo->url }}">{{ $featuredVideo->title }}</a>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        notification.initNotification();
    });
</script>
@endsection