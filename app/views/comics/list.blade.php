@extends('layouts.master')

@section('master.content')
    @foreach($comics as $comic) 
        <p>{{$comic->title}} - {{$comic->author}} 
            {{ Form::open(['route' => ['comic.delete', $comic->id], 'method' => 'delete']); }}
            {{ Form::submit(Lang::get('base.delete'), ['class'=>'form-control']); }}
            {{ Form::close(); }}

            <a href="{{URL::route('comic.update', [$comic->id])}}" title="comics.update" class='btn btn-default'>Update</a>
        </p>
    @endforeach
@stop