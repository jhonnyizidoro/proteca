@extends('partials.layouts.site')
@section('content')

<div class="container">
    <div class="columns has-padding-30 is-multiline">
        @foreach ($partners as $partner)
            <div class="column is-3">
                <div class="card is-person">
                    <div class="quickview-trigger is-link" data-target="quickview-{{ $partner->id }}">
                        <div class="card-image">
                            <figure class="image is-1by1">
                                <img src="/storage/{{ $partner->image }}" alt="{{ $partner->name }}">
                            </figure>
                        </div>
                        <div class="card-content">
                            <p class="title">{{ $partner->name }}</p>
                        </div>
                    </div>                      
                </div>
            </div>
            <div id="quickview-{{ $partner->id }}" class="quickview">
                <header class="quickview-header">
                    <p class="title">{{ $partner->name }}</p>
                    <span class="delete"></span>
                </header>
                <div class="quickview-body">{!! $partner->presentation !!}</div>
                <footer class="quickview-footer">
                    @if ($partner->email)
                        <a class="tooltip" data-tooltip="{{ $partner->email }}"><i class="fas fa-envelope"></i></a>
                    @endif
                    @if ($partner->facebook)
                        <a target="_blank" href="{{ $partner->facebook }}"><i class="fab fa-facebook"></i></a>
                    @endif
                    @if ($partner->linkedin)
                        <a target="_blank" href="{{ $partner->linkedin }}"><i class="fab fa-linkedin"></i></a>
                    @endif
                    @if ($partner->lattes)
                        <a target="_blank" href="{{ $partner->lattes }}"><i class="fas fa-eye fa-lattes"></i></a>
                    @endif
                </footer>
            </div>  
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        quickview.initQuickview('.quickview-trigger');
    });
</script>
@endsection