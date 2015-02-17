@extends('layouts.master') 

@section('master.scripts') 
{{HTML::script('packages/boostrap-table/js/jquery.dataTables.min.js')}}
<script type="text/javascript">
$(document).ready(function() {
    $('#tableData').dataTable( {
        "order": [[ 0, "asc" ]]
    } );

    $(".table-hover #click").click(function() {
        window.document.location = $(this).data("href");
    });
} );
</script>
@stop 
@section('master.content') 

@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<div class="row">
	<div class="row-same-height">
		<div class="col-xs-10 col-xs-height">
			<h3>Roles page index</h3>
		</div>
		<div class="col-xs-2 col-xs-height col-bottom">
			<a href="{{URL::route('private..roles.create')}}" title=@lang(
				'role.create')
				class='btn btn-sm btn-primary glyphicon glyphicon-plus'></a>
		</div>
	</div>
	</br>
	<div class="well">
		<div class="table-responsive">
			<table id="tableData" class="display table table-hover" width="100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Create</th>
						<th>Read</th>
						<th>Update</th>
						<th>Moderate</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($roles as $role)
					<tr id="click" class="clickable=row" data-href="/private/roles/{{$role->id}}">
						<td>{{$role->name}}</td>
						<td>{{$role->C}}</td>
						<td>{{$role->R}}</td>
						<td>{{$role->U}}</td>
						<td>{{$role->M}}</td>
						<td>{{$role->D}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
