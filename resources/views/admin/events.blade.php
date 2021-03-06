@extends('partials.layouts.admin')
@section('content')
<div class="container">
	<div class="columns is-centered is-multiline">
		<div class="column is-12">
			@include('partials.alerts.status')
			<button title="Adicionar evento" class="button is-fixed is-primary"><i class="fas fa-plus"></i></button>
			<form action="{{ route('admin.events') }}" method="get">
				<div class="field has-addons">
					<div class="control is-expanded">
						<input class="input" type="text" name="evento" placeholder="Filtrar por nome do evento" value="{{ Request::get('evento') }}">
					</div>
					<div class="select control">
						<select name="data">
							<option value="">Todas as datas</option>
							<option {{ Request::get('data') == 'passados' ? 'selected' : '' }} value="passados">Eventos passados</option>
							<option {{ Request::get('data') == 'futuros' ? 'selected' : '' }} value="futuros">Eventos futuros</option>
						</select>
					</div>
					<div class="control">
						<button class="button is-primary"><i class="fas fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
		<div class="column is-12 has-responsive-table">
			<table class="table is-fullwidth">
				<thead>
					<tr>
						<th>Evento</th>
						<th>Data</th>
						<th>Horário</th>
						<th>Endereço</th>
						<th>Gerenciar</th>
					</tr>
				</thead>
				<tbody>
					@foreach($events as $event)
					<tr>
						<td title="{{ $event->name }}">{{ $event->getShortName() }}</td>
						<td>{{ $event->date }}</td>
						<td>{{ $event->starts_at }} - {{ $event->ends_at }}</td>
						<td class="is-address"><a data-tooltip="{{ $event->address }}" class="tooltip"><i class="fas fa-map-marker-alt"></i></a></td>
						<td><a class="confirmed" data-action='{{ route('admin.events.delete', $event->id) }}'>Excluir</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="column is-12">
			{{ $events->links() }}
		</div>
	</div>
</div>
{{-- Modal para registrar novo evento --}}
<div class="modal {{ $errors->isEmpty() ? '' : 'is-active' }}">
	<div class="modal-background"></div>
	<button class="modal-close is-large"></button>
	<div class="modal-content">
		<form action="{{ route('admin.events.create') }}" method="post">
			@csrf
			<div class="card is-primary">
				<header class="card-header">
					<p class="card-header-title is-centered">Novo evento</p>
				</header>
				<div class="card-content">
					<div class="content">
						<div class="steps">
							<div class="step-item">
								<div class="step-marker">1</div>
								<div class="step-details"><p class="step-title">Dados do evento</p></div>
							</div>
							<div class="step-item">
								<div class="step-marker">2</div>
								<div class="step-details"><p class="step-title">Mais Detalhes</p></div>
							</div>
							<div class="steps-content">
								<div class="step-content">
									<div class="columns is-multiline">
										<div class="column is-12">
											<div class="control has-icons-left">
												<input class="input" type="text" placeholder="Nome do evento" name="name" value="{{ old('name') }}">
												<span class="icon is-small is-left"><i class="fas fa-flag"></i></span>
											</div>
										</div>
										<div class="column is-12">
											<div class="control has-icons-left">
												<input class="input has-char-counter" type="text" placeholder="Endereço do evento" name="address" value="{{ old('address') }}">
												<span class="icon is-small is-left"><i class="fas fa-map-marker-alt"></i></span>
												<span class="char-counter">191</span>
											</div>
										</div>
										<div class="column is-4">
											<div class="control has-icons-left">
												<input class="input" type="text" placeholder="Data" name="date" value="{{ old('date') }}">
												<span class="icon is-small is-left"><i class="fas fa-calendar-alt"></i></span>
											</div>
										</div>
										<div class="column is-4">
											<div class="control has-icons-left">
												<input class="input" type="text" placeholder="Início" name="starts_at" value="{{ old('starts_at') }}">
												<span class="icon is-small is-left"><i class="fas fa-hourglass-start"></i></span>
											</div>
										</div>
										<div class="column is-4">
											<div class="control has-icons-left">
												<input class="input" type="text" placeholder="Fim" name="ends_at" value="{{ old('ends_at') }}">
												<span class="icon is-small is-left"><i class="fas fa-hourglass-start is-rotated-180"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="step-content">
									<div class="columns is-multiline">
										<div class="column is-12">
											<textarea class="wysiwyg" name="details">{!! old('details', 'Esqueva aqui os detalhes do evento.') !!}</textarea>
											<button type="submit" class="button is-fullwidth is-white m-t-30">Adicionar evento</button>
										</div>
									</div>
								</div>
							</div>
							<div class="steps-actions">
								<div class="steps-action">
									<a class="button is-white previous-step">Voltar</a>
								</div>
								<div class="steps-action">
									<a class="button is-white next-step">Avançar</a>
								</div>
							</div>
						</div>
					</div>
					@include('partials.alerts.errors')
				</div>
			</div>
		</form>
	</div>
</div>
@include('partials.confirmation.confirmation')
@endsection
@section('scripts')
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		form.initCharCounter('input[name="address"]', '.char-counter');
		modal.initModal('.modal', '.button.is-fixed', '.modal-close');
		notification.initNotification();
		form.initMaskedDateForm('input[name="date"]');
		form.initMaskedTimeForm('input[name="starts_at"]');
		form.initMaskedTimeForm('input[name="ends_at"]');
		steps.initSteps('.steps');
		tinymceConfig.height = "130"; 
		tinymce.init(tinymceConfig);
		confirmation.initConfirmation();
	});
</script>
@endsection