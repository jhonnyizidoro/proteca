@extends('partials.layouts.site')
@section('content')

<div class="container">
    <div class="columns has-padding-30 is-multiline">
        @foreach ($partners as $partner)
            <div class="column is-4 is-3-fullhd">
				<a target="_blank" href="{{ $partner->link }}">
					<div class="card is-person">
						<div class="card-image">
							<figure class="image is-1by1">
								<img src="/storage/{{ $partner->image }}" alt="{{ $partner->name }}">
							</figure>
						</div>
						<div class="card-content">
							<p class="title">{{ $partner->name }}</p>
						</div>
					</div>
				</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
		card.resizeToFit('.card-content .title');
    });
</script>
@endsection