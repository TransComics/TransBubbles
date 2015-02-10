@extends('layouts.tool') @section('tool.title') Interface de traduction
@stop @section('tool.items')
<div class="btn-group pull-right" role="group">
	<a class='btn btn-lg btn-primary icon-undo' href="" id="undo"></a> <a
		class='btn btn-lg btn-primary icon-redo' href="" id="redo"></a>
</div>

<div class="btn-group pull-right" role="group">
	<a class='btn btn-lg btn-primary icon-zoomm' href="" id="btnZoomOut"></a>
	<a class='btn btn-lg btn-primary icon-zoomp' href="" id="btnZoomIn"></a>
	<a class='btn btn-lg btn-primary icon-zoom' href="" id="btnResetZoom"></a>
</div>

<div class="btn-group pull-right" role="group">
	<a class='btn btn-lg btn-primary icon-viewAll' href="" id="viewAll"></a>
	<span class='btn btn-lg btn-primary icon-selectAll' href=""
		id="selectAll"></span>
</div>

<div class="btn-group pull-right" role="group">
	<a class='btn btn-lg btn-primary icon-update' href="" id="update"></a>
	<a class='btn btn-lg btn-primary icon-text' href="" id="text"></a> <a
		class='btn btn-lg btn-primary icon-del' href="" id="del"></a>
</div>
@stop 
@section('tool.content')
<div id="main">
	<table id="paint">
		<tr>
			<td class="origin-td">
				<div class='origin'>{{
					HTML::image('uploads/0/d9480b185525ee7711522b34544fb0f6', 'strip', array('id' => 'i')) }}</div>
			</td>
			<td id="delivered">
				<canvas id="c" width="706" height="283"></canvas>
			</td>
		</tr>
	</table>
</div>
@include('translate.popup')
@stop


