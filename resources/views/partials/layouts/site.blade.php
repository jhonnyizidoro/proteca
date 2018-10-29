<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	{{-- TAGS PADRÃO --}}
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ isset($title) ? "PROTECA - {$title}" : 'PROTECA' }}</title>
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
				<div class="column is-5">
					<small>O PROTECA é um projeto realizado pela Universidade Federal do Paraná em parceria com as instituições encontradas <a href="{{ route('partners') }}">neste</a> link.</small>
					<small>Contato: proteca@ufpr.br</small>
				</div>
				<div class="column is-3">
					<small>Desenvolvido por <br>Jhonny Izidoro Menarim</small>
					<div class="icons">
						<a target="_blank" href="https://github.com/jhonnyizidoro"><i class="fab fa-github"></i></a>
						<a target="_blank" href="https://www.facebook.com/jhonny.cfal"><i class="fab fa-facebook-square"></i></a>
						<a target="_blank" href="http://www.linkedin.com/in/jhonnyizidoro"><i class="fab fa-linkedin"></i></a>
					</div>
				</div>
			</div>
		</div>
	</footer>
	{{-- IMPORTAÇÃO DO SCRIPT GLOBAL --}}
	<script src="{{ mix('js/app.js') }}"></script>
	{{-- SEÇÃO PARA SCRIPTS DE CADA PÁGINA --}}
	@yield('scripts')
</body>
</html>