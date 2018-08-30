@extends('partials.layouts.admin')
@section('content')
<div class="columns is-centered is-multiline">
    <div class="column is-10">
        @include('partials.alerts.status')
        <button title="Adicionar item à biblioteca" class="button is-fixed is-primary"><i class="fas fa-plus"></i></button>
        <form action="{{ route('admin.works') }}">
            <div class="field has-addons">
                <div class="control is-expanded">
                    <input class="input" type="text" name="titulo" placeholder="Filtrar por título" value="{{ Request::get('titulo') }}">
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
    <div class="column is-10">
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Arquivo</th>
                    <th>Criado em</th>
                    <th>Gerenciar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($works as $work)
                    <tr>
                        <td>{{ $work->title }}</td>
                        <td>{{ $work->category->category }}</td>
                        <td class="is-file"><a class="tooltip" data-tooltip="{{ $work->getFileName() }}" href="/storage/{{ $work->file }}" download><i class="fas fa-cloud-download-alt"></i></a></td>
                        <td>{{ $work->created_at }}</td>
                        <td><a class="delete-work" href="{{ route('admin.works.delete', $work->id) }}">Excluir</a></td>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="column is-10">
        {{ $works->links() }}
    </div>
</div>
{{-- Modal para registrar novo trabalho --}}
<div class="modal {{ $errors->isEmpty() ? '' : 'is-active' }}">
    <div class="modal-background"></div>
    <button class="modal-close is-large"></button>
    <div class="modal-content is-large">
        <form action="{{ route('admin.works.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card is-primary">
                <header class="card-header">
                    <p class="card-header-title is-centered">Novo item da biblioteca</p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <div class="columns is-multiline">
                            <div class="column is-12">
                                <div class="control has-icons-left">
                                    <input class="input has-char-counter" type="text" placeholder="Título da obra" maxlength="191" name="title" value="{{ old('title') }}">
                                    <span class="icon is-small is-left"><i class="fab fa-amilia"></i></span>
                                    <span class="char-counter">191</span>
                                </div>
                            </div>
                            <div class="column is-8">
                                <label class="file is-fullwidth file-label">
                                    <input class="file-input" type="file" name="file">
                                    <span class="file-cta">
                                        <span class="file-icon"><i class="fas fa-upload"></i></span>
                                        <span class="file-label">Escolha um arquivo para o usuário baixar</span>
                                    </span>
                                </label>
                                @include('partials.alerts.file')
                            </div>
                            <div class="column is-4">
                                <div class="control select is-fullwidth">
                                    <select name="category_id">
                                        <option>Categoria da obra</option>
                                        @foreach ($categories as $category )
                                            <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="column is-12">
                                <textarea class="wysiwyg" name="abstract">{!! old('abstract', 'Esqueva aqui um resumo da obra, algo que você quer que o usuário veja ao clicar nela.') !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button is-fullwidth is-white m-b-10">ADICIONAR ITEM À BIBLIOTECA</button>
                    @include('partials.alerts.errors')
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Confirmation window para excluir um item --}}
<div class="confirmation">
    <div class="confirmation-container">
        <p>Você tem certeza que deseja excluir esse item da biblioteca permanetemente?</p>
        <ul class="confirmation-buttons">
            <li><a class="true">Sim</a></li>
            <li><a class="false">Não</a></li>
        </ul>
        <a class="confirmation-close img-replace">Close</a>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        modal.initModal('.modal', '.button.is-fixed', '.modal-close');
        notification.initNotification();
        form.initFileField('.file-input', 'span.file-label');
        form.initCharCounter('input[name="title"]', '.char-counter');
        confirmation.initConfirmation('.confirmation', '.delete-work');
        tinymce.init(tinymceConfig);
    });
</script>
@endsection