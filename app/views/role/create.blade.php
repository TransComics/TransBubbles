@extends('layouts.master') @section('master.content')
<div class="text-center center-block">
	<h3>@lang('role.create_new_role')</h3>
</div>
</br>
{{ Form::open(array('route'=>'private..roles.store', 'role' => 'form')) }}

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
			<td class="text-center">{{ Form::text('name','', ['class'=>'form-control', 'placeholder' => Lang::get('role.name')]); }}
			{{ $errors->first('name', '<p class="alert alert-danger">:message</p>'); }}</td>
			<td class="text-center">{{ Form::checkbox('create', 1, null, ['id' =>'c']) }} </td>
			<td class="text-center">{{ Form::checkbox('read', 1, null, ['id' =>'r']) }} </td>
			<td class="text-center">{{ Form::checkbox('update', 1, null, ['id' =>'u']) }}</td>
			<td class="text-center">{{ Form::checkbox('moderate', 1, null, ['id' =>'m']) }}</td>
			<td class="text-center">{{ Form::checkbox('delete', 1, null, ['id' =>'d']) }} </td>
			</tr>
			</tbody>
		</table>
		{{ Form::submit(Lang::get('role.validate'), array('class'=>'btn btn-success pull-right'))}}
	</div>
	
	{{ Form::close() }}
</div>
@stop
