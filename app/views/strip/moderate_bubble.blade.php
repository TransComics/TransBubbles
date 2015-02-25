@extends('layouts.tool')

@section('tool.title')
	@lang('moderate.bubble_moderation')
@stop

@section('tool.scripts')
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
@section('tool.items')
    {{ Form::open(['route' => ['strip.lang'], 'method' => 'post', 'id' => 'langFormFrom', 'style' => 'display : inline;']) }}
    {{ Form::select('lang_id', $available_languages, $lang_strip,['class'=>'selectpicker','data-width'=>'auto', 'id'=>'langOrigin', 'onChange' => '$("#langFormFrom").submit();'])}}
    {{ Form::close() }}
@stop
@section('tool.content')
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
                {{HTML::image($strip->path, 'strip', array('id' => 'responsive_image-'.$strip->id, 'class' => 'center-block', 'style' => 'position:absolute; left:10000px;'))}}
                <div class="showCanvas text-right">
                    <span class="showCanvas-json hidden">{{$canvas_origin}}</span>
                    <span class="showCanvas-height hidden">{{$canvas_height}}</span>
                    <span class="showCanvas-width hidden">{{$canvas_width}}</span>
                    <span class="id hidden">canvas_origin-{{$strip->id}}</span>
                    <span class="img_id hidden">responsive_image-{{$strip->id}}</span>
                    <canvas id="canvas_origin-{{$strip->id}}" class="showCanvas-canvas" width="706" height="283"></canvas>
                </div>
            </td>
            <td id="delivered">
                <div class="showCanvas text-right">
                    <span class="showCanvas-json hidden">{{$canvas}}</span>
                    <span class="showCanvas-height hidden">{{$canvas_height}}</span>
                    <span class="showCanvas-width hidden">{{$canvas_width}}</span>
                    <span class="id hidden">canvas-{{$strip->id}}</span>
                    <span class="img_id hidden">responsive_image-{{$strip->id}}</span>
                    <canvas id="canvas-{{$strip->id}}" class="showCanvas-canvas" width="706" height="283"></canvas>
                </div>
            </td>
        </tr>
    </table>
</div>
<br />
<div class="text-center center-block">
    {{ Form::open(['route' => ['strip.selectBubble', $strip->comic_id, $bubble->id], 'method'=>'post','id'=>'moderate']) }} 
	{{ Form::hidden('choice', '', ['id' =>'choice']) }} 
	{{ Form::hidden('strip_id', $strip->id, ['id' => 'strip_id']) }}
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
							<label> {{ Form::checkbox('delete', 1, null, ['id' => 'delete_box']) }} @lang('moderate.delete') </label>
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
	 @if($previousPendingBubble)
		<a class='btn btn-primary glyphicon glyphicon-chevron-left' href="{{URL::route('strip.moderateImport', ['comic_id' => $strip->comic_id, 'bubble_id' => $previousPendingBubble->id])}}"></a>
    @endif
	@if($nextPendingBubble)
	   <a class='btn btn-primary glyphicon glyphicon-chevron-right' href="{{URL::route('strip.moderateImport',['comic_id' => $strip->comic_id, 'bubble_id' => $nextPendingBubble->id] )}}"></a>
	@endif
	</div>
	<br/>
	<br/>
    <a class="btn btn-default  btn-lg" href="{{URL::route('strip.index', $strip->comic_id)}}">@lang('moderate.quit')</a>
        <a class="btn btn-danger btn-lg clickable" data-toggle="modal" data-target="#confirm-submit" id="refuse">@lang('moderate.refuse')</a> 
	<a class="btn btn-success  btn-lg clickable" id="accept">@lang('moderate.validate')</a>
	{{ Form::close(); }}
</div>
@stop
