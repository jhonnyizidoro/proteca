@extends('partials.layouts.admin')
@section('content')
<div class="columns is-centered is-multiline">
    <div class="column is-10">
        @include('partials.alerts.status')
        <button title="Adicionar evento" class="button is-fixed is-primary"><i class="fas fa-plus"></i></button>
        <form action="{{ route('admin.events') }}">
            <div class="field has-addons">
                <div class="control is-expanded">
                    <input class="input" type="text" name="evento" placeholder="Filtrar por nome do evento" value="{{ Request::get('evento') }}">
                </div>
                <div class="control">
                    <div class="select">
                        <select name="data">
                            <option value="">Todas as datas</option>
                            <option {{ Request::get('data') == 'passados' ? 'selected' : '' }} value="passados">Eventos passados</option>
                            <option {{ Request::get('data') == 'futuros' ? 'selected' : '' }} value="futuros">Eventos futuros</option>
                        </select>
                    </div>
                </div>
                <div class="control">
                    <button class="button is-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="column is-10">
        <div class="scrollable-table">
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Local</th>
                        <th>Gerenciar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->date }}</td>
                            <td>{{ $event->starts_at }} - {{ $event->ends_at }}</td>
                            <td><a data-tooltip="{{ $event->location }}" class="tooltip"><i class="fas fa-map-marker-alt"></i></a></td>
                            <td>
                                <a href='{{ route('admin.events.delete', $event->id) }}'>Excluir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="column is-10">
        {{ $events->links() }}
    </div>
</div>
{{-- Modal para registrar novo usuário --}}
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
                        <div class="columns is-multiline">
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input has-char-counter" type="text" placeholder="Nome do evento" name="name" value="{{ old('name') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="char-counter name">191</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input has-char-counter" type="text" placeholder="Local do evento" name="location" value="{{ old('location') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <span class="char-counter location">191</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Data" name="date" value="{{ old('date') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Início" name="starts_at" value="{{ old('starts_at') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-hourglass-start"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Fim" name="ends_at" value="{{ old('ends_at') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-hourglass-start is-rotated-180"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Organizador do evento (opcional)" name="organizer" value="{{ old('organizer') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-male"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="URL do evento (opcional)" name="url" value="{{ old('url') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-link"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-12">
                                <div class="field">
                                    <textarea class="wysiwyg" name="details">{!! old('details', 'Escreva aqui os detalhes do evento.') !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button is-fullwidth is-white m-b-10">Criar evento</button>
                    @include('partials.alerts.errors')
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        form.initCharCounter('input[name="name"]', '.char-counter.name');
        form.initCharCounter('input[name="location"]', '.char-counter.location');
        modal.initModal('.modal', '.button.is-fixed', '.modal-close');
        notification.initNotification();
        form.initMaskedDateForm('input[name="date"]');
        form.initMaskedTimeForm('input[name="starts_at"]');
        form.initMaskedTimeForm('input[name="ends_at"]');
        tinymceConfig.height = "130"; 
        tinymce.init(tinymceConfig);
    });
</script>
@endsection