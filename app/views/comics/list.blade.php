@extends('layouts.master')

@section('master.content')
    @foreach($comics as $comic)
    <div class="thumbnail thumbnail-comic">
        <h2>
            {{ Form::open(['route' => ['comic.delete', $comic->id], 'method' => 'delete', 'id' => $comic->id]); }}
            <a href="#">{{$comic->title}} <small>({{$comic->author}})</small></a>
            <span class="btn-group pull-right" role="group">
                <a href="{{URL::route('comic.update', [$comic->id])}}" title="comics.update" class='btn btn-sm btn-primary glyphicon glyphicon-pencil'></a>
                <span title="base.delete" class='btn btn-sm btn-primary glyphicon glyphicon-remove' onclick="$('#{{$comic->id}}').submit();"></span>

            </span>
            {{ Form::close(); }}
        </h2>
        {{ HTML::image($comic->cover, 'cover', array('width' => '700', 'height' => '200')) }}
    </div>
    <br/>
    @endforeach
@stop