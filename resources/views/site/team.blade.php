@extends('partials.layouts.site')
@section('content')
<div class="container">
	<div class="columns has-padding-30 is-multiline">
		@foreach ($teammates as $teammate)
		<div class="column is-4 is-3-fullhd">
			<div class="card is-person">
				<div class="quickview-trigger is-link" data-target="quickview-{{ $teammate->id }}">
					<div class="card-image">
						<figure class="image is-1by1">
							<img src="{{ $teammate->image }}" alt="{{ $teammate->name }}">
						</figure>
					</div>
					<div class="card-content">
						<p class="title">{{ $teammate->name }}</p>
					</div>
				</div>                      
			</div>
		</div>
		<div id="quickview-{{ $teammate->id }}" class="quickview">
			<header class="quickview-header">
				<p class="title">{{ $teammate->name }}</p>
				<span class="delete"></span>
			</header>
			<div class="quickview-body">{!! $teammate->presentation !!}</div>
			<footer class="quickview-footer">
				<i class="fas fa-envelope"></i>{{ $teammate->email }}
			</footer>
		</div>  
		@endforeach
	</div>
</div>
@endsection
@section('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		quickview.initQuickview('.quickview-trigger');
		card.resizeToFit('.card-content .title');
	});
</script>
@endsection