@extends('layouts.master')

@section('master.content')
    @foreach($comics as $comic)
    <div class="thumbnail thumbnail-comic" @if ($comic->cover) title="{{$comic->description}}" @endif >
        <h2>
            {{ Form::open(['route' => ['comic.delete', $comic->id], 'method' => 'delete', 'id' => $comic->id]); }}
            <a href="#">{{$comic->title}} <small>({{$comic->author}})</small></a>
            @if (Auth::check())
            <span class="btn-group pull-right" role="group">
                <a href="{{URL::route('comic.update', [$comic->id])}}" title="comics.update" class='btn btn-sm btn-primary glyphicon glyphicon-pencil'></a>
                <span title="base.delete" class='btn btn-sm btn-primary glyphicon glyphicon-remove' onclick="$('#{{$comic->id}}').submit();"></span>

            </span>
            @endif
            {{ Form::close(); }}
        </h2>
        @if ($comic->cover)
            {{ HTML::image($comic->cover, 'cover', array('width' => '846', 'height' => '170', 'class' => 'img-thumbnail')) }}
        @else
            {{ $comic->description }}
        @endif
    </div>
    @endforeach
    <div class="text-center">
    {{ $comics->links(); }}
    </div>
@stop
