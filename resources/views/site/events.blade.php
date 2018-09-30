@extends('partials.layouts.site')
@section('content')
<div class="container">
	@if ($nextEvent)
		<div class="columns is-multiline">
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
				<div class="iframe-container">
					<iframe allowfullscreen src="https://www.google.com/maps/embed/v1/place?key={{ env('MAPS_KEYY') }}={{ $nextEvent->address }}"></iframe>
				</div>
				
			</div>
		</div>
	@endif
</div>
@endsection