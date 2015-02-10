@extends('layouts.tool')

@section('tool.title')
	Interface de nettoyage
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
	<a class='btn btn-lg btn-primary icon-rect' href="" id="rect"></a>
	<a class='btn btn-lg btn-primary icon-circle' href="" id="circle"></a>
    </div>

    <div class="btn-group pull-right" role="group">
	<input class="btn btn-lg btn-primary" style="height:46px;" type="color" name="colorPicker" id="colorPicker" value="#ffffff" />
	<input class="btn btn-lg btn-primary" style="width:76px;" type="number" name="sizePicker" id="sizePicker" value="20" min="1" max="999" />
	<a class='btn btn-lg btn-primary icon-brush' href="" id="brush"></a>
    </div>

    <div class="btn-group pull-right" role="group">
        <a class='btn btn-lg btn-primary icon-update' href="" id="update"></a>
	<a class='btn btn-lg btn-primary icon-del' href="" id="del"></a>
    </div>
@stop

@section('tool.content')
<div id="main">
	<table id="paint">
		<tr>
			<td class="origin-td">
				<div class='origin'>
					{{ HTML::image('upload/0/stripFile2.jpg', 'strip', array('id' => 'i')) }}
				</div>
			</td>
			<td id="delivered">
					<canvas id="c" width="510" height="696"></canvas>
			</td>
		</tr>
	</table>
</div>
@stop