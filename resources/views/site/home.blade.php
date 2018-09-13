@extends('partials.layouts.site')
@section('content')

<div class="container">
    {{-- Notícias em destaque --}}
    <div class="columns is-multiline is-centered">
        <div class="column is-12">
            <div class="is-divider" data-content="Destaques"></div>
        </div>
        @foreach ($featureds as $key => $featured)
            <div class="column is-12">
                <div class="post {{ $key % 2 == 0 ? '' : 'alt' }}">
                    <div class="meta">
                        <img class="photo" src="/storage/{{ $featured->thumbnail }}">
                        <ul class="details">
                            <li class="author">{{ $featured->user()->first()->name }}</li>
                            <li class="date">{{ $featured->created_at }}</li>
                        </ul>
                    </div>
                    <div class="description">
                        <h1>{{ $featured->title }}</h1>
                        <p>{{ $featured->getPrologue() }}</p>
                        <p class="read-more"><a href="{{ route('post', $featured->url) }}">Ler mais<i class="fas fa-arrow-right"></i></a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Itens da biblioteca, últumas notícias --}}
    <div class="columns has-lateral-padding-45">
        <div class="column is-5">
            <div class="columns is-multiline">
                <div class="column is-12">
                    <div class="is-divider" data-content="Últimas Notícias"></div>
                </div>
                @foreach ($newposts as $newpost)
                    <div class="column is-12">
                        <div class="post is-vertical">
                            <div class="meta">
                                <img class="photo black-and-white" src="/storage/{{ $newpost->thumbnail }}">
                                <ul class="details">
                                    <li class="author">{{ $newpost->user()->first()->name }}</li>
                                    <li class="date">{{ $newpost->created_at }}</li>
                                </ul>
                            </div>
                            <div class="description">
                                <h1>{{ $newpost->title }}</h1>
                                <p class="read-more"><a href="{{ route('post', $newpost->url) }}">Ler mais<i class="fas fa-arrow-right"></i></a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="column is-7">
            <div class="columns is-multiline">
                <div class="column is-12">
                    <div class="is-divider" data-content="Biblioteca"></div>
                </div>
                @foreach ($works as $work)
                    <div class="column is-12">
                        
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection