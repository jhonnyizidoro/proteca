@extends('partials.layouts.admin')
@section('content')
<div class="columns is-centered is-multiline">
    <div class="column is-8">
        @include('partials.alerts.status')
        <a title="Adicionar notícia" class="button is-fixed is-primary" href="{{ route('admin.posts.new') }}"><i class="fas fa-plus"></i></a>
        <form action="{{ route('admin.posts') }}">
            <div class="field has-addons">
                <div class="control is-expanded">
                    <input class="input" type="text" name="titulo" placeholder="Filtrar por título" value="{{ Request::get('titulo') }}">
                </div>
                <div class="control">
                    <button class="button is-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    @foreach ($posts as $key => $post)
        <div class="column is-8">
            <div class="post {{ $key % 2 == 0 ? '' : 'alt' }}">
                <div class="meta">
                    <img class="photo" src="/storage/{{ $post->thumbnail }}">
                    <ul class="details">
                        <li class="author">{{ $post->user()->first()->name }}</li>
                        <li class="date">{{ $post->created_at }}</li>
                    </ul>
                </div>
                <div class="description">
                    <h1>{{ $post->title }}</h1>
                    <p>{{ $post->getPrologue() }}</p>
                    @if (auth()->user()->isAuthorOrAdmin($post))
                        <p class="read-more"><a href="{{ route('admin.posts.edit', $post->id) }}">Editar</a></p>
                        <p class="read-more"><a href="{{ route('admin.posts.delete', $post->id) }}">Excluir</a></p>
                    @else
                        <p class="read-more text-danger">Você não tem permissão para gerenciar essa notícia.</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <div class="column is-8">
        {!! $posts->links() !!}
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        notification.initNotification();
    });
</script>
@endsection