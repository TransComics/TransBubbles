@extends('layouts.master') @section('master.scripts')
{{HTML::script('packages/boostrap-table/js/jquery.dataTables.min.js')}}
<script type="text/javascript">
$(document).ready(function() {
    $('#tableData').dataTable( {
        "order": [[ 0, "asc" ]]
    } );
} );
</script>
@stop @section('master.content') @if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<div class="row">
	<div class="row-same-height">
		<div class="col-xs-10 col-xs-height">
			<h3>Role {{$role->name}}</h3>
		</div>
		<div class="col-xs-1 col-xs-height col-bottom">
			<a class="btn btn-primary" href="#">role.edit</a>
		</div>
		<div class="col-xs-1 col-xs-height col-bottom">
			<a class="btn btn-danger" href="#">role.delete</a>
		</div>
	</div>
</div>
<br />
<div class="row">
	<div class="well">
		<div class="table-responsive">
			<table id="tableData" class="display table table-hover" width="100%">
				<thead>
					<tr>
						<th>Username</th>
						<th>Ressource</th>
						<th>Ressource ID</th>
					</tr>
				</thead>
				<tbody>
					@foreach($role_ressources as $role_r)
					<tr>
						<td>{{ User::find($role_r->user_id)->username }}</td>
						@if($role_r->ressource)
						<td>{{$role_r->ressource}}</td> @else
						<td>@lang('role.all')</td> @endif @if($role_r->ressource_id)
						<td>{{$role_r->ressource_id}}</td> @else
						<td>@lang('role.all')</td> @endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
