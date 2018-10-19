<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
		{{-- TAGS PADRÃO --}}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ isset($title) ? "PROTECA - {$title}" : env('APP_NAME') }}</title>
		{{-- SEO --}}
		@include('partials.header.seo')
		{{-- FAVICON --}}
		@include('partials.header.favicon')
		{{-- IMPORTAÇÃO DO CSS GLOBAL --}}
		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
		{{-- BANNER PRINCIPAL --}}
        <figure class="banner">
            <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo PROTECA" class="logo"></a>
            <img src="{{ asset('images/blured-banner.jpg') }}" alt="PROTECA" class="background">
		</figure>
		{{-- NAVBAR --}}
        <nav class="navbar">
            <div class="navbar-burger burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{ route('posts') }}">
                        Notícias
                    </a>
                    <a class="navbar-item" href="{{ route('works') }}">
                        Biblioteca
                    </a>
                    <a class="navbar-item" href="{{ route('help') }}">
                        Ajuda
                    </a>
                    <a class="navbar-item" href="{{ route('team') }}">
                        Quem Somos
                    </a>
                    <a class="navbar-item" href="{{ route('partners') }}">
                        Parceiros
					</a>
					@hasevent
						<a class="navbar-item" href="{{ route('events') }}">
							Eventos
						</a>
					@endhasevent
                </div>
            </div>
        </nav>
        {{-- CONTEÚDO DA PÁGINA --}}
		@yield('content')
		{{-- RODAPÉ --}}
        <footer>
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-6">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam nam ad non amet omnis aperiam?
                    </div>
                    <div class="column is-6">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus enim dolore sint repudiandae iure fuga assumenda quod officiis vel nam, ipsum nemo numquam cupiditate recusandae odit reiciendis quaerat magnam nostrum. Quae aliquid velit minus harum sequi, magni cumque explicabo ullam sapiente tempore beatae blanditiis molestias reiciendis? Fugiat sapiente, reiciendis deserunt in laborum laudantium enim cupiditate.</div>
                </div>
            </div>
		</footer>
		{{-- IMPORTAÇÃO DO SCRIPT GLOBAL --}}
        <script src="{{ mix('js/app.js') }}"></script>
        {{-- SEÇÃO PARA SCRIPTS DE CADA PÁGINA --}}
        @yield('scripts')
    </body>
</html>