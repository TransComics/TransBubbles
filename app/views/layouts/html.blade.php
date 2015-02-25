<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="_token" content="{{ csrf_token() }}" />
       
        <title>@yield('section', 'TransBubbles')</title>
        
        <!-- Custom styles for this template -->
        {{ HTML::style('css/bases.css') }}
        {{ HTML::style('css/social.css') }}
        @yield('html.styles')
        @yield('html.scripts')
    </head>
    <body>
        @yield('html.content')
    </body>
</html>