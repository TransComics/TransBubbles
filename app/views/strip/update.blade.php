@extends('layouts.master')

@section('master.content')

    <h1>{{($isAdd) ? Lang::get('strips.addTitle') : Lang::get('strips.updateTitle');}}</h1>
    
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    
    @if ($isAdd) 
        {{ Form::open(['method' => 'post', 'files' => true], ['class'=>'form-horizontal']); }}
    @else 
        {{ Form::open(['route' => ['strip.update'], 'method' => 'post', 'files' => true], ['class'=>'form']); }}
    @endif
   
    {{ Form::label('title', Lang::get('strips.title'), ['class'=>'sr-only']); }}
    {{ Form::text('title', null, ['class'=>'form-control', 'placeholder' => Lang::get('strips.title')]); }}
    {{ $errors->first('title', '<p class="alert alert-danger">:message</p>'); }}
    <br />
    {{ Form::label('strip', Lang::get('strips.stripFileSelector')); }}
    {{ Form::file('strip', ['class'=>'filestyle']); }}
    {{ $errors->first('strip', '<p class="alert alert-danger">:message</p>'); }}
    <br />
    <div class="btn-group" role="group">
        <a href="" class="btn btn-lg btn-primary"> @lang('base.delete') </a>
        <a href="{{ URL::route('home') }}" class="btn btn-lg btn-primary"> @lang('base.cancel') </a>
        {{ Form::submit(Lang::get($isAdd ? 'base.add' : 'base.update'),['class'=>'btn btn-lg btn-primary']); }}
    </div>
    {{ Form::close(); }}
    
@stop
