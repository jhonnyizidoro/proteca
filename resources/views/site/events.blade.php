@extends('partials.layouts.site')
@section('content')
<div class="container">
	@if ($nextEvent)
	<div class="columns is-multiline">
		<div class="column is-8">
			<div class="iframe-container">
				<iframe allowfullscreen src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD4aPYJBGLcWGuoKyapspISr0F4XH2cW7k&q={{ $nextEvent->address }}"></iframe>
			</div>
		</div>
		<div class="column is-4">
			<div class="event">
				<div class="name">{{ $nextEvent->name }}</div>
				<div class="meta">
					<div class="title">Onde</div>
					<span class="content">
						{{ $nextEvent->address }}
					</span>
				</div>
				<div class="meta">
					<div class="title">Quando</div>
					<span class="content">
						Dia {{ $nextEvent->date }} de {{ $nextEvent->starts_at }} a {{ $nextEvent->ends_at }}.
					</span>
				</div>
			</div>
		</div>
		<div class="column is-8">
			<div class="title m-t-30">Mais detalhes</div>
			{!! $nextEvent->details !!}
		</div>
	</div>
	@endif
	@if ($events->isNotEmpty())
	<div class="columns is-multiline">
		<div class="column is-12">
			<div class="is-divider m-t-100" data-content="Outros eventos"></div>
		</div>
		@foreach ($events as $event)
		<div class="column is-12">
			<div class="card event">
				<div class="card-header">
					<div class="card-header-title is-centered">
						{{ $event->name }}
					</div>
				</div>
				<div class="card-content">
					{!! $event->details !!}
					<div class="meta">
						<div class="title">Onde</div>
						<span class="content">
							{{ $event->address }}
						</span>
					</div>
					<div class="meta">
						<div class="title">Quando</div>
						<span class="content">
							Dia {{ $event->date }} de {{ $event->starts_at }} a {{ $event->ends_at }}.
						</span>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	@endif
</div>
@endsection