@extends('layouts.master')

@section('master.content')
    @include('comic.form', ['isAdd' => false])
@stop