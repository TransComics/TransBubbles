@extends('layouts.master')

@section('master.content')
@if(Session::has('message'))
<div id="signupalert" class="alert alert-info alert-dismissible">
 <button type="button" class="close" data-dismiss="alert">×</button>
	<ul>
		<li>{{ Session::get('message') }}</li>
	</ul>
	<span></span>
</div>
@endif
    @foreach($comics as $comic)
    <div class="thumbnail thumbnail-comic" @if ($comic->cover) title="{{$comic->description}}" @endif >
        <h2>
            <a href="{{ URL::route('comic.show',['id' => $comic->id] )}}">{{$comic->title}} <small>({{$comic->author}})</small></a>
            @if($comic->strips->count() > 0) 
            <span class="btn-group pull-right" role="group">               
                    <a href="{{URL::route('strip.index', [$comic->id])}}" title="@lang('strip.index')" class='btn btn-sm btn-primary glyphicon glyphicon-th'></a>
                    @if ($comic->getLastShowable() !== null)
                    <a href="{{URL::route('strip.show', [$comic->id, $comic->getLastShowable()->id])}}" style="margin-top: 1px; margin-right: 2px;" title="@lang('comic.last')" class='btn btn-sm btn-primary'> @lang('comic.last')</a>
                    @endif
            </span>
            @endif
        </h2>
        @if ($comic->cover)
        <a href="{{ URL::route('comic.show',['id' => $comic->id] )}}">
        <!--{{ HTML::image($comic->cover, 'cover', array('width' => '846', 'height' => '170', 'class' => 'img-thumbnail')) }} -->
        <img src="{{ Image::path($comic->cover, 'resize', 900, 300) }}"  alt="cover" style="min-height:200px;height:300px;" class="img-thumbnail"/>
        </a>
        @else
            {{ $comic->description }}
        @endif
    </div>
    @endforeach
    <div class="text-center">
    {{ $comics->links(); }}
    </div>
@stop

@section('master.nav')
    @parent
    @include('common.admin_nav')
@append