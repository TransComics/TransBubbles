@extends('layouts.master') @section('master.content')
<div class="page-header">
    <div class="row">
        <div class="row-same-height" style="border-bottom: 1px solid #464545;">
            <div class="col-md-9 col-xs-height">
                <h1>
                    {{$comic->title}} <small>{{ Lang::get('comic.created',['created' =>
						$comic->author]) }}</small> <a
                        href="{{URL::route('strip.index', [$comic->id])}}"
                        title="strip.index"
                        class='btn btn-sm btn-primary glyphicon glyphicon-menu-up'></a>
                </h1>
            </div>
            <div class="col-md-3 col-xs-height col-bottom"><p class="pull-right">{{Lang::get('comic.imported',['imported'
				=> User::find($comic->created_by)->username]) }}</p></div>
        </div>
    </div>
</div>
@if($comic->cover)
<div>{{ HTML::image($comic->cover, 'cover', array('width' => '846',
	'height' => '170', 'class' => 'img-thumbnail')) }}</div>
</br>
@endif
<div class="well">
    <h4>{{$comic->description}}</h4>
</div>
</br>

<div class="row">
    <div class="row-same-height">
        <div class="col-xs-10 col-xs-height">
            <h3>@lang('comic.lastStrip')</h3>
        </div>
        <div class="col-xs-2  col-xs-height col-bottom">
            <a href="{{URL::route('strip.create', [$comic->id])}}"
               title="strip.add"
               class='btn btn-sm btn-primary glyphicon glyphicon-plus pull-right'></a>
        </div>
    </div>
</div>
<hr>
</br>
<div class="row">
    @foreach($strips as $strip)
    <div class="col-sm-6 col-md-4">

        <a href="{{ route('strip.show',[ $comic->id, $strip->id]) }}"
           class="thumbnail">
                <h4 class="caption">{{ $strip->title }}</h4>
            {{HTML::image($strip->path, $strip->title,['id' =>
			'imageThumb'])}}
        </a>

    </div>

    @endforeach
</div>
@stop
