@extends('layouts.master')

@section('master.content')
	<div style="width: 50%;float:left">
	<img style="width: 100%" src="{{ $image }}" alt="image" />
	</div>
	<div style="width: 50%;float:right">
	<textarea style="color:black" cols="50" rows="10">
    {{ $text }}
    </textarea>
	</div>
    	
	@stop