@extends('layouts.html')

@section('html.styles')
{{ HTML::style('packages/bootstrap-3.3.2-dist/css/bootstrap.css') }} 
@stop

@section('html.scripts')
{{ HTML::script('js/lib/jquery-2.1.3.min.js') }}
{{ HTML::script('packages/bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
@stop

@section('html.content')
	
    @yield('master.content')

@stop