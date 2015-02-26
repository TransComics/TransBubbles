@extends('layouts.master') @section('master.scripts')
{{HTML::script('packages/boostrap-table/js/jquery.dataTables.min.js')}}
<script type="text/javascript">
$(document).ready(function() {
	var clicked = 0;
    $('#tableData').dataTable( {
        "order": [[ 0, "asc" ]]
    } );
    $(".table-hover #click td:not(:last-child)").click(function() {
        window.document.location = $(this).data("href");
    });  
    
    $(".btn-danger").on('click', function(e){
        var $id = $(this).attr('id')
        $('input#inputB').val($id);
    });

    $('#submit').on('click', function(e){
        $form = "#form" + $('input#inputB').val();
        $($form).submit();
    });
    
} );
</script>
@stop 
@section('master.content')
@if(Session::has('message'))
<p class="alert alert-info alert-dismissible">{{ Session::get('message') }}</p>
@endif

<div class="row">
	<div class="row-same-height">
		<div class="col-xs-10 col-xs-height">
			<h3>@lang('role.index')</h3>		
			<a href="{{URL::route('private..roles.create')}}" title=@lang('role.create') class='btn btn-sm btn-primary glyphicon glyphicon-plus pull-right col-bottom'></a>
		</div>
		
		
	</div>
	</br>
</div>
<div class="row">
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
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($roles as $role)				
					<tr id="click" class="clickable-row" style="cursor: pointer;"
						data-href="/private/roles/{{$role->id}}">
						<td class="text-center" data-href="/private/roles/{{$role->id}}">{{$role->name}}</td>
						<td class="text-center" data-href="/private/roles/{{$role->id}}">{{$role->C ? Lang::get('base.yes') : Lang::get('base.no')}}</td>
						<td class="text-center" data-href="/private/roles/{{$role->id}}">{{$role->R ? Lang::get('base.yes') : Lang::get('base.no')}}</td>
						<td class="text-center" data-href="/private/roles/{{$role->id}}">{{$role->U ? Lang::get('base.yes') : Lang::get('base.no')}}</td>
						<td class="text-center" data-href="/private/roles/{{$role->id}}">{{$role->M ? Lang::get('base.yes') : Lang::get('base.no')}}</td>
						<td class="text-center" data-href="/private/roles/{{$role->id}}">{{$role->D ? Lang::get('base.yes') : Lang::get('base.no')}}</td>
					    <td class="text-center"> 
					    {{ Form::open(['route' => ['private..roles.destroy', $role->id], 'method' => 'delete', 'id' =>'form'.$role->id ]); }}
					           <span class="btn-group" role="group"> 
					          {{ HTML::linkRoute('private..roles.edit', '', array($role->id), array('class' => 'btn btn-primary btn-xs glyphicon glyphicon-pencil')) }}
						      <a title=@lang('base.delete') data-toggle="modal" data-target="#confirm-submit" data-href={{$role->id}} class='btn btn-danger btn-xs glyphicon glyphicon-remove' id={{$role->id}}></a>
						      </span>
						{{ Form::close();}}
						      </td>
					</tr>
					
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@include('common.submit_delete')
@stop
