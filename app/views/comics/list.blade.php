@extends('layouts.master')

@section('master.content')
	@foreach($comics as $comic) 
        <p>{{$comic->title}} - {{$comic->page}}</p>
        @endforeach
@stop