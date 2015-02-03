@extends('users.loginout') @section('loginout.sign')




<div id="signupbox" style="margin-top: 50px"
	class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="panel-title">Sign Up</div>
			<div
				style="float: right; font-size: 85%; position: relative; top: -10px">
				<a id="signinlink" href="{{ URL::to('login') }}">Sign In</a>
			</div>
		</div>
		<div class="panel-body">

			{{ Form::open(array('url'=>'signup', 'class'=>'form-horizontal')) }}

			@if($errors->has())
			<div id="signupalert" class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li> 
					@endforeach
				</ul>
				<span></span>
			</div>
			@endif
			
			<div class="form-group">
				<label for="firstname" class="col-md-3 control-label">@lang('login.login')</label>
				<div class="col-md-9">{{ Form::text('login', null,
					array('class'=>'form-control', 'placeholder'=>
					Lang::get('login.login'))) }}</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-md-3 control-label">@lang('login.email')</label>
				<div class="col-md-9">{{ Form::text('email', null,
					array('class'=>'form-control', 'placeholder'=>
					Lang::get('login.email_adress'))) }}</div>
			</div>

			<div class="form-group">
				<label for="password" class="col-md-3 control-label">@lang('login.password')</label>
				<div class="col-md-9">{{ Form::password('password',
					array('class'=>'form-control', 'placeholder'=>
					Lang::get('login.password'))) }}</div>
			</div>

			<div class="form-group">
				<label for="password" class="col-md-3 control-label">Confirm
					Password</label>
				<div class="col-md-9">{{ Form::password('password_confirmation',
					array('class'=>'form-control', 'placeholder'=>'Confirm Password'))
					}}</div>
			</div>


			<div class="form-group">
				<!-- Button -->
				<div class="col-md-offset-3 col-md-9">
					{{ Form::submit(Lang::get('login.sign_up'), array('class'=>'btn
					btn-info'))}}
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
