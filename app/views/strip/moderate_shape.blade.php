@extends('layouts.master') 
@section('master.scripts')
<script type="text/javascript">
$(document).ready(function() {
	$('#accept').on('click',function() {
		$('#choice').val($(this).attr('id'));
		$('#moderate').submit();
	});
	$('#submit').on('click',function() {
		$('#choice').val('refuse');
		$('#moderate').submit();
	});
	
});
</script>
@stop 
@section('master.content')
@if(Session::has('message'))
<div id="signupalert" class="alert alert-danger alert-dismissible">
 <button type="button" class="close" data-dismiss="alert">×</button>
	<ul>
		<li>{{ Session::get('message') }}</li>
	</ul>
	<span></span>
</div>
@endif

<div id="main">
    <table id="paint">
        <tr>
            <td id="origin">
                <div class="showCanvas text-right">
                    <span class="showCanvas-json hidden">{{$canvas_original}}</span>
                    <span class="showCanvas-height hidden">{{$strip_height}}</span>
                    <span class="showCanvas-width hidden">{{$strip_width}}</span>
                    <span class="id hidden">canvas-{{$bubble->id}}</span>
                    <canvas id="canvas-{{$bubble->id}}" class="showCanvas-canvas" width="706" height="283"></canvas>
                </div>
            </td>
            <td id="delivered">
                <canvas id="c" width="706" height="283"></canvas>
            </td>
        </tr>
    </table>
</div>

<div class="text-center center-block">
	<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">@lang('base.confirm')</div>
				<div class="modal-body">
					<div class="form-group">{{ Form::label('description',Lang::get('moderate.comment').'*', ['class'=>'control-label']); }} 
					{{ Form::textarea('comment',null, ['class'=>'form-control', 'placeholder' => Lang::get('moderate.comment')]); }}</div>
					<div class="input-group">
						<div class="checkbox">
							<label> {{ Form::checkbox('delete', 1, null, ['id' =>
								'delete_box']) }} @lang('moderate.delete') </label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">@lang('base.cancel')</button>
					<a id="submit" class="btn btn-danger success">@lang('base.delete')</a>
				</div>
			</div>
		</div>
	</div>
	<div class="btn-group" role="group">
	 @if($previousPendingShape)
		<a class='btn btn-primary glyphicon glyphicon-fast-backward' href="{{URL::route('strip.moderateShape', ['comic_id' => $strip->comic_id, 'shape_id' => $previousPendingShape])}}"></a>
		@endif
	@if($nextPendingShape)
	   <a class='btn btn-primary glyphicon glyphicon-chevron-right' href="{{URL::route('strip.moderateShape',['comic_id' => $strip->comic_id, 'shape_id' => $nextPendingShapes] )}}"></a>
	@endif
	</div>
	<a class="btn btn-danger btn-lg clickable" data-toggle="modal"
		data-target="#confirm-submit" id="refuse">@lang('moderate.refuse')</a> 
	<a class="btn btn-success  btn-lg clickable" id="accept">@lang('moderate.validate')</a>
	{{ Form::close(); }}
</div>
@stop