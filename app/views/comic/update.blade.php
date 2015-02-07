@extends('layouts.master')

@section('master.content')

    <h1>{{($isAdd) ? Lang::get('comic.addTitle') : Lang::get('comic.updateTitle');}}</h1>
    
    @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif

    @if ($isAdd) 
        {{ Form::open(['method' => 'put', 'files' => true], ['class'=>'form']); }}
    @else 
        {{ Form::open(['route' => ['comic.update', $comic->id], 'method' => 'post', 'files' => true], ['class'=>'form']); }}
    @endif
   
    {{ Form::label('title', Lang::get('base.title'), ['class'=>'sr-only']); }}
    {{ Form::text('title', $comic->title, ['class'=>'form-control', 'placeholder' => Lang::get('base.title')]); }}
    {{ $errors->first('title', '<p class="alert alert-danger">:message</p>'); }}
    <br />
    {{ Form::label('description', Lang::get('comic.description'), ['class'=>'sr-only']); }}
    {{ Form::textarea('description', $comic->description, ['class'=>'form-control', 'placeholder' => Lang::get('comic.description')]); }}
    {{ $errors->first('description', '<p class="alert alert-danger">:message</p>'); }}
    <br />
    {{ Form::label('author', Lang::get('comic.author'), ['class'=>'sr-only']); }}
    {{ Form::text('author', $comic->author,['class'=>'form-control', 'placeholder' => Lang::get('comic.author')]); }}
    {{ $errors->first('author', '<p class="alert alert-danger">:message</p>'); }}
    <br />
    <label>
    {{ Form::checkbox('authorApproval', true, $comic->authorApproval); }}
    {{ Form::label('authorApproval', 'Je certifie être l\'auteur de cette bande dessinée ou bien, possèder l\'accord de son auteur.'); }}
    {{ $errors->first('authorApproval', '<p class="alert alert-danger">:message</p>'); }}
    </label>
    <br />
    {{ Form::label('cover', Lang::get('comic.cover')); }}
    {{ Form::file('cover', ['class'=>'filestyle']); }}
    {{ $errors->first('cover', '<p class="alert alert-danger">:message</p>'); }}
    <br />
    {{ Form::select('font_id', $fonts, $comic->font_id,['class'=>'form-control selectpicker']); }}
    {{ $errors->first('font_id', '<p class="alert alert-danger">:message</p>'); }}
    <br />
    {{ Form::submit(Lang::get($isAdd ? 'base.add' : 'base.update'),['class'=>'btn btn-lg btn-primary']); }}
    
    {{ Form::close(); }}
    
@stop