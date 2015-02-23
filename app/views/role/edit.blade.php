@extends('layouts.master') @section('master.content')
<div class="text-center center-block">
	<h3>@lang('role.update_role')</h3>
</div>
</br>
{{ Form::open(array('route'=>['private..roles.update', $role->id], 'method'=> 'PUT', 'role' => 'form')) }}

<div class="well">
	<div class="table-responsive">
		<table class="table table-hover" width="100%">
			<thead>
				<tr>
				    <th> {{ Form::label('name', Lang::get('role.name'), ['class'=>'control-label', 'id' => 'name']); }}</th>
					<th> {{ Form::label('create', Lang::get('role.create'), ['class'=>'control-label', 'id' => 'create']); }}</th>
					<th> {{ Form::label('read', Lang::get('role.read'), ['class'=>'control-label', 'id' => 'read']); }}</th>
					<th> {{ Form::label('update', Lang::get('role.update'), ['class'=>'control-label', 'id' => 'update']); }}</th>
					<th> {{ Form::label('moderate', Lang::get('role.moderate'), ['class'=>'control-label', 'id' => 'moderate']); }}</th>
					<th> {{ Form::label('delete', Lang::get('role.delete'), ['class'=>'control-label', 'id' => 'delete']); }}</th>
				</tr>
			</thead>
			<tbody>
			<tr>
			<td class="text-center">{{ Form::text('name','', ['class'=>'form-control', 'disabled' => 'disabled', 'placeholder' => $role->name]); }}
			{{ $errors->first('name', '<p class="alert alert-danger">:message</p>'); }}</td>
			<td class="text-center">{{ Form::checkbox('c', 'c', $role->C, ['id' =>'c']) }} </td>
			<td class="text-center">{{ Form::checkbox('r', 'r', $role->R, ['id' =>'r']) }} </td>
			<td class="text-center">{{ Form::checkbox('u', 'u', $role->U, ['id' =>'u']) }}</td>
			<td class="text-center">{{ Form::checkbox('m', 'm', $role->M, ['id' =>'m']) }}</td>
			<td class="text-center">{{ Form::checkbox('d', 'd', $role->D, ['id' =>'d']) }} </td>
			</tr>
			</tbody>
		</table>
		{{ Form::submit(Lang::get('role.update'), array('class'=>'btn btn-success pull-right'))}}
	</div>
	
	{{ Form::close() }}
</div>
@stop