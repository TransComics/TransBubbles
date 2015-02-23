@extends('layouts.master')

@section('master.content')
    
<div class="jumbotron">
  <h1>Transbubbles</h1>
  <p>Welcome to Transbubbles website !</p>
</div>

    @if(Auth::check())
        @if(Auth::viaRemember())
            <p>@lang('base.welcome') back {{ Auth::user()->username}}</p>
        @else
            <p>@lang('base.welcome') {{ Auth::user()->username}}</p>
        @endif 
        {{ Session::get('message') }} 
        <p>{{ HTML::link('logout', 'logout') }}</p>
    @else
        <p>@lang('base.welcome')</p>
    @endif 
@stop
