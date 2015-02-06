@extends('layouts.master')

@section('master.content')

    <h1>{{($isAdd)? '@lang(comic.addTitle)' : '@lang(comic.updateTitle)'}}</h1>
    
    @if(Session::has('message'))
        <p>{{ Session::get('message') }}</p>
    @endif
    
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach

    @if ($isAdd) 
        {{ Form::open(['method' => 'put']); }}
    @else 
        {{ Form::open(['route' => ['comic.update', $comic->id], 'method' => 'post']); }}
    @endif
    
    <div class="form-group">
        {{ Form::label('title', Lang::get('base.title')); }}
        {{ Form::text('title', $comic->title, ['class'=>'form-control']); }}
    </div>
    <div class="form-group">
        {{ Form::label('author', Lang::get('comic.author')); }}
        {{ Form::text('author', $comic->author,['class'=>'form-control']); }}
    </div>
    <div class="form-group">
        {{ Form::label('description', Lang::get('comic.description')); }}
        {{ Form::textarea('description', $comic->description, ['class'=>'form-control']); }}
    </div>
    
    {{ Form::submit(Lang::get($isAdd ? 'base.add' : 'base.update'),['class'=>'btn btn-default']); }}
 
    {{ Form::close(); }}
    
@stop