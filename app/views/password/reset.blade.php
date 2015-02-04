<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
</head>
<body>
	{{ Form::open(array('url'=>'password/reset','method' => 'post')) }}
	{{ Form::hidden('token', $token) }}
    @if (Session::get("error"))
      {{ Session::get("error") }}<br />
    @endif
    {{ Form::label("email", "Email") }}
    {{ Form::text('email', null, array('class'=>'form-control',
	'placeholder'=> Lang::get('login.email_adress'))) }}
    {{ $errors->first("email") }}<br />
    {{ Form::label("password", "Password") }}
     {{ Form::password('password', array('class'=>'form-control',
	'placeholder'=> Lang::get('login.password'))) }} 
    {{ $errors->first("password") }}<br />
    {{ Form::label("password_confirmation", "Confirm") }}
    {{ Form::password('password_confirmation', array('class'=>'form-control',
	'placeholder'=>'Confirm Password')) }}
    {{ $errors->first("password_confirmation") }}<br />
    {{ Form::submit('Reset Password', array('class'=>'btn btn-info'))}}
    {{ Form::close() }}
</body>
</html>
