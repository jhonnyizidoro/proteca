<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>{{ env('APP_NAME') }} - Painel</title>
    </head>
    <body class="p-b-100">
        <div class="navbar-top">
            <div class="container">
                <div class="right">
                    <a data-tooltip="Alterar nome ou senha" class="tooltip is-tooltip-bottom" href="{{ route('admin.profile') }}"><i class="fas fa-user-cog"></i></a>
                    <a class="divisor"></a>
                    <a data-tooltip="Como utilizar o Painel de Admnistração PROTECA" class="tooltip is-tooltip-bottom"><i class="fas fa-question-circle"></i></a>
                    <a class="divisor"></a>
                    <a data-tooltip="Sair e retornar para o PROTECA" class="tooltip is-tooltip-bottom" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
        <div class="banner is-small">
			<a href="{{ route('admin') }}"><img src="{{ asset('images/logo-admin.png') }}" alt="Logo PROTECA" class="logo"></a>
            <img src="{{ asset('images/blured-banner.jpg') }}" alt="PROTECA" class="background">
        </div>
        <nav class="navbar">
            <div class="navbar-burger burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="navbar-menu">
                <div class="navbar-start">
					<a class="navbar-item" href="{{ route('admin.featured') }}">
						Destaques
					</a>
                    <a class="navbar-item" href="{{ route('admin.posts') }}">
                        Notícias
                    </a>
                    <a class="navbar-item" href="{{ route('admin.works') }}">
                        Biblioteca
                    </a>
                    <a class="navbar-item" href="{{ route('admin.events') }}">
                        Eventos
                    </a>
                    @admin
                        <a class="navbar-item" href="{{ route('admin.users') }}">
                            Usuários
                        </a>
                        <a class="navbar-item" href="{{ route('admin.people') }}">
                            Pessoas
                        </a>
					@endadmin
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