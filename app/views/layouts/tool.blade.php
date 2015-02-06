@extends('layouts.html')

@section('html.styles')
        {{ HTML::style('packages/bootstrap-3.3.2-dist/css/bootstrap.css') }}
        {{ HTML::style('packages/bootstrap-3.3.2-dist/css/bootstrap-theme.css') }}
        <!-- Custom styles for this template -->
        {{ HTML::style('css/offcanvas.css') }}
	{{ HTML::style('css/toolsInterface.css') }}
@stop

@section('html.scripts')
	{{ HTML::script('js/lib/jquery-2.1.3.min.js') }}
        {{ HTML::script('packages/bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
        {{ HTML::script('packages/bootstrap-3.3.2-dist/js/bootstrap-filestyle.min.js') }}
	{{ HTML::script('js/lib/fabric.js') }}
	{{ HTML::script('js/cleanAndTranslate.js') }}
@stop

@section('html.content')

<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{URL::route('home')}}" >Trans<span class="themeColor">Bubbles<span></a>
            <span class="navbar-brand">- @yield('tool.title')</span>
        </div>
    </div><!-- /.container -->
</nav><!-- /.navbar -->

<nav class="navbar-fixed-top navbar-seconde-top">
	<ul>
		<li><a class='button' href="" id="hidden-origin">Cacher</a></li>
		
		@yield('tool.items')
		
	</ul>
</nav>


	@yield('tool.content')

<nav class="navbar navbar-fixed-bottom navbar-seconde-bottom" style="padding:0 50px 0 0">
    <div class="btn-group pull-right" role="group">
        <a class='btn btn-lg btn-primary' href='' id='addText'>Quitter</a>
        <a class='btn btn-lg btn-primary' href='' id='del'>Terminer</a>
        <a class='btn btn-lg btn-primary' href='' id='brush'>Suivant</a>
    </div>
</nav>      
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