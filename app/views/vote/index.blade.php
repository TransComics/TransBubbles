@extends('layouts.master') @section('master.styles')
{{HTML::style('packages/silviomoreto-bootstrap-select/css/bootstrap-select.min.css')}}
@stop @section('master.scripts')
{{HTML::script('packages/silviomoreto-bootstrap-select/js/bootstrap-select.min.js')}}
{{HTML::script('js/lib/json-jquery.js') }}
<script type="text/javascript">
    $(document).ready(function () {
        var divHeight = $('#left').height();
        console.log(divHeight);
        $('#right').css('height', divHeight + 'px');
    });
</script>
@stop @section('master.content') 


@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

<div class="row">
    <div class="page-header text-center center-block">
        <h3>Vote Page, please vote for the best translation ! :)</h3>
    </div>
    <div class="row-same-height">
        <div class="col-xs-10 col-xs-height">
            {{ Form::select('to', $languages->lists('label','shortcode') ,$lang,['class'=>'selectpicker btn-primary','data-width'=>'auto', 'id'=>'to']) }}
        </div>
        <div class="col-xs-2 col-xs-height col-bottom">
            <a class="btn btn-sm btn-primary glyphicon glyphicon-plus pull-right" title="strip.add" href=""></a>
        </div>
    </div>
</div>
<br />
<div class="col-sm-8" id="left">
    {{HTML::image($strip->path, 'strip', array('id' => 'responsive_image-'.$bubble_id, 'class' => 'thumbnail center-block img-responsive', 'style' => 'position:absolute; left:10000px;'))}}
    <div class="showCanvas text-right">
        <span class="showCanvas-json hidden">{{$canvas}}</span>
        <span class="showCanvas-height hidden">{{$canvas_height}}</span>
        <span class="showCanvas-width hidden">{{$canvas_width}}</span>
        <span class="id hidden">canvas-{{$bubble_id}}</span>
        <span class="img_id hidden">responsive_image-{{$bubble_id}}</span>
        <canvas id="canvas-{{$bubble_id}}" class="showCanvas-canvas" width="706" height="283"></canvas>
    </div>
</div>
<div class="col-sm-4" id="right">
    <div class="btn-group" id="bubble" data-toggle="buttons">
        @for ($i = 0; $i < 10; $i++)
            <label class="btn btn-default">
                <input type="radio" name="bubbleVote" id="bubbles{{$i}}" value={{$i}}>
                {{ HTML::image($strip->path, 'strip',array('id' => $i, 'class' =>'thumbnail center-block img-responsive'))}}
            </label> 
        @endfor
    </div>
</div>
<div class="row">
    <div class="col-md-9" id="ajax-response"></div>
    <div class="col-md-3">
        {{ Form::open( array('route' => ['strip.postvote', $strip->id, $comic->id ], 'method' => 'post','id' => 'form-vote'))}} 
            {{ Form::hidden('user_id', Auth::id(),['id' => 'user_id']) }} 
            {{ Form::hidden('strip_id', $strip->id, ['id' => 'strip_id']) }} 
            {{ Form::hidden('lang_id',$lang, ['id' => 'lang_id']) }} 
            {{ Form::submit(Lang::get('strip.choose'), array('class'=>'btn btn-primary text-center center-block', 'style' => 'margin-top: 10px;', 'id' => 'submitBubble'))}} 
        {{ Form::close() }}
    </div>
</div>
@stop

