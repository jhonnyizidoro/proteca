@extends('partials.layouts.site')
@section('content')

<div class="container">
    <div class="columns is-multiline">
        <div class="column is-12"><div class="is-divider" data-content="Destaques"></div></div>
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
                        <p class="read-more"><a href="">Ler mais<i class="fas fa-arrow-right"></i></a></p>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="column is-7">
            <div class="column is-12"><div class="is-divider" data-content="Ultimas notícias"></div></div>
            <div class="columns is-multiline">
                @foreach ($newposts as $key => $newpost)
                    <div class="column is-12">
                        <div class="post {{ $key % 2 == 0 ? '' : 'alt' }}">
                            <div class="meta">
                                <img class="photo" src="/storage/{{ $newpost->thumbnail }}">
                                <ul class="details">
                                    <li class="author">{{ $newpost->user()->first()->name }}</li>
                                    <li class="date">{{ $newpost->created_at }}</li>
                                </ul>
                            </div>
                            <div class="description">
                                <h1>{{ $newpost->title }}</h1>
                                {{-- <p>{{ $newpost->getPrologue() }}</p> --}}
                                <p class="read-more"><a href="">Ler mais<i class="fas fa-arrow-right"></i></a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection