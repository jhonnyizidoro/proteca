<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>{{ env('APP_NAME') }} - Login</title>
    </head>
    <body>
        {{-- Conteudo da página --}}
        @yield('content')
        <script src="{{ mix('js/app.js') }}"></script>
        {{-- Scripts da página --}}
        @yield('scripts')
    </body>
</html>