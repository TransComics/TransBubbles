@extends('layouts.master')

@section('master.content')
    @foreach($comics as $comic) 
    <p>{{$comic->title}} - {{$comic->author}} 
        {{ Form::open(['route' => ['comic.delete', $comic->id], 'method' => 'delete']); }}
        {{ Form::submit(Lang::get('base.delete')); }}
        {{ Form::close(); }}
    
    <a href="{{URL::route('comic.update', [$comic->id])}}" title="comics.update">Update</a>
    </p>
    @endforeach
            
    <a href="{{URL::route('comic.add')}}" title="comics.add">Add</a>
@stop