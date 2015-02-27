 @extends('user.loginout') 
 @section('loginout.sign')
<div id="loginbox" style="margin-top: 50px;"
	class="mainbox col-md-6 col-md-offset-2 col-sm-8 col-sm-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">@lang('login.sign_in')</div>
			<div
				style="float: right; font-size: 80%; position: relative; top: -10px">
				<a href="{{ URL::to('password/remind') }}">@lang('login.forgot_password')</a>
			</div>
		</div>

		<div style="padding-top: 30px" class="panel-body">
			{{ Form::open(array('url'=>'login', 'class'=>'form-horizontal', 'id' => 'formsign')) }}
                        @if(Session::has('success'))
			<div id="signupalert" class="alert alert-success">
				<ul>
					<li>{{ Session::get('success') }}</li>
				</ul>
				<span></span>
			</div>
			@endif
			@if(Session::has('message'))
			<div id="signupalert" class="alert alert-danger">
				<ul>
					<li>{{ Session::get('message') }}</li>
				</ul>
				<span></span>
			</div>
			@endif
			<div style="margin-top: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				{{ Form::text('email', null, array('class'=>'form-control',
				'placeholder'=> Lang::get('login.email_adress'))) }}
			</div>

			<div style="margin-top: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				{{ Form::password('password', array('class'=>'form-control',
				'placeholder'=> Lang::get('login.password'))) }}
			</div>

			<div class="input-group">
				<div class="checkbox">
					<label> {{ Form::checkbox('remember', 1, null, ['id' =>
						'login-remember']) }} @lang('login.rememberme') </label>
				</div>
			</div>


			<div style="margin-top: 10px" class="form-group">
				<!-- Button -->

				<div class="col-sm-12 controls">
					{{ Form::submit(Lang::get('login.sign_in'), array('class'=>'btn
					btn-success'))}} 
					<!--<a id="btn-fblogin" href="#"
						class="btn btn-primary">@lang('login.facebook_log')</a>-->
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12 control">
					<div
						style="border-top: 1px solid #888; padding-top: 15px; font-size: 85%">
						@lang('login.no_account') <a href=" {{ URL::to('signup') }}">
							@lang('login.sign_up_here') </a>
					</div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop
@section('master.nav')
@stop
