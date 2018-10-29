<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	{{-- TAGS PADRÃO --}}
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PROTECA - Login</title>
	{{-- SEO --}}
	@include('partials.header.seo')
	{{-- FAVICON --}}
	@include('partials.header.favicon')
	{{-- IMPORTAÇÃO DO CSS GLOBAL --}}
	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
	{{-- CONTEÚDO DA PÁGINA --}}
	@yield('content')
	{{-- IMPORTAÇÃO DO SCRIPT GLOBAL --}}
	<script src="{{ mix('js/app.js') }}"></script>
	{{-- SEÇÃO PARA SCRIPTS DE CADA PÁGINA --}}
	@yield('scripts')
</body>
</html>