@extends('layouts.master')

@section('master.content')
    <img src="images/ocrtemp/eng.xkcd.exp1.png" alt="image" />
    {{ Session::get('text') }}
    TEST
	@stop