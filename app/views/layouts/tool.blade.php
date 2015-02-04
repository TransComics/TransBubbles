@extends('layouts.html')

@section('html.styles')
	{{ HTML::style('css/toolsInterface.css') }}
@stop

@section('html.scripts')
	{{ HTML::script('js/lib/jquery-2.1.3.min.js') }}
	{{ HTML::script('js/lib/fabric.js') }}
	{{ HTML::script('js/zoom.js') }}
	{{ HTML::script('js/cleanAndTranslate.js') }}
@stop

@section('html.content')
<div id='top-line'>
</div>
<header id='header'>
		<h1>Trans<span class="cyan-text">Bubbles</span> - @yield('tool.title')</h1>
</header>
<nav id='nav'>
	<ul id="origin-remote">
		<li><a class='button' href="" id="hidden-origin">Cacher</a></li>
	</ul>
	<ul id="delivered-remote">
		
		@yield('tool.items')
		
	</ul>
</nav>

	@yield('tool.content')

<nav id="remote">
		<ul>
			<li><a class='button' href='' id='addText'>Quitter</a></li>
			<li><a class='button' href='' id='del'>Terminer</a></li>
			<li><a class='button' href='' id='brush'>Suivant</a></li>
		</ul>
</nav>
<footer id='footer'>
		
</footer>
@stop