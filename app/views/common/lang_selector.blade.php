{{ Form::open(['route' => 'language.select', 'method' => 'post','id' => 'langForm']); }}
{{ Form::hidden('lang', '', ['id' => 'langInput']) }}
<span class="pull-right lang-selector" role="group">
@foreach($languages as $lang)
    <span class="icon-lang icon-lang-32-{{$lang->shortcode}}" onclick="$('#langInput').val('{{$lang->shortcode}}');$('#langForm').submit();"></span>
@endforeach
</span>
{{ Form::close(); }}