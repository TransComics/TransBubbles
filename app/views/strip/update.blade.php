@extends('layouts.master')
@section('master.content')

<h1>{{($isAdd) ? Lang::get('strips.addTitle') : Lang::get('strips.updateTitle');}}</h1>

<!-- Print the sessions message if any-->
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

<!-- We make the difference between an update form and an add form with isAdd-->
<!-- We choose the correct route, regarding if we are in addition or edition -->
@if ($isAdd) 
{{ Form::open(['method' => 'post', 'files' => true, 'class'=>'form-horizontal', 'id' => 'stripForm']); }}
@else 
{{ Form::open(['method' => 'put', 'files' => true, 'class'=>'form-horizontal', 'id' => 'stripForm']); }}
{{ Form::hidden('_method', 'put', ['id' => '_method']); }}
@endif

{{ Form::label('title', Lang::get('strips.title'), ['class'=>'sr-only']); }}
{{ Form::text('title', $strips->title, ['class'=>'form-control', 'placeholder' => Lang::get('strips.title')]); }}
{{ $errors->first('title', '<p class="alert alert-danger">:message</p>'); }}
<br />

<!-- File section : path chooser or thumbnail -->
@if ($isAdd)
{{ Form::label('strip', Lang::get('strips.stripFileSelector')); }}
{{ Form::file('strip', ['class'=>'filestyle']); }}
{{ $errors->first('strip', '<p class="alert alert-danger">:message</p>'); }}
@else
{{ HTML::image($strips->path, '', array('class' => 'thumbnail','style'=>"width: 500px" )) }}
@endif
<br />

<!-- We show the delete button only if we are in edition -->
<div class="btn-group" role="group">
    @if (!$isAdd)
    <span class="btn btn-lg btn-primary" onclick="$('#_method').val('DELETE'); $('#stripForm').attr('action',
          '{{ URL::route('strips.destroy', [$strips->id]) }}'); $('#stripForm').submit();"> @lang('base.delete') </span>
    @endif
    <a href="{{ URL::route('home') }}" class="btn btn-lg btn-primary"> @lang('base.cancel') </a>
    {{ Form::submit(Lang::get($isAdd ? 'base.add' : 'base.update'),['class'=>'btn btn-lg btn-primary']); }}
</div>
{{ Form::close(); }}

@stop
