<h1>Demo for Translator PHP Wrapper</h1>

<div id="showdata"></div>
{{ Form::open(['class'=>'form-horizontal']) }}
<div class="form-group">
	{{ Form::label('description', 'Text to translate', ['class'=>'col-sm-2
	control-label']); }}
	<div class="col-sm-2">{{ Form::textarea('txtString', null, ['id'
		=>'txtString','class'=>'form-control', 'placeholder' => 'Text to translate']); }}</div>
</div>
<div class="form-group">
	{{ Form::label('language', 'Language', ['class'=>'col-sm-2
	control-label']); }}
	<div class="col-sm-2">{{ Form::select('txtLang', ['fr' => 'fr','en' =>
		'en'], null, ['class' => 'form-control', 'id' => 'txtLang']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('api', 'API', ['class'=>'col-sm-2 control-label']); }}
	<div class="col-sm-2">{{ Form::select('api', ['google' => 'Google
		Translate','bing' => 'Bing Translate'], null, ['class' =>
		'form-control', 'id' => 'api']) }}</div>
</div>
<div class="btn-group pull-left" role="group">
	<a class="btn btn-lg btn-primary" id="getdata-button"> Translate </a>
</div>
<div id="loader">&nbsp;</div>
{{ Form::close() }}