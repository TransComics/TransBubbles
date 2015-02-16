@extends('layouts.master') @section('master.content')


<h1>{{ $strips->title }}</h1>

<div class="text-center center-block">
	<small>@lang('strip.dateCreated') {{ $strips->created_at }} -
		@lang('strip.dateUpdated') {{ $strips->updated_at }}</small>
</div>
<hr>
<div class="text-center center-block">
	{{ HTML::image($strips->path, 'strip', array('id' => 'i', 'class' =>
	'thumbnail center-block img-responsive')) }}

	<div class="btn-group" role="group">
		<a class='btn btn-primary glyphicon glyphicon-fast-backward' href=""></a>
		<a class='btn btn-primary glyphicon glyphicon-chevron-left' href=""></a>
		<a class='btn btn-primary glyphicon glyphicon-random'
			href="{{URL::route('strip.show', array('comic_id'=>$strips->comic_id,'id'=>$strips->id))}}"
			id="btnRandom"></a> <a
			class='btn btn-primary glyphicon glyphicon-chevron-right' href=""></a>
		<a class='btn btn-primary glyphicon glyphicon-fast-forward' href=""></a>
	</div>
	</br> </br>
	<div class="btn-group" role="group">
		<a class="btn btn-primary glyphicon glyphicon glyphicon-heart" href=""></a>
		<a class="btn btn-primary glyphicon glyphicon-thumbs-up" href=""><span
			style="margin-left: 5px; top: 0px;" class="badge">300</span></a> <a
			class="btn btn-primary glyphicon glyphicon glyphicon-thumbs-down"
			href=""><span style="margin-left: 5px; top: 0px;" class="badge">3</span></a>
	</div>
	<div class="btn-group" role="group">
		<a
			href="{{URL::route('strip.index', array('comic_id' => $strips->comic_id))}}"
			style="top: 1px;" class="btn btn-primary"><i
			class="glyphicon glyphicon-th"></i> View All</a>
	</div>
	
	<div class="btn-group" role="group">
		<a
			href="{{URL::route('strip.vote', array('comic_id' => $strips->comic_id, 'strip_id' => $strips->id, 'lang' => 'fr'))}}"
			style="top: 1px;" class="btn btn-primary"><i
			class="fa fa-comments-o fa-lg" style="padding-right: 5px;"></i>@lang('strip.other_translation')</a>
		<a
			href="{{URL::route('strip.vote', array('comic_id' => $strips->comic_id, 'strip_id' => $strips->id))}}"
			style="top: 1px;" class="btn btn-primary"><i
			class="fa fa-globe fa-lg" style="padding-right: 5px;"></i>@lang('strip.languages')</a>
	</div>
</div>

@stop
