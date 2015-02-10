@extends('layouts.master')
@section('master.content')

<h1>TITLE TO CHANGE</h1>

@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

<div class="row">
    @foreach ($strips as $strip)
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            {{ HTML::image($strip->path) }}
            <div class="caption">
                <h3>{{ $strip->title }}</h3>
                <p><a href="#" class="btn btn-primary" role="button">Valider</a> <a href="#" class="btn btn-default" role="button">Rejeter</a></p>
            </div>
        </div>
    </div>
    @endforeach
</div>


<div class="btn-group" role="group">
    <a href="{{ URL::route('home') }}" class="btn btn-lg btn-primary"> @lang('base.cancel') </a>
</div>
{{ Form::close(); }}

@stop
