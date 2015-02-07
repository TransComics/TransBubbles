@extends('layouts.tool')

@section('tool.title')
	Interface de traduction
@stop

@section('tool.items')
    <div class="btn-group pull-right" role="group">
	<a class='btn btn-lg btn-primary icon-undo' href="" id="undo"></a>
	<a class='btn btn-lg btn-primary icon-redo' href="" id="redo"></a>
    </div>

    <div class="btn-group pull-right" role="group">
	<a class='btn btn-lg btn-primary icon-zoomm' href="" id="btnZoomOut"></a>
	<a class='btn btn-lg btn-primary icon-zoomp' href="" id="btnZoomIn"></a>
        <a class='btn btn-lg btn-primary icon-zoom' href="" id="btnResetZoom"></a>
    </div>
    
    <div class="btn-group pull-right" role="group">
	<a class='btn btn-lg btn-primary icon-viewAll' href="" id="viewAll"></a>
	<span class='btn btn-lg btn-primary icon-selectAll' href="" id="selectAll"></span>
    </div>

    <div class="btn-group pull-right" role="group">
	<a class='btn btn-lg btn-primary icon-update' href="" id="update"></a>
	<a class='btn btn-lg btn-primary icon-text' href="" id="text"></a>
	<a class='btn btn-lg btn-primary icon-del' href="" id="del"></a>
    </div>
@stop

@section('tool.items')
	<li><a class='icon icon-update zero-padding' href="" id="update"></a></li>
	<li><a class='icon icon-text zero-padding' href="" id="text"></a></li>
	<li><a class='icon icon-del zero-padding' href="" id="del"></a></li>
	<li><a class='icon icon-brush zero-padding' href="" id="brush"></a></li>
	<li><a class='icon icon-rect zero-padding' href="" id="rect"></a></li>
	<li><a class='icon icon-circle zero-padding' href="" id="circle"></a></li>
	<li><a class='icon icon-viewAll zero-padding' href="" id="viewAll"></a></li>
	<li><span class='icon icon-selectAll zero-padding' href="" id="selectAll"></span></li>
	
	<li><span class='icon espace zero-padding' href="" id="selectAll"></span></li>
	
	<li><a class='icon icon-zoomm zero-padding' href="" id="btnZoomOut"></a></li>
	<li><a class='icon icon-zoomp zero-padding' href="" id="btnZoomIn"></a></li>
	<li><a class='icon icon-zoom zero-padding' href="" id="btnResetZoom"></a></li>
	
	<li><span class='icon espace zero-padding' href="" id="selectAll"></span></li>
	
	<li><a class='icon icon-undo zero-padding' href="" id="undo"></a></li>
	<li><a class='icon icon-redo zero-padding' href="" id="redo"></a></li>
@stop

@section('tool.content')
<div id="main">
	<table id="paint">
		<tr>
			<td class="origin-td">
				<div class='origin'>
					{{ HTML::image('images/strips/stripFile.jpg', 'strip', array('id' => 'i')) }}
				</div>
			</td>
			<td id="delivered">
					<canvas id="c" width="706" height="283"></canvas>
			</td>
		</tr>
	</table>
</div>
@stop