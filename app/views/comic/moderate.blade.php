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
<div class="page-header">
	<div class="row">
		<div class="row-same-height" style="border-bottom: 1px solid #464545;">
			<div class="col-md-9 col-xs-height">
				<h1>
					{{$comic->title}} <small>{{ Lang::get('comic.created',['created' =>
						$comic->author]) }}</small>
				</h1>
			</div>
			<div class="col-md-3 col-xs-height col-bottom">
				<p class="pull-right">{{Lang::get('comic.imported',['imported' =>
					User::find($comic->created_by)->username]) }}</p>
			</div>
		</div>
	</div>
</div>
@if($comic->cover)
<div>{{ HTML::image($comic->cover, 'cover', array('width' => '846','height' => '170', 'class' => 'img-thumbnail')) }}</div>
</br>
@endif
<div class="well">
	<h4>{{$comic->description}}</h4>
</div>
</br>
<div class="text-center center-block">
	{{ Form::open(['route' => 'comic.select', 'method'=>'post','id'=>'moderate']); }} 
	{{ Form::hidden('choice', '', ['id' =>'choice']) }} 
	{{ Form::hidden('comic_id', $comic->id, ['id' =>'comic_id']) }}
	<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">@lang('base.confirm')</div>
				<div class="modal-body">
					<div class="form-group">
					{{ Form::label('description',Lang::get('moderate.comment').'*', ['class'=>'control-label']); }} 
					{{ Form::textarea('comment',null, ['class'=>'form-control','placeholder' => Lang::get('moderate.comment')]); }}</div>
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
	<a class="btn btn-danger btn-lg clickable" data-toggle="modal"
		data-target="#confirm-submit" id="refuse">@lang('moderate.refuse')</a>
	{{HTML::linkRoute('comic.moderate', Lang::get('moderate.getother'), null, ['class'=> 'btn btn-primary btn-lg']);}} <a
		class="btn btn-success  btn-lg clickable" id="accept">@lang('moderate.validate')</a>
	{{ Form::close(); }}
</div>
@stop
