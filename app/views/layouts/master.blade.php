@extends('layouts.html')

@section('html.styles')
{{ HTML::style('packages/bootstrap-3.3.2-dist/css/bootstrap.css') }}
{{ HTML::style('packages/bootstrap-3.3.2-dist/css/bootstrap-theme.css') }}
<!-- Custom styles for this template -->
{{ HTML::style('css/offcanvas.css') }}
@stop

@section('html.scripts')
{{ HTML::script('js/lib/jquery-2.1.3.min.js') }}
{{ HTML::script('packages/bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
{{ HTML::script('packages/bootstrap-3.3.2-dist/js/bootstrap-filestyle.min.js') }}
@stop

@section('html.content')

<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{URL::route('home')}}" >Trans<span class="themeColor">Bubbles<span></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @if(Route::currentRouteName() == "home")class="active" @endif><a href="{{URL::route('home')}}" >Accueil</a></li>
                <li @if(Route::currentRouteName() == "about")class="active" @endif><a href="#about" >À propos</a></li>
                <li @if(Route::currentRouteName() == "contact")class="active" @endif><a href="#contact" >Nous contacter</a></li>
            </ul>
            @include('common.lang_selector')
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->

<div class="container">
    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
            @yield('master.content')
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            @section('master.nav')
                <div class="list-group">
                    @if(Auth::check())
                        <a href="{{URL::route('user.logout')}}" class="list-group-item" >@lang('user.logout')</a>
                        <a href="{{URL::route('comic.add')}}" class="list-group-item" >@lang('comic.addLink')</a>
                    @else
                        <a href="{{URL::route('user.signin')}}" class="list-group-item" >@lang('user.signIn')</a>
                    @endif
                    <a href="{{URL::route('comics.list')}}" class="list-group-item" >@lang('comics.listLink')</a>
                    <a href="{{URL::route('strips.index')}}" class="list-group-item" >@lang('strip.importLink')</a>
                    <a href="{{URL::route('strip.clean', ['id' => 3])}}" class="list-group-item" >@lang('strip.cleanLink')</a>
                    <a href="{{URL::route('strip.translate', ['id' => 3])}}" class="list-group-item" >@lang('strip.translateLink')</a>
                </div>
            @show
        </div><!--/.sidebar-offcanvas-->
    </div><!--/row-->
</div><!--/.container-->

<nav class="navbar navbar-fixed-bottom navbar-theme-default" style="padding:0 0 50px 0">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h5 id='footer-header'> SITEMAP </h5>
            </div>
            <div class="col-sm-4">
                <h5 id='footer-header'> À propos </h5>
            </div>
            <div class="col-sm-4">
                <h5 id='footer-header'> Contact </h5>
            </div>
        </div>
    </div>
</nav>

@stop