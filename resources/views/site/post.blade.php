@extends('partials.layouts.site')
@section('content')

<div class="container">
	@if($post)
	<div class="columns is-multiline is-centered">
		<div class="column is-12">
			<span class="post-title">{{ $post->title }}</span>
		</div>
		<div class="column is-6">
			<div class="post-meta">
				<span>[ <i class="fas fa-user-edit"></i> {{ $post->user->name }}]</span>
				<span>[ <i class="fas fa-calendar"></i> {{ $post->getDate() . ' - ' . $post->getTime() }}]</span>
			</div>
		</div>
		<div class="column is-10">
			<div class="post-body">
				{!! $post->body !!}
			</div>
		</div>
	</div>
	@else
	<div class="columns is-multiline is-centered">
		<div class="column is-10">
			@include('partials.errors.404')
		</div>
	</div>
	@endif
</div>
@endsection
@section('scripts')
<script>
	document.addEventListener('DOMContentLoaded', ()=> {
		iframe.setHeight();
	});
</script>
@endsection