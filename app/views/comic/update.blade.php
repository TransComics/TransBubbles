@extends('layouts.master')

@section('master.content')
    
    <h1>{{($isAdd) ? Lang::get('comic.addTitle') : Lang::get('comic.updateTitle');}}</h1>
    
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    @if ($isAdd) 
        {{ Form::open(['method' => 'put', 'files' => true], ['class'=>'form-horizontal']); }}
    @else 
        {{ Form::open(['route' => ['comic.update', $comic->id], 'method' => 'post', 'files' => true], ['class'=>'form-horizontal']); }}
    @endif
    <br />
    {{ HTML::image($comic->cover, 'cover', array('width' => '846', 'height' => '170', 'class' => 'img-thumbnail')) }}
    <div class="form-group">
        {{ Form::label('title', Lang::get('base.title'), ['class'=>'col-sm-2 control-label']); }}
        <div class="col-sm-10">
            {{ Form::text('title', $comic->title, ['class'=>'form-control', 'placeholder' => Lang::get('base.title')]); }}
            {{ $errors->first('title', '<p class="alert alert-danger">:message</p>'); }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('description', Lang::get('comic.description'), ['class'=>'col-sm-2 control-label']); }}
        <div class="col-sm-10">
            {{ Form::textarea('description', $comic->description, ['class'=>'form-control', 'placeholder' => Lang::get('comic.description')]); }}
            {{ $errors->first('description', '<p class="alert alert-danger">:message</p>'); }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('author', Lang::get('comic.author'), ['class'=>'col-sm-2 control-label']); }}
        <div class="col-sm-10">
            {{ Form::text('author', $comic->author,['class'=>'form-control', 'placeholder' => Lang::get('comic.author')]); }}
            {{ $errors->first('author', '<p class="alert alert-danger">:message</p>'); }}
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label"></span>
        <div class="col-sm-10">
            {{ Form::checkbox('authorApproval', true, $comic->authorApproval); }}
            {{ Form::label('authorApproval', 'Je certifie être l\'auteur de cette bande dessinée ou bien, possèder l\'accord de son auteur.'); }}
            {{ $errors->first('authorApproval', '<p class="alert alert-danger">:message</p>'); }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('cover', Lang::get('comic.cover'), ['class'=>'col-sm-2 control-label']); }}
        <div class="col-sm-10">
            {{ Form::file('cover', ['class'=>'filestyle']); }}
            {{ $errors->first('cover', '<p class="alert alert-danger">:message</p>'); }}
            <p class="help-block">@lang('comic.helpCover')</p>
        </div>
    </div>
    <br/>
    <div class="form-group">
        {{ Form::label('font_id', Lang::get('comic.font'), ['class'=>'col-sm-2 control-label']); }}
        <div class="col-sm-10">
            {{ Form::select('font_id', $fonts, $comic->font_id,['class'=>'form-control selectpicker']); }}
            {{ $errors->first('font_id', '<p class="alert alert-danger">:message</p>'); }}
        </div>
    </div>
    <br />
    <div class="btn-group" role="group">
        <a href="" class="btn btn-lg btn-primary"> @lang('base.delete') </a>
        <a href="{{ URL::route('home') }}" class="btn btn-lg btn-primary"> @lang('base.cancel') </a>
        {{ Form::submit(Lang::get($isAdd ? 'base.add' : 'base.update'),['class'=>'btn btn-lg btn-primary']); }}
    </div>
    {{ Form::close(); }}
    
@stop
