@extends('layouts.master') @section('master.content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12">
            <h1>
                {{$comic->title}} <small>{{ Lang::get('comic.created',['created' =>
					$comic->author]) }}</small>
                <a href="{{URL::route('strip.index', [$comic->id])}}" title="strip.index" class='btn btn-sm btn-primary glyphicon glyphicon-menu-up'></a>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-10">{{Lang::get('comic.imported',['imported'
			=> User::find($comic->created_by)->username]) }}</div>
    </div>
</div>
@if($comic->cover)
<div>
    {{ HTML::image($comic->cover, 'cover', array('width' => '846',
	'height' => '170', 'class' => 'img-thumbnail')) }}
</div>
</br>
@endif
<div class="border padding-10">
    <h4>{{$comic->description}}</h4>
</div>
</br>
<div class="page-header">
    <h3>@lang('comic.lastStrip')</h3>
    <a href="{{URL::route('strip.create', [$comic->id])}}" title="strip.add" class='btn btn-sm btn-primary glyphicon glyphicon-plus'></a>
</div>
<div class="row">
    @foreach($strips as $strip)
    <div class="col-sm-6 col-md-4">
        <a href="{{ route('strip.show',[ $comic->id, $strip->id]) }}" class="thumbnail">{{HTML::image($strip->path, $strip->title,['id' => 'imageThumb'])}}</a>
        <div class="caption">
            <h4>{{ $strip->title }}</h4>
        </div>
    </div>

    @endforeach
</div>
@stop
