{{ Form::open(['route' => 'language.select', 'method' => 'post','id' =>'langForm']); }} 
{{ Form::hidden('lang', '', ['id' => 'langInput']) }}
<ul class="nav navbar-nav navbar-right">
	@foreach($languages as $lang)
	<li>
	<a id="icon-lang" class="icon-lang-32-{{$lang->shortcode}}"
		onclick="$('#langInput').val('{{$lang->shortcode}}');$('#langForm').submit();"></a></li>
	@endforeach
</ul>
{{ Form::close(); }}
