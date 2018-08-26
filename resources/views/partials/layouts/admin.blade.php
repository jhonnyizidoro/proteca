<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>{{ env('APP_NAME') }} - Painel</title>
    </head>
    <body>
        <div class="navbar-top">
            <div class="container">
                <div class="right">
                    <a href="{{ route('admin.profile') }}">Alterar minhas informações</i></a>
                    <a class="divisor"></a>
                    <a target="_blank" href="{{ route('home') }}">Voltar ao site</i></a>
                    <a class="divisor"></a>
                    <a title="Sair" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
        <div class="banner is-small">
            <img src="{{ asset('images/blured-banner.jpg') }}" alt="Banner do projeto PROTECA">
        </div>
        <nav class="navbar">
            <div class="navbar-burger burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{ route('admin.posts') }}">
                        Notícias
                    </a>
                    <a class="navbar-item" href="{{ route('admin.works') }}">
                        Biblioteca
                    </a>
                    <a class="navbar-item" href="{{ route('admin.events') }}">
                        Eventos
                    </a>
                    @if (auth()->user()->hasTheRole('admin'))
                        <a class="navbar-item" href="{{ route('admin.users') }}">
                            Usuários
                        </a>
                        <a class="navbar-item" href="{{ route('admin.people') }}">
                            Pessoas
                        </a>
                    @endif
                </div>
            </div>
        </nav>
        {{-- Conteudo da página --}}
        @yield('content')
        <script src="{{ mix('js/app.js') }}"></script>
        {{-- Scripts da página --}}
        @yield('scripts')
    </body>
</html>