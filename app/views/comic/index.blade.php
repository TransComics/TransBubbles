@extends('layouts.master')

@section('master.content')
    @foreach($comics as $comic)
    <div class="thumbnail thumbnail-comic" @if ($comic->cover) title="{{$comic->description}}" @endif >
        <h2>
            {{ Form::open(['route' => ['comic.destroy', $comic->id], 'method' => 'delete', 'id' => $comic->id]); }}
            <a href={{ URL::route('comic.show',['id' => $comic->id] )}}>{{$comic->title}} <small>({{$comic->author}})</small></a>
            @if (Auth::check())
            <span class="btn-group pull-right" role="group">
                <a href="{{URL::route('strip.create', [$comic->id])}}" title="strip.add" class='btn btn-sm btn-primary glyphicon glyphicon-plus'></a>
                <a href="{{URL::route('comic.edit', [$comic->id])}}" title="comics.edit" class='btn btn-sm btn-primary glyphicon glyphicon-pencil'></a>
                <span title="base.delete" class='btn btn-sm btn-primary glyphicon glyphicon-remove' onclick="$('#{{$comic->id}}').submit();"></span>

            </span>
            @endif
            {{ Form::close(); }}
        </h2>
        @if ($comic->cover)
        <a href={{URL::route('strip.show', [$comic->id, $comic->strips->last()->id])}}>{{ HTML::image($comic->cover, 'cover', array('width' => '846', 'height' => '170', 'class' => 'img-thumbnail')) }} </a>
        @else
            {{ $comic->description }}
        @endif
    </div>
    @endforeach
    <div class="text-center">
    {{ $comics->links(); }}
    </div>
@stop