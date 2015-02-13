@extends('layouts.master')


@section('master.content')
 

<h1>{{ $strips->title }}</h1>

<div class="text-center center-block">
    <small>@lang('strip.dateCreated') {{ $strips->created_at }} - @lang('strip.dateUpdated') {{ $strips->updated_at }}</small>
</div>

<div class="text-center center-block">
    {{ HTML::image($strips->path, 'strip', array('id' => 'i', 'class' => 'thumbnail center-block')) }}
    <div class="btn-group" role="group">
        <a class='btn btn-primary glyphicon glyphicon glyphicon-heart' href=""></a>
        <a class='btn btn-primary glyphicon glyphicon glyphicon-thumbs-up' href=""></a>
        <a class='btn btn-primary glyphicon glyphicon glyphicon-thumbs-down' href=""></a>
    </div>

    <div class="btn-group" role="group">
        <a class='btn btn-primary glyphicon glyphicon-fast-backward' href=""></a>
         <a class='btn btn-primary glyphicon glyphicon-chevron-left' href=""></a>
        <a class='btn btn-primary glyphicon glyphicon-random' href="{{URL::route('strip.show', array('comic_id'=>$strips->comic_id,'id'=>$strips->id))}}" id="btnRandom"></a>
         <a class='btn btn-primary glyphicon glyphicon-chevron-right' href=""></a>
        <a class='btn btn-primary glyphicon glyphicon-fast-forward' href=""></a>
        <a class='btn btn-primary' href="{{URL::route('strip.index', array('comic_id' => $strips->comic_id))}}">All</a>
    </div>
</div>

@stop