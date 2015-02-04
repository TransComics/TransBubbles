<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
</head>
<body>
	<h1>Password Reset</h1>
	@if (Session::has('error')) 
	{{ trans(Session::get('error')) }}
	@elseif(Session::has('status')) 
	{{ trans(Session::get('status')) }}
	@endif 
	{{ Form::open() }}
	<p>{{ Form::label('email', 'Email') }} {{ Form::text('email') }}</p>
	<p>{{ Form::submit('Submit') }}</p>
	{{ Form::close() }}
</body>
</html>