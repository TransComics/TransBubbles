{{ Form::open(['route' => 'language.select', 'method' => 'post']); }}
@foreach($languages as $lang)
{{ Form::submit($lang->id, ['name' => 'lang', 'class' => 'btn btn-default']) }}
@endforeach
{{ Form::close(); }}