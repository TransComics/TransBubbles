@extends('user.loginout') @section('loginout.sign')
<div id="passwordReset" style="margin-top: 50px;"
	class="mainbox col-md-6 col-md-offset-2 col-sm-8 col-sm-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">@lang('login.passwordReset')</div>
		</div>
		<div style="padding-top: 30px" class="panel-body">
			<div style="display: none" id="login-alert"
				class="alert alert-danger col-sm-12"></div>
			@if(Session::has('error'))
			<div id="signupalert" class="alert alert-danger">
				<ul>
					<li>{{ Session::get('error') }}</li>
				</ul>
				<span></span>
			</div>
			@elseif(Session::has('status'))
			<div class="alert alert-success" role="alert">{{
				trans(Session::get('status')) }}</div>
			@endif {{ Form::open() }}
			<div style="margin-bottom: 25px" class="input-group">
				<span class="input-group-addon"><i
					class="glyphicon glyphicon-envelope"></i></span> {{
				Form::text('email', null, array('class'=>'form-control',
				'placeholder'=> Lang::get('login.email_adress'))) }}
			</div>

			<div style="margin-top: 10px" class="form-group">
				<!-- Button -->

				<div class="col-sm-12 controls">{{ Form::submit(Lang::get('base.submit'),
					array('class'=>'btn btn-success'))}}</div>
			</div>

			{{ Form::close() }}
		</div>
	</div>
</div>
@stop
