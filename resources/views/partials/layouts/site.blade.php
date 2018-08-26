<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>{{ env('APP_NAME') }}</title>
    </head>
    <body>
        <div class="banner">
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
                    <a class="navbar-item" href="#">
                        Notícias
                    </a>
                    <a class="navbar-item" href="# ">
                        Biblioteca
                    </a>
                    <a class="navbar-item" href="# ">
                        Ajuda
                    </a>
                    <a class="navbar-item" href="# ">
                        Quem Somos
                    </a>
                    <a class="navbar-item" href="# ">
                        Parceiros
                    </a>
                    <a class="navbar-item" href="# ">
                        Eventos
                    </a>
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