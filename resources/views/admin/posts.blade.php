@extends('partials.layouts.admin')
@section('content')
<div class="columns is-centered is-multiline">
    <div class="column is-10">
        @include('partials.alerts.status')
        <a title="Adicionar notícia" class="button is-fixed is-primary" href="{{ route('admin.posts.new') }}"><i class="fas fa-plus"></i></a>
    </div>
    @foreach ($posts as $post)
        <div class="column is-7">
            <div class="post">
                <div class="meta">
                    <img class="photo" src="/storage/{{ $post->thumbnail }}">
                    <ul class="details">
                        <li class="author"><a href="#">{{ $post->user()->first()->name }}</a></li>
                        <li class="date">{{ $post->created_at }}</li>
                    </ul>
                </div>
                <div class="description">
                    <h1>{{ $post->title }}</h1>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p>
                    <p class="read-more">
                    <a href="#">Read More</a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
@section('scripts')
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        myFunctions.initNotification();
    });
</script>
@endsection