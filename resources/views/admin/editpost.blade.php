@extends('partials.layouts.admin')
@section('content')
<div class="columns is-centered is-multiline">
    <div class="column is-10">
        @include('partials.alerts.errors')
    </div>
    <div class="column is-10">
        <form class="control" method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="columns is-centered is-multiline">
                <div class="column is-12">
                    <img class="thumbnail-preview" src="/storage/{{ $post->thumbnail }}">
                </div>
                <div class="column is-8">
                    <div class="control has-icons-left">
                        <input class="input has-char-counter" maxlength="191" type="text" placeholder="Título da notícia" name="title" value="{{ old('title', $post->title) }}">
                        <span class="icon is-small is-left">
                            <i class="fas fa-newspaper"></i>
                        </span>
                        <span class="char-counter">191</span>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="file is-fullwidth ">
                        <label class="file-label">
                            <input class="file-input" accept=".jpeg,.png,.jpg" type="file" name="thumbnail">
                            <span class="file-cta">
                                <span class="file-icon"><i class="fas fa-upload"></i></span>
                                <span class="file-label">Escolher outra thumbnail</span>
                            </span>
                        </label>
                    </div>
                    @if (!$errors->isEmpty() && !$errors->has('thumbnail'))
                        <small class="text-danger">Não se esqueça de selecionar o arquivo novamente.</small>
                    @elseif (!$errors->isEmpty() && $errors->has('thumbnail'))
                        <small class="text-danger">Clique no botão acima para selecionar um arquivo.</small>
                    @endif
                </div>
                <div class="column is-12">
                    <textarea name="body">{!! old('body', $post->body) !!}</textarea>
                </div>
                <div class="column is-4 is-offset-8">
                    <button class="button is-primary is-fullwidth" type="submit">SALVAR ALTERAÇÕES</button>
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
        myFunctions.initNotification();
        myFunctions.initCharCounter('input[name="title"]', '.char-counter');
        myFunctions.initFileField('.file-input', 'span.file-label');
        myFunctions.changeImageSrcWhenInputChanges('input[name="thumbnail"]', ".thumbnail-preview");
        tinymce.init({
            selector: 'textarea[name="body"]',
            language: 'pt_BR',
            plugins: 'image imagetools advlist code media link colorpicker paste table textcolor',
            mobile: { theme: 'mobile' },
            images_upload_url: "/api/noticias/imagem",
            images_upload_base_path: "/storage",
            height : "300",
            entity_encoding : "raw",
        });
    });
</script>
@endsection