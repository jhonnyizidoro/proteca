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
								<button class="button is-primary">Destacar</button>
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
		<div class="column is-6">
			<div class="columns is-multiline">
				<div class="column is-12">
					<div class="is-divider" data-content="Vídeos em destque"></div>
				</div>
				@foreach ($featuredVideos as $featuredVideo)
                    <div class="column is-12">
						@if ($featuredVideo->main)
							<div class="iframe-container">
								<iframe src="https://www.youtube.com/embed/8MRdu6LW80w?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
							</div>
						@else
							<ul class="video-list">
								<span class="title">Assista também</span>
								<li><a href="">Lorem ipsum dolor sit amet consectetur.</a></li>
								<li><a href="">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore dolores accusamus!</a></li>
								<li><a href="">Lorem ipsum dolor sit amet consectetur.</a></li>
								<li><a href="">Lorem ipsum dolor sit amet consectetur.</a></li>
								<li><a href="">Lorem ipsum dolor sit amet consectetur.</a></li>
							</ul>
						@endif
                    </div>
				@endforeach
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