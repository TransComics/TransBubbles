@extends('layouts.master')
@section('master.content')

<h1>{{ Lang::get('strips.pendingTitle')}}</h1>
<br/>
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

@if(empty($strips)) 
<!--TODO -->

@else
<div class="row">
    @foreach ($strips as $strip)
    <div class="col-sm-6 col-lg-4 padding-10">
        <div class="border padding-10">
            <div class="caption">
                <h3 class="one-line">{{ ($strip->title)? $strip->title : $strip->comic." ".$strip->id }}</h3>
            </div>
            {{ HTML::image($strip->path, 'strip', ['class' => 'img-responsive img-rounded', 'style' => 'overflow:hidden; width:250px; height:250px; display:block; margin:0 auto;']) }}
            <div class="caption">
                <p class="text-center">
                    <a class='btn btn-xs btn-primary glyphicon glyphicon-edit' href=""> @lang('strips.pendingApprobation')</a>
                    <a class='btn btn-xs btn-primary glyphicon glyphicon-edit' href="{{URL::route('strip.clean', ['id' => $strip->id])}}"> @lang('strips.pendingClean')</a>
                    <a class='btn btn-xs btn-primary glyphicon glyphicon-edit' href="{{URL::route('strip.translate', ['id' => $strip->id])}}"> @lang('strips.pendingTranslate')</a>
                </p>
                <p class="text-center">
                    {{ Form::open(['method' => 'put', 'class'=>'form-horizontal', 'id' => 'stripForm'.$strip->id]); }}
                        {{ Form::hidden('_method', 'put', ['id' => '_method']); }}
                        {{ Form::hidden('id', $strip->id, ['id' => $strip->id]); }}

                        {{ Form::submit(Lang::get('strips.pendingApprobation'),['class'=>'btn btn-xs  btn-primary']); }}
                        <a href="{{URL::route('strip.update', [$strip->id])}}" title="strip.update" class='btn btn-xs btn-primary glyphicon glyphicon-pencil'></a>
                        <span class="btn btn-xs  btn-primary" id ="{{$strip->id}}" onclick="$('#_method').val('DELETE');
                                    $('#stripForm{{$strip->id}}').attr('action',
                              '{{ URL::route('strip.destroy', [$strip->id]) }}'); $('#stripForm{{ $strip->id }}').submit();"> @lang('strips.pendingDelete') 
                        </span>

                    {{ Form::close(); }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@stop
