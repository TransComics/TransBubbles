@extends('layouts.master')

@section('master.content')
    @foreach($comics as $comic)
    <div class="thumbnail thumbnail-comic" @if ($comic->cover) title="{{$comic->description}}" @endif >
        <h2>
            {{ Form::open(['route' => ['comic.destroy', $comic->id], 'method' => 'delete', 'id' => $comic->id]); }}
            <a href="{{ URL::route('comic.show',['id' => $comic->id] )}}">{{$comic->title}} <small>({{$comic->author}})</small></a>
            @if($comic->strips->count() > 0) 
            <span class="btn-group pull-right" role="group">               
                    <a href="{{URL::route('strip.index', [$comic->id])}}" title="strip.index" class='btn btn-sm btn-primary glyphicon glyphicon-th'></a>
                    @if ($comic->getLastShowable() !== null)
                    <a href="{{URL::route('strip.show', [$comic->id, $comic->getLastShowable()->id])}}" style="margin-top: 1px; margin-right: 2px;" title="strip.show" class='btn btn-sm btn-primary'>Last</a>
                    @endif
            </span>
            @endif
            {{ Form::close(); }}
        </h2>
        @if ($comic->cover)
        <a href="{{ URL::route('comic.show',['id' => $comic->id] )}}">{{ HTML::image($comic->cover, 'cover', array('width' => '846', 'height' => '170', 'class' => 'img-thumbnail')) }} </a>
        @else
            {{ $comic->description }}
        @endif
    </div>
    @endforeach
    <div class="text-center">
    {{ $comics->links(); }}
    </div>
@stop