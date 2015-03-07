@section('master.scripts')
<script type="text/javascript">
$(document).ready(function() {
    $(".btn-danger-2").on('click', function(e){
        var $id = $(this).attr('id');
        $('input#inputB').val($id);
    });
    $('#submit').on('click', function(e){
        $form = "#stripForm" + $('input#inputB').val();
        $($form).submit();
    });
});
</script>
@stop 

@extends('layouts.master') @section('master.content')

<div class="row">
    <div class="row-same-height">
        <div class="col-xs-10 col-xs-height">
            <h1>{{$comic->title}}</h1>
        </div>
        @if(Auth::check())
        <div class="col-xs-2 col-xs-height col-bottom">
            <a href="{{URL::route('strip.create', [$comic->id])}}" title="@lang('strip.importLink')" class='btn btn-sm btn-primary glyphicon glyphicon-plus'></a>
        </div>
        @endif
    </div>
</div>
<br />
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif 
@if(empty($strips))
<!--TODO -->

@else
<div class="text-center">
    {{ $strips->links(); }}
</div>
<div class="row">
    @foreach ($strips as $strip)
    <div class="col-sm-6 col-lg-4 padding-10">
        <div class="border thumbnail padding-10">
            @if($strip->isShowable)
                <a href="{{ route('strip.show',[ $strip->comic->id, $strip->id]) }}">
            @endif
            <div class="caption">
                <h3 class="one-line">
                    {{ ($strip->title)? $strip->title : $strip->comic." ".$strip->id }} 
                </h3>
            </div>
           <!--  {{  HTML::image($strip->path, 'strip', ['class' => 'img-responsive
                img-rounded', 'style' => 'overflow:hidden; width:250px;
                height:250px; display:block; margin:0 auto; img-responsive']) }}-->
           <img src="{{ Image::path($strip->path, 'resizeCrop', 250, 350) }}"  alt="{{$strip->title}}" 
           class="img-responsive img-rounded" style="overflow:hidden; width:250px;
                height:250px; display:block; margin:0 auto;"/>
                       
            @if($strip->isShowable)
                </a>
            @endif
            
            @if (Auth::check())
            <div class="caption">
                {{ Form::open(['route' => ['strip.destroy', $strip->comic->id, $strip->id], 'method' => 'delete', 'class'=>'form-horizontal', 'id' => 'stripForm'.$strip->id]); }}
                {{ Form::hidden('id', $strip->id); }}
                                
                <!-- Small button group -->
                <div class="btn-group">
                    <button class="btn btn-default btn-sm dropdown-toggle"
                            type="button" data-toggle="dropdown" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @if($strip->isCleanable())
                        <li><a
                                href="{{URL::route('strip.clean', [$strip->comic->id, $strip->id])}}">
                                @lang('strip.pendingClean')</a></li>
                        @endif
                        @if($strip->isImportable())
                        <li><a
                                href="{{URL::route('strip.import', [$strip->comic->id, $strip->id])}}">
                                @lang('strip.import')</a></li>
                        @endif
                        @if($strip->isTranslateable())
                        <li><a
                                href="{{URL::route('strip.translate', [$strip->comic->id, $strip->id])}}">
                                @lang('strip.pendingTranslate')</a></li>
                        @endif
                        <li class="divider"></li>
                        <!--<li><a href="" onclick="$('#stripForm{{ $strip->id }}').submit(); return false;"> @lang('strip.pendingApprobation') </a></li>-->
                        <li>
                            <a href="" id="{{$strip->id}}" data-toggle="modal" data-target="#confirm-submit" class="btn-danger-2">
                                @lang('base.delete')
                            </a>
                        </li>
                        <li><a href="{{URL::route('strip.edit', [$strip->comic->id, $strip->id])}}" title="@lang('strip.editLink')">@lang('strip.editLink')</a></li>
                    </ul>
                </div>
                {{ Form::close(); }}
            </div>
            @endif
        </div>
    </div>
    @endforeach
    <div class="text-center">
        {{ $strips->links(); }}
    </div>
</div>
@include('common.submit_delete')
@endif 
@stop

@section('master.nav')
    @parent
    @include('common.moderate_nav')
@append