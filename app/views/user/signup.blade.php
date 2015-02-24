@extends('user.loginout') 

@section('loginout.sign')

<div id="signupbox" style="margin-top: 50px"
	class="mainbox col-md-6 col-md-offset-2 col-sm-8 col-sm-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">@lang('login.sign_up')</div>
			<div
				style="float: right; font-size: 85%; position: relative; top: -10px">
				<a id="signinlink" href="{{ URL::to('login') }}">@lang('login.sign_in')</a>
			</div>
		</div>
		<div class="panel-body">
			{{ Form::open(array('url'=>'signup', 'id' => 'formsign',
			'class'=>'form-horizontal')) }} @if($errors->has())
			<div id="signupalert" class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li> @endforeach
				</ul>
				<span></span>
			</div>
			@elseif(Session::has('success'))
			<div class="alert alert-success" role="alert">{{
				trans(Session::get('success')) }}</div>
			@endif

			<div style="margin-top: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				{{ Form::text('username', null, array('class'=>'form-control',
				'placeholder'=> Lang::get('login.login'))) }}
			</div>

			<div style="margin-top: 25px" class="input-group">
				<span class="input-group-addon"><i
					class="glyphicon glyphicon-envelope"></i></span>{{
				Form::text('email', null, array('class'=>'form-control',
				'placeholder'=> Lang::get('login.email_adress'))) }}
			</div>

			<div style="margin-top: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>{{
				Form::password('password', array('class'=>'form-control',
				'placeholder'=> Lang::get('login.password'))) }}
			</div>

			<div style="margin-top: 25px" class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				{{Form::password('password_confirmation',
				array('class'=>'form-control',
				'placeholder'=>Lang::get('login.password_confirm')))}}
			</div>

			<div class="form-group">
				<!-- Button -->
				<div class="col-md-offset-3 col-md-9" style="margin-top: 25px">
					{{ Form::submit(Lang::get('login.sign_up'), array('class'=>'btn
					btn-primary'))}}
					<!-- <span style="margin-left: 8px;">or</span> -->
				</div>
			</div>

			<!-- 	<div style="border-top: 1px solid #999; padding-top: 20px"
				class="form-group">

				<div class="col-md-offset-3 col-md-9">
					<button id="btn-fbsignup" type="button" class="btn btn-primary">
						<i class="icon-facebook"></i> Sign Up with Facebook
					</button>
				</div>

			</div> -->
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop 
@section('master.nav') @stop
