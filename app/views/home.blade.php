@extends('layouts.master')

@section('master.content')
    
    <h1> Home </h1>
    <hr/>

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


@section('master.nav')
    <div class="list-group">
        @if(Auth::check())
            <a href="{{URL::route('user.logout')}}" class="list-group-item" >@lang('user.logout')</a>
        @else
            <a href="{{URL::route('user.signin')}}" class="list-group-item" >@lang('user.signIn')</a>
        @endif
        <a href="{{URL::route('comic.add')}}" class="list-group-item" >@lang('comic.addLink')</a>
        <a href="{{URL::route('comics.list')}}" class="list-group-item" >@lang('comics.listLink')</a>
    </div>
@stop