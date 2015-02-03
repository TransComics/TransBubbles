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
		<h1>Trans<span class="cyan-text">Bubbles</span> - Interface d'import</h1>
</header>
<nav id='nav'>
	<ul id="origin-remote">
		<li><a class='button' href="" id="hidden-origin">Cacher</a></li>
	</ul>
	<ul id="delivered-remote">
		<li><a class='icon icon-update zero-padding' href="" id="update"></a></li>
		<li><a class='icon icon-text zero-padding' href="" id="text"></a></li>
		<li><a class='icon icon-del zero-padding' href="" id="del"></a></li>
		<li><a class='icon icon-brush zero-padding' href="" id="brush"></a></li>
		<li><a class='icon icon-rect zero-padding' href="" id="rect"></a></li>
		<li><a class='icon icon-circle zero-padding' href="" id="circle"></a></li>
		<li><a class='icon icon-viewAll zero-padding' href="" id="viewAll"></a></li>
		<li><span class='icon icon-selectAll zero-padding' href="" id="selectAll"></span></li>
		
		<li><a class='icon icon-zoomm zero-padding' href="" id="btnZoomOut"></a></li>
		<li><a class='icon icon-zoomp zero-padding' href="" id="btnZoomIn"></a></li>
		<li><a class='icon icon-zoom zero-padding' href="" id="btnResetZoom"></a></li>
			
		<li><a class='icon icon-undo zero-padding' href="" id="undo"></a></li>
		<li><a class='icon icon-redo zero-padding' href="" id="redo"></a></li>
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