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
{{ Form::open(['method' => 'post', 'files' => true], ['class'=>'form-horizontal']); }}
@else 
{{ Form::open(['method' => 'put', 'files' => true], ['class'=>'form-horizontal']); }}
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
<!-- Here it's a little tricky, we have two buttons and we have the same route for the form -->
<!-- We will treat if we delete of update on the controller later -->
<div class="btn-group" role="group">
    @if (!$isAdd)
    {{ Form::submit(Lang::get('base.delete'),['name' => 'delete', 'class'=>'btn btn-lg btn-primary']); }}
    @endif
    <a href="{{ URL::route('home') }}" class="btn btn-lg btn-primary"> @lang('base.cancel') </a>
    {{ Form::submit(Lang::get($isAdd ? 'base.add' : 'base.update'),['name' => 'add', 'class'=>'btn btn-lg btn-primary']); }}
</div>
{{ Form::close(); }}

@stop
