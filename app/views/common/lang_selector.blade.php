{{ Form::open(['route' => 'language.select', 'method' => 'post']); }}
{{ Form::submit('fr', ['name' => 'lang', 'class' => 'btn btn-default']) }}
{{ Form::submit('en', ['name' => 'lang', 'class' => 'btn btn-default']) }}
{{ Form::submit('de', ['name' => 'lang', 'class' => 'btn btn-default']) }}
{{ Form::close(); }}