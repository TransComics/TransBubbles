@extends('layouts.master')
    
@section('master.content')
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    {{ Form::open(['route' => ['strip.store', $comic_id ], 'method' => 'post', 'files' => true, 'id' => 'stripForm', 'class' => 'form-horizontal']); }}
   
    <div class="text-center">
        <h1>{{(Route::currentRouteName() == "strip.create") ? Lang::get('strip.addTitle') : Lang::get('strip.updateTitle');}}</h1>
    </div>
       
    <br />
      
    <div class="form-group">
        {{ Form::label('title', Lang::get('strip.title'), ['class'=>'col-sm-2 control-label', 'id' => 'label']); }}
        <div class="col-sm-10 ">
            {{ Form::text('title', $strips->title, ['class'=>'form-control', 'placeholder' => Lang::get('strip.title')]); }}
            {{ $errors->first('title', '<p class="alert alert-danger">:message</p>'); }}
        </div>
    </div>
    
    <div class="form-group">
        {{ Form::label('strip_1', Lang::get('strip.stripFileSelector'), ['class'=>'col-sm-2 control-label', 'title' => Lang::get('strip.stripFileSelectorTitle')]); }}
        <div class="col-sm-10 ">
            {{ Form::file('strips[]', array('multiple'=>true, 'class'=>'filestyle')) }}
            {{ $errors->first('strip', '<p class="alert alert-danger">:message</p>'); }}
        </div>
    </div>
 
    <br />
    
    <div class="btn-group pull-right" role="group">
        <a href="{{ URL::route('home') }}" class="btn btn-primary"> @lang('base.cancel') </a>
        {{ Form::submit(Lang::get((Route::currentRouteName() == "strip.create")? 'base.add' : 'base.update'),['class'=>'btn btn-primary']); }}
    </div>
    {{ Form::close(); }}
@stop
