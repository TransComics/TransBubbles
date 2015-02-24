@extends('layouts.master')

@section('master.scripts')
<script type="text/javascript">
$(document).ready(function() {
	$('#submit').on('click',function() {
		$('#_method').val('DELETE'); 
		$('#comicForm').attr('action', '{{ URL::route('comic.destroy', [$comic->id]) }}'); 
		$('#comicForm').submit();
	});
});
</script>
@stop 

@section('master.content')
    @include('comic.form', ['isAdd' => false])
@stop

@section('master.nav')
@stop

@include('common.submit_delete')
