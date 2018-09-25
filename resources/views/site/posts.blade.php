@extends('partials.layouts.site')
@section('content')

<div class="container">
    <div class="columns is-multiline is-centered">
        @foreach ($posts as $key => $post)
            <div class="column is-12">
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
                        <p class="read-more"><a href="{{ route('post', $post->url) }}">Ler mais<i class="fas fa-arrow-right"></i></a></p>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="column is-12">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection