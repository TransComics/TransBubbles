@extends('layouts.tool')

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