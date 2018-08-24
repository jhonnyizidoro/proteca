@extends('partials.layouts.admin')
@section('content')
<div class="columns is-centered">
    <div class="column is-10">
        @include('partials.alerts.status')
        <button title="Adicionar item à biblioteca" class="button is-fixed is-primary"><i class="fas fa-plus"></i></button>
        <div class="scrollable-table">
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
                            <td><a title="{{ $work->getFileName() }}" href="/storage/{{ $work->file }}" download>Baixar</a></td>
                            <td>{{ $work->created_at }}</td>
                            <td><a href="{{ route('admin.works.delete', $work->id) }}">Excluir</a></td>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input has-char-counter" type="text" placeholder="Título da obra" maxlength="191" name="title" value="{{ old('title') }}">
                                        <span class="icon is-small is-left">
                                            <i class="fab fa-amilia"></i>
                                        </span>
                                        <span class="char-counter">191</span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-9">
                                <div class="file is-fullwidth ">
                                    <label class="file-label">
                                        <input class="file-input" type="file" name="file">
                                        <span class="file-cta">
                                            <span class="file-icon"><i class="fas fa-upload"></i></span>
                                            <span class="file-label">Escolha um arquivo para o usuário baixar</span>
                                        </span>
                                    </label>
                                </div>
                                @if (!$errors->isEmpty() && !$errors->has('file'))
                                    <small class="text-white">Não se esqueça de selecionar o arquivo novamente.</small>
                                @elseif (!$errors->isEmpty() && $errors->has('file'))
                                    <small class="text-white">Clique no botão acima para selecionar um arquivo.</small>
                                @endif
                            </div>
                            <div class="column is-3">
                                <div class="field">
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="category_id">
                                                <option>Categoria da obra</option>
                                                @foreach ($categories as $category )
                                                    <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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
@endsection
@section('scripts')
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        modal.initModal('.modal', '.button.is-fixed', '.modal-close');
        notification.initNotification();
        form.initFileField('.file-input', 'span.file-label');
        form.initCharCounter('input[name="title"]', '.char-counter');
        tinymce.init(tinymceConfig);
    });
</script>
@endsection