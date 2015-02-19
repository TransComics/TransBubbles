@extends('layouts.master')

@section('master.content')
    @include('comic.form', ['isAdd' => true])
@stop

@section('master.nav')
@stop
