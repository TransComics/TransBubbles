@extends('layouts.master') @section('master.content')
<h1>{{ $strips->title }}</h1>
<div class="text-center center-block">
	<small>@lang('strip.dateCreated') {{ $strips->created_at }} -
		@lang('strip.dateUpdated') {{ $strips->updated_at }} - 
                @lang('comic.imported',['imported'=> $strips->user->username])</small>
</div>
<hr>
<div class="text-center center-block">
	
        <div class="showCanvas text-right">
            <span class="showCanvas-json hidden">{{$canvas}}</span>
            <span class="showCanvas-height hidden">{{$canvas_height}}</span>
            <span class="showCanvas-width hidden">{{$canvas_width}}</span>
            <span class="id hidden">canvas-{{$bubble_id}}</span>
            <canvas id="canvas-{{$bubble_id}}" class="showCanvas-canvas" width="706" height="283"></canvas>
        </div>
        <br />
	<div class="btn-group" role="group">
                @if($previous_strip)
		<a class='btn btn-primary glyphicon glyphicon-fast-backward' href="{{URL::route('strip.show', array('comic_id'=>$strips->comic_id,'id'=>$first_strip->id))}}"></a>
		@endif
                @if($previous_strip)
                <a class='btn btn-primary glyphicon glyphicon-chevron-left' href="{{URL::route('strip.show', array('comic_id'=>$strips->comic_id,'id'=>$previous_strip->id))}}"></a>
		@endif
                @if($random_strip)
                <a class='btn btn-primary glyphicon glyphicon-random' href="{{URL::route('strip.show', array('comic_id'=>$strips->comic_id,'id'=>$random_strip->id))}}" id="btnRandom"></a> 
                @endif
                @if($next_strip)
                <a class='btn btn-primary glyphicon glyphicon-chevron-right' href="{{URL::route('strip.show', array('comic_id'=>$strips->comic_id,'id'=>$next_strip->id))}}"></a>
		@endif
                @if($next_strip)
                <a class='btn btn-primary glyphicon glyphicon-fast-forward' href="{{URL::route('strip.show', array('comic_id'=>$strips->comic_id,'id'=>$last_strip->id))}}"></a>
                @endif
	</div>
	</br> </br>
	<div class="btn-group" role="group">
		<a class="btn btn-primary glyphicon glyphicon glyphicon-heart" href=""></a>
		<a class="btn btn-primary glyphicon glyphicon-thumbs-up" href=""><span style="margin-left: 5px; top: 0px;" class="badge">300</span></a> <a class="btn btn-primary glyphicon glyphicon glyphicon-thumbs-down" href=""><span style="margin-left: 5px; top: 0px;" class="badge">3</span></a>
	</div>
	<div class="btn-group" role="group">
		<a href="{{URL::route('strip.index', array('comic_id' => $strips->comic_id))}}" class="btn btn-primary"><i class="glyphicon glyphicon-th"></i> View All</a>
	</div>
	<div class="btn-group" role="group">
            {{ Form::open(['route' => ['strip.lang'], 'method' => 'post', 'id' => 'langStripForm', 'style' => 'display : inline;']) }}
            {{ Form::select('lang_id', $available_languages, $lang_strip,['class'=>'btn btn-primary','data-width'=>'auto', 'onChange' => '$("#langStripForm").submit();'])}}
            {{ Form::close() }}
            <a href="{{URL::route('strip.vote', array('comic_id' => $strips->comic_id, 'strip_id' => $strips->id, 'lang' => 'fr'))}}" class="btn btn-primary">
                    <i class="fa fa-comments-o fa-lg" style="padding-right: 5px;"></i> @lang('strip.other_translation')
            </a>
            <a href="{{URL::route('strip.translate', array('comic_id' => $strips->comic_id, 'strip_id' => $strips->id))}}" class="btn btn-primary">
                    <i class="fa fa-comments-o fa-lg" style="padding-right: 5px;"></i> @lang('strip.translate')
            </a>
	</div>
</div>
@stop
