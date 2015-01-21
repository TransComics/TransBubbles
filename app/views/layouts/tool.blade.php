@extends('layouts.html')

@section('styles')
	{{ HTML::style('css/toolsInterface.css') }}
@stop

@section('scripts')
	{{ HTML::script('js/lib/jquery-2.1.1.min.js') }}
	{{ HTML::script('js/lib/fabric.js') }}
	{{ HTML::script('js/cleanAndTranslate.js') }}
@stop

@section('body')
<div id='top-line'>
</div>
<header id='header'>
		<h1>Trans<span class="cyan-text">Bubbles</span> - Interface d'import</h1>
</header>
<nav id='nav'>
	<ul>
		<li><a class='button' href="" id="hidden-origin">Cacher</a></li>
		<li><span class='espace'></span></li>
		<li><a class='icon icon-update zero-padding' href="" id="update"></a></li>
		<li><a class='icon icon-text zero-padding' href="" id="text"></a></li>
		<li><a class='icon icon-del zero-padding' href="" id="del"></a></li>
		<li><a class='icon icon-brush zero-padding' href="" id="brush"></a></li>
		<li><a class='icon icon-rect zero-padding' href="" id="rect"></a></li>
		<li><a class='icon icon-circle zero-padding' href="" id="circle"></a></li>
		<li><a class='icon icon-viewAll zero-padding' href="" id="viewAll"></a></li>
		<li><a class='icon icon-selectAll zero-padding' href="" id="selectAll"></a></li>
		<li><a class='icon icon-undo zero-padding' href="" id="undo"></a></li>
		<li><a class='icon icon-redo zero-padding' href="" id="redo"></a></li>
	</ul>
</nav>

	@yield('content')

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