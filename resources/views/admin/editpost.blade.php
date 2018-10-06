@extends('partials.layouts.admin')
@section('content')
<div class="container">
    <div class="columns is-centered is-multiline">
        <div class="column is-12">
            @include('partials.alerts.errors')
        </div>
        <div class="column is-12">
            <form class="control" method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="columns is-centered is-multiline">
                    <div class="column is-8">
                        <img class="thumbnail-preview" src="{{ $post->thumbnail }}">
                    </div>
                    <div class="column is-8">
                        <div class="control has-icons-left">
                            <input class="input has-char-counter" maxlength="191" type="text" placeholder="Título da notícia" name="title" value="{{ old('title', $post->title) }}">
                            <span class="icon is-small is-left"><i class="fas fa-newspaper"></i></span>
                            <span class="char-counter">191</span>
                        </div>
                    </div>
                    <div class="column is-4">
                        <label class="file-label file is-fullwidth">
                            <input class="file-input" accept=".jpeg,.png,.jpg" type="file" name="thumbnail">
                            <span class="file-cta">
                                <span class="file-icon"><i class="fas fa-upload"></i></span>
                                <span class="file-label">Escolher outra thumbnail</span>
                            </span>
                        </label>
                        @include('partials.alerts.thumbnail')
                    </div>
                    <div class="column is-12">
                        <textarea class="wysiwyg" name="body">{!! old('body', $post->body) !!}</textarea>
                    </div>
                    <div class="column is-4 is-offset-8">
                        <button class="button is-primary is-fullwidth" type="submit">SALVAR ALTERAÇÕES</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        notification.initNotification();
        form.initCharCounter('input[name="title"]', '.char-counter');
        form.initFileField('.file-input', 'span.file-label');
        form.changeImageSrcWhenInputChanges('input[name="thumbnail"]', ".thumbnail-preview");
        tinymce.init(tinymceConfig);
    });
</script>
@endsection