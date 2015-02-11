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
    <div class="col-sm-6 col-md-4 thumbnail">
        <h3>{{ $strip->title }}</h3>
        {{ HTML::image($strip->path) }}
        <div class="caption">
            <p>
                {{ Form::open(['method' => 'put', 'class'=>'form-horizontal', 'id' => 'stripForm'.$strip->id]); }}
                {{ Form::hidden('_method', 'put', ['id' => '_method']); }}
                {{ Form::hidden('id', $strip->id, ['id' => $strip->id]); }}


                {{ Form::submit(Lang::get('strips.pendingApprobation'),['class'=>'btn btn-lg btn-primary']); }}
                <span class="btn btn-lg btn-primary" id ="{{$strip->id}}" onclick="$('#_method').val('DELETE');
                            $('#stripForm{{$strip->id}}').attr('action',
                      '{{ URL::route('strips.destroy', [$strip->id]) }}'); $('#stripForm{{ $strip->id }}').submit();"> @lang('strips.pendingDelete') 
                </span>

                {{ Form::close(); }}
            </p>
        </div>
    </div>
    @endforeach
</div>
@endif
@stop
