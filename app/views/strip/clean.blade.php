@extends('layouts.tool')

@section('tool.title')
	Interface de nettoyage
@stop

@section('tool.items')
	<li><a class='icon icon-update zero-padding' href="" id="update"></a></li>
	<li><a class='icon icon-del zero-padding' href="" id="del"></a></li>
	<li><a class='icon icon-brush zero-padding' href="" id="brush"></a></li>
	<li><a class='icon icon-rect zero-padding' href="" id="rect"></a></li>
	<li><a class='icon icon-circle zero-padding' href="" id="circle"></a></li>
	
	<li><span class='espace' href="" id=""></span></li>
	
	<li><a class='icon icon-viewAll zero-padding' href="" id="viewAll"></a></li>
	<li><span class='icon icon-selectAll zero-padding' href="" id="selectAll"></span></li>
	
	<li><span class='espace' href="" id=""></span></li>
	
	<li><a class='icon icon-zoomm zero-padding' href="" id="btnZoomOut"></a></li>
	<li><a class='icon icon-zoomp zero-padding' href="" id="btnZoomIn"></a></li>
	<li><a class='icon icon-zoom zero-padding' href="" id="btnResetZoom"></a></li>
	
	<li><div class='espace' href="" id=""></div></li>
	
	<li><a class='icon icon-undo zero-padding' href="" id="undo"></a></li>
	<li><a class='icon icon-redo zero-padding' href="" id="redo"></a></li>
@stop

@section('tool.content')
<div id="main">
	<table id="paint">
		<tr>
			<td class="origin-td">
				<div class='origin'>
					{{ HTML::image('images/strips/stripFile2.jpg', 'strip', array('id' => 'i')) }}
				</div>
			</td>
			<td id="delivered">
					<canvas id="c" width="510" height="696"></canvas>
			</td>
		</tr>
	</table>
</div>
@stop