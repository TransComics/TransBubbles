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
<h1>{{ $strip->title }}</h1>
<div class="text-center center-block">
	<small>@lang('strip.dateCreated') {{ $strip->created_at }} -
		@lang('strip.dateUpdated') {{ $strip->updated_at }} - 
                @lang('comic.imported',['imported'=> $strip->user->username])</small>
</div>
<hr>
<div class="text-center center-block">
<div class="img-responsive">
{{ HTML::image($strip->path, $strip->title, ['class' => '']); }}
</div>
</div>
</br>
<div class="text-center center-block">
	{{ Form::open(['route' => ['strip.select', $strip->comic_id], 'method'=>'post','id'=>'moderate']); }} 
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
	<a class="btn btn-danger btn-lg clickable" data-toggle="modal"
		data-target="#confirm-submit" id="refuse">@lang('moderate.refuse')</a>
	{{HTML::linkRoute('strip.moderate', Lang::get('moderate.getother'), $strip->comic_id, ['class'=> 'btn btn-primary btn-lg']);}} 
	<a class="btn btn-success  btn-lg clickable" id="accept">@lang('moderate.validate')</a>
	{{ Form::close(); }}
</div>
@stop