@extends('layouts.html')

@section('html.styles')
    {{ HTML::style('packages/bootstrap-3.3.2-dist/css/bootstrap.min.css') }}
    {{ HTML::style('packages/silviomoreto-bootstrap-select/css/bootstrap-select.min.css') }}
    <!-- Custom styles for this template -->
    {{ HTML::style('css/offcanvas2.css') }}
    {{ HTML::style('css/toolsInterface.css') }}
    {{ HTML::style('packages/font-awesome-4.3.0/css/font-awesome.min.css') }}
@stop

@section('html.scripts')
    {{ HTML::script('js/lib/jquery-2.1.3.min.js') }}
    {{ HTML::script('js/lib/jquery.imageready.js') }}
    {{ HTML::script('packages/bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
    {{ HTML::script('packages/bootstrap-3.3.2-dist/js/bootstrap-filestyle.min.js') }}
    {{ HTML::script('packages/silviomoreto-bootstrap-select/js/bootstrap-select.min.js') }}
    {{ HTML::script('js/lib/fabric.js') }}
    {{HTML::script('js/showCanvas.js') }} 
    @yield('tool.scripts')
@stop

@section('html.content')
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{URL::route('home')}}" >Trans<span class="themeColor">Bubbles<span></a>
                <span class="navbar-brand">- @yield('tool.title')</span>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                @include('common.lang_selector')
            </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
    </div><!-- /.navbar -->
    <div class="navbar navbar-default navbar-fixed-top navbar-seconde-top" style="background-color: transparent">
            @yield('tool.items')
    </div>
    <div class="page-header" id="banner"></div>
    <div class="container" style="overflow-x:auto; width:100%">
            @yield('tool.content')
    </div>

    <nav class="navbar navbar-fixed-bottom navbar-seconde-bottom" style="padding:0 50px 0 50px">
        <div class="btn-group pull-right" role="group">
            @yield('tool.nav')
        </div>
    </nav>
    {{ HTML::script('js/cleanAndTranslate.js') }}
    @include('common.footer')
@stop
