@extends('layouts.master')

@section('master.content')
    @if ($isAdd) 
        <h1>add()</h1>
    @else 
        <h1>update()</h1>
    @endif
    
    @if(Session::has('message'))
        <p>{{ Session::get('message') }}</p>
    @endif
    
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach

    @if ($isAdd) 
        {{ Form::open(['method' => 'put']); }}
    @else 
        {{ Form::open(['route' => ['comic.update', $comic->id], 'method' => 'post']); }}
    @endif
    
    {{ Form::label('title', Lang::get('base.title')); }}
    {{ Form::text('title', $comic->title); }}
    {{ Form::label('author', Lang::get('comic.author')); }}
    {{ Form::text('author', $comic->author); }}
    {{ Form::label('description', Lang::get('comic.description')); }}
    {{ Form::text('description', $comic->description); }}
    {{ Form::token(); }}
    
    @if ($isAdd) 
        {{ Form::submit(Lang::get('base.add')); }}
    @else 
        {{ Form::submit(Lang::get('base.update')); }}
    @endif
    {{ Form::close(); }}
    
    <a href="{{URL::route('comics.list')}}" title="comics.list">List</a>
@stop