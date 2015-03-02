@extends('layouts.master') @section('master.content')

@section('master.scripts')
{{ HTML::script('js/popularities.js') }} 
@stop

<h1>{{ $strips->title }}</h1>
<div class="text-center center-block">
    <small>@lang('strip.dateUpdated') {{ $strips->updated_at }} - 
        @lang('comic.imported',['imported'=> $strips->user->username]) 
        @if(!$isTheOriginal)
            - @lang('strip.translated_by',['imported'=> $bubble_user])
        @endif</small>
</div>
<hr>
<div class="text-center center-block">
    {{HTML::image($strips->path, 'strip', array('id' => 'responsive_image-'.$bubble_id, 'class' => 'img-responsive', 'style' => 'position:absolute; left:10000px;'))}}

    <div class="showCanvas text-right">
        <span class="showCanvas-json hidden">{{$canvas}}</span>
        <span class="showCanvas-height hidden">{{$canvas_height}}</span>
        <span class="showCanvas-width hidden">{{$canvas_width}}</span>
        <span class="id hidden">canvas-{{$bubble_id}}</span>
        <span class="img_id hidden">responsive_image-{{$bubble_id}}</span>
        <canvas id="canvas-{{$bubble_id}}" class="showCanvas-canvas" width="706" height="283"></canvas>
    </div>
    <br />
        
    <!--STRIP NAVIGATION-->
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
    
    <br />
    <br />
    
    <!--SOCIAL SHARING-->
    <div class="btn-group" role="group">
        <a class='btn btn-primary' href="http://www.facebook.com/share.php?u={{URL::full()}}" onclick="return !window.open(this.href, 'Facebook', 'width=500,height=500')" target="_blank">
            <i class="fa fa-facebook"></i></a>
        <a class='btn btn-primary' href="http://twitter.com/share?url={{URL::full()}}"  onclick="return !window.open(this.href, 'Twitter', 'width=500,height=500')" target="_blank">
            <i class="fa fa-twitter"></i>
        </a>
        <a class='btn btn-primary' href="https://plus.google.com/share?url={{URL::full()}}" onclick="return !window.open(this.href, 'Google', 'width=500,height=500')" target="_blank">
            <i class="fa fa-google-plus"></i>
        </a>
    </div>

    <!--BOOKMARK,VOTE UP & DOWN-->
    <div class="btn-group popularity-group" role="group">
        <button class="btn btn-primary glyphicon glyphicon-thumbs-up popularities" id="{{$popularity->id }}" >
            <span style="margin-left: 5px; top: 0px;" class="badge">{{ $popularity->vote_up }}</span>
        </button>
        <button class="btn btn-primary glyphicon glyphicon glyphicon-thumbs-down popularities" id="{{$popularity->id }}">
            <span style="margin-left: 5px; top: 0px;" class="badge">{{ $popularity->vote_down }}</span>
        </button>
    </div>
    
    <br />
    <br />
    
    <!--STRIP LIST & TRANSLATIONS-->
    <div class="btn-group" role="group">
            <a href="{{URL::route('strip.index', array('comic_id' => $strips->comic_id))}}" class="btn btn-primary"><i class="glyphicon glyphicon-th"></i> @lang('strip.viewAll')</a>
    </div>
    
        <div class="btn-group" role="group">
            @if(!$isTheOriginal)
                @if(Auth::check())
                <a href="{{URL::route('strip.vote', array($strips->comic_id, $strips->id, $bubble_id))}}" class="btn btn-primary">
                        <i class="fa fa-comments-o fa-lg" style="padding-right: 5px;"></i> @lang('strip.other_translation')
                </a>
                @else
                <span class="helper" data-toggle="tooltip" title="@lang('strip.signin_action')">
                <a disabled="disabled"  class="btn btn-primary">
                        <i class="fa fa-comments-o fa-lg" style="padding-right: 5px;"></i> @lang('strip.other_translation')
                </a>
                </span>
                @endif
            @endif
            @if(Auth::check())
            <a href="{{URL::route('strip.translate', array('comic_id' => $strips->comic_id, 'strip_id' => $strips->id))}}" class="btn btn-primary">
                    <i class="fa fa-comments-o fa-lg" style="padding-right: 5px;"></i> @lang('strip.translate')
            </a>
            @else
            <span class="helper" data-toggle="tooltip" title="@lang('strip.signin_action')">
            <a disabled="disabled"  class="btn btn-primary">
                    <i class="fa fa-comments-o fa-lg" style="padding-right: 5px;"></i> @lang('strip.translate')
            </a>
            </span>
            @endif
        </div>
    
    <div class="btn-group" role="group">
            {{ Form::open(['route' => ['strip.lang'], 'method' => 'post', 'id' => 'langStripForm', 'style' => 'display : inline;']) }}
        {{ Form::select('lang_id', $available_languages, $lang_strip,['class'=>'btn btn-primary','data-width'=>'auto', 'onChange' => '$("#langStripForm").submit();'])}}
        {{ Form::close() }}
    </div>
</div>
@stop
