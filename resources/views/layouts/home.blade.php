<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('title')</title>
        @section('head')
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/imagehover.min.css') }}
        {{ HTML::style('css/style.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
    </head>
    <body>
        @section('body')
        @show
        {{ HTML::script('js/jquery.min.js') }}
        {{ HTML::script('js/jquery.easing.min.js') }}
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/custom.js') }}
        {{ HTML::script('js/contactform.js') }}
    </body>
</html>