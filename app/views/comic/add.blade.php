@extends('layouts.master')

@section('master.content')
    <h1>add()</h1>
    
    @if(Session::has('message'))
        <p>{{ Session::get('message') }}</p>
    @endif
    
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach

    {{ Form::open(['method' => 'put']); }}
    {{ Form::label('title', Lang::get('base.title')); }}
    {{ Form::text('title'); }}
    {{ Form::label('page', Lang::get('pagination.page')); }}
    {{ Form::text('page'); }}
    {{ Form::token(); }}
    {{ Form::submit(Lang::get('base.add')); }}
    {{ Form::close(); }}
@stop