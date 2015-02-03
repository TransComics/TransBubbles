@extends('layouts.master')

@section('master.content')
	<h1>add()</h1>
        
        {{ Form::open(['method' => 'put']); }}
        {{ Form::label('title', Lang::get('title')); }}
        {{ Form::text('title'); }}
        {{ Form::label('page', Lang::get('page')); }}
        {{ Form::text('page'); }}
        {{ Form::token(); }}
        {{ Form::submit('submit'); }}
        {{ Form::close(); }}
@stop