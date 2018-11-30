@extends('partials.layouts.site')
@section('content')

<div class="container">
	<div class="columns is-multiline is-centered">
		<div class="column is-10">
			<form action="{{ route('works') }}">
				<div class="field has-addons">
					<div class="control is-expanded">
						<input class="input" type="text" name="titulo" placeholder="Buscar um item" value="{{ Request::get('titulo') }}">
					</div>
					<div class="control select">
						<select name="categoria">
							<option value="">Todas as categorias</option>
							@foreach ($categories as $category )
							<option {{ Request::get('categoria') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category }}</option>
							@endforeach
						</select>
					</div>
					<div class="control">
						<button class="button is-primary"><i class="fas fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
		@foreach ($works as $work)
		<div class="column is-10">
			<div class="work" data-title="{{ $work->title }}" data-abstract="{{ $work->abstract }}" data-file="{{ $work->file }}">
				<div class="work-title has-text-centered">{{ $work->title }}</div>
				<div class="preview">{!! $work->getPrologue() !!}</div>
				<div class="meta">
					<span class="tag">[ {{ $work->getDate() . ' - ' . $work->getTime() }}]</span>
					<span class="tag">{{ $work->category->category }}</span>
				</div>
			</div>
		</div>
		@endforeach
		<div class="column is-10">
			{{ $works->links() }}
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
	document.addEventListener('DOMContentLoaded', function() {
		modal.initModal('.modal', '.work', '.modal-close');
		myscripts.workScript();
	});
</script>
@endsection