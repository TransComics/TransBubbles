@extends('layouts.master')
@section('master.scripts')
<script type="text/javascript">
$(document).ready(function() {
	$('#submit').on('click',function() {
		$('#_method').val('DELETE'); 
		$('#stripForm').attr('action', '{{ URL::route('strip.destroy', [$strips->comic_id, $strips->id]) }}');
		$('#stripForm').submit();
	});
});
</script>
@stop 

@section('master.content')
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

{{ Form::open(['method' => 'put', 'files' => true, 'class'=>'form-horizontal', 'id' => 'stripForm']); }}
{{ Form::hidden('_method', 'put', ['id' => '_method']); }}

<div class="text-center">
    <h1>@lang('strip.updateTitle')</h1>
</div>
<br />

<div class="form-group">
    {{ Form::label('title', Lang::get('strip.title'), ['class'=>'col-sm-2 control-label']); }}
    <div class="col-sm-10 ">
        {{ Form::text('title', $strips->title, ['class'=>'form-control', 'placeholder' => Lang::get('strip.title')]); }}
        {{ $errors->first('title', '<p class="alert alert-danger">:message</p>'); }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('index', 'Index' , ['class' => 'col-sm-2 control-label']); }}
     <div class="col-sm-10">
        {{ Form::number('index', $strips->index, ['class' => 'form-control']); }}
        {{ $errors->first('index', '<p class="alert alert-danger">:message</p>'); }}
    </div>
    
</div>

<div class="form-group text-center">
    {{ HTML::image($strips->path, '', array('class' => 'img-thumbnail')) }}
</div>
    <div class="btn-group pull-right" role="group">
        <span class="btn btn-danger danger" data-toggle="modal"
		data-target="#confirm-submit" id="refuse"> @lang('base.delete') </span>
        <a href="{{ URL::route('strip.index', $strips->comic_id) }}" class="btn btn-primary"> @lang('base.cancel') </a>
        {{ Form::submit(Lang::get('base.update'),['class'=>'btn btn-primary']); }}
    </div>
    {{ Form::close(); }}
@stop
@include('common.submit_delete')
