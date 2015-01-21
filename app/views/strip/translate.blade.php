@extends('layouts.tool')

@section('content')
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