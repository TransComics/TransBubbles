@extends('user.loginout') @section('loginout.sign')
<div id="passwordReset" style="margin-top: 50px;"
	class="mainbox col-md-6 col-md-offset-2 col-sm-8 col-sm-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">@lang('login.passwordResetForm')</div>
		</div>
		<div style="padding-top: 30px" class="panel-body">
			@if(Session::has('error'))
			<div id="signupalert" class="alert alert-danger">
				<ul>
					<li>{{ Session::get('error') }}</li>
				</ul>
				<span></span>
			</div>
			@endif {{ Form::open(array('url'=>'password/reset','method' =>
			'post')) }} {{ Form::hidden('token', $token) }}
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				{{ Form::text('email', null, array('class'=>'form-control',
				'placeholder'=> Lang::get('login.email_adress'))) }}
			</div>
			{{ $errors->first("email") }}
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				{{ Form::password('password', array('class'=>'form-control',
				'placeholder'=> Lang::get('login.password'))) }}
			</div>

			{{ $errors->first("password") }}
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				{{ Form::password('password_confirmation',
				array('class'=>'form-control', 'placeholder'=>Lang::get('login.password_confirm')))
				}}
			</div>
			{{ $errors->first("password_confirmation") }}
			<div class="form-group">
				<!-- Button -->
				<div class="col-md-offset-3 col-md-9">
					{{ Form::submit(Lang::get('base.submit'), array('class'=>'btn btn-info'))}}
					<!-- <span style="margin-left: 8px;">or</span> -->
				</div>
			</div>
		</div>
	</div>
</div>

	{{ Form::close() }} @stop