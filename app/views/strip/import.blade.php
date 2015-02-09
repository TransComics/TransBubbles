@extends('layouts.master')

@section('master.content')

<h1> import</h1>
@if(Session::has('message'))
<div id="signupalert" class="alert alert-danger">
    <ul>
        <li>{{ Session::get('message') }}</li>
    </ul>
    <span></span>
</div>
@endif

@if(Session::has('success'))
<div id="signupalert" class="alert alert-success">
    <ul>
        <li>{{ Session::get('success') }}</li>
    </ul>
    <span></span>
</div>
@endif
{{ Form::open(array('route' => 'strips.store', 'method' => 'POST','files'=>true)) }}
<ul>
    <li>
        {{ Form::label('title', Lang::get('strips.title')) }}
        {{ Form::text('title') }}
    </li>
    <li>
        {{ Form::label('author', Lang::get('strips.author')) }}
        {{ Form::text('author') }}
    </li>
    <li>
        {{ Form::label('pageNumber', Lang::get('strips.pageNumber')) }}
        {{ Form::text('pageNumber') }}
    </li>
    <li>
        {{ Form::file('strip', array('class' => 'file-style')) }}
    </li>
    <li>
        {{ Form::submit(Lang::get('strips.send'), array('class'=>'btn
					btn-success')) }}
    </li>
</ul>
{{ Form::close() }}

@stop
