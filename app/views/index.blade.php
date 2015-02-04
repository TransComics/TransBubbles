@extends('layouts.master') @section('master.content')

@if(Auth::check())
@if(Auth::viaRemember())
<h1>@lang('base.welcome') back {{ Auth::user()->username}}</h1>
@else
<h1>@lang('base.welcome') {{ Auth::user()->username}}</h1>
@endif 
{{ Session::get('message') }} 
<p>{{ HTML::link('logout', 'logout') }}</p>
@else
<h1>@lang('base.welcome')</h1>
@endif 

@stop
