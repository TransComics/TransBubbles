@extends('layouts.master') @section('master.styles')
{{HTML::style('packages/silviomoreto-bootstrap-select/css/bootstrap-select.min.css')}}
@stop @section('master.scripts')
{{HTML::script('packages/silviomoreto-bootstrap-select/js/bootstrap-select.min.js')}}
{{HTML::script('js/ajaxTranslateRequest.js') }}
<script type="text/javascript">
    $(document).ready(function () {
        $(document).imageready(function () {
            var divHeight = $('#responsive_image').height();
            console.log(divHeight);
            $('#right').css('height', divHeight + 'px');
        });
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
            {{ Form::open(['route' => ['strip.lang'], 'method' => 'post', 'id' => 'langFormFrom', 'style' => 'display : inline;']) }}
            {{ Form::select('lang_id', $available_languages, $lang_strip,['class'=>'selectpicker','data-width'=>'auto', 'id'=>'langOrigin', 'onChange' => '$("#langFormFrom").submit();'])}}
            {{ Form::close() }}
        </div>
        <div class="col-xs-2 col-xs-height col-bottom">
            <a class="btn btn-primary pull-right fa fa-plus-square" title="strip.translate" href="{{URL::route('strip.translate', array('comic_id' => $strip->comic_id, 'strip_id' => $strip->id))}}"> @lang('vote.translate')</a>
        </div>
    </div>
</div>
<br />
<div class="col-sm-8" id="left">
    {{HTML::image($strip->path, 'strip', array('id' => 'responsive_image', 'class' => 'center-block img-responsive', 'style' => 'position:absolute; left:10000px;'))}}
    <div class="showCanvas text-right">
        <span class="showCanvas-json hidden">{{$canvas}}</span>
        <span class="showCanvas-height hidden">{{$canvas_height}}</span>
        <span class="showCanvas-width hidden">{{$canvas_width}}</span>
        <span class="id hidden">canvas-{{$bubble_id}}</span>
        <span class="img_id hidden">responsive_image</span>
        <canvas id="canvas-{{$bubble_id}}" class="showCanvas-canvas" width="706" height="283"></canvas>
    </div>
</div>
<div class="col-sm-4" id="right">
    <div class="btn-group" id="bubble">
        @foreach ($bubbles as $bubble)
        <a href="{{ URL::route('strip.vote', [$strip->comic_id ,$strip->id, $bubble->id])}}">
            @if($bubble->id == $bubble_id) 
                <label class="btn btn-default active">
            @else
                <label class="btn btn-default">
            @endif
                {{ HTML::image($strip->path, 'strip',array('id' => $bubble->id, 'class' =>'center-block', 'style' => 'width:100%;')) }}
            </label>
        </a>
        @endforeach
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-8 padding-10" id="ajax-response" ></div>
    {{ Form::open( array('route' => ['strip.postvote', $strip->id, $comic->id, 'style' => 'display:inline;'], 'method' => 'post','id' => 'form-vote'))}} 
        <div class="pull-right">    
            {{ Form::hidden('bubble_id', $bubble_id,['id' => 'bubble_id']) }} 
            {{ Form::hidden('user_id', Auth::id(),['id' => 'user_id']) }} 
            {{ Form::hidden('strip_id', $strip->id, ['id' => 'strip_id']) }} 
            {{ Form::hidden('lang_id', $lang_strip, ['id' => 'lang_id']) }}
            <a class="btn btn-default" title="strip.return" href="{{ URL::route('strip.show', [$strip->comic_id, $strip->id]) }}"> @lang('strip.return')</a>
            {{ Form::submit(Lang::get('strip.choose'), array('class'=>'btn btn-primary', 'id' => 'submitBubble'))}}
        </div>
    {{ Form::close() }}
</div>
@stop

