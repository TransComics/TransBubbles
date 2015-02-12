@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

@if (Route::currentRouteName() == "strip.create") 
{{ Form::open(['method' => 'post', 'files' => true, 'class'=>'form-horizontal', 'id' => 'stripForm']); }}
@else 
{{ Form::open(['method' => 'put', 'files' => true, 'class'=>'form-horizontal', 'id' => 'stripForm']); }}
{{ Form::hidden('_method', 'put', ['id' => '_method']); }}
@endif

<div class="form-group text-center">
    <h1>{{(Route::currentRouteName() == "strip.create") ? Lang::get('strip.addTitle') : Lang::get('strip.updateTitle');}}</h1>
</div>

<div class="form-group">
{{ Form::label('title', Lang::get('strip.title'), ['class'=>'col-sm-2 control-label']); }}
    <div class="col-sm-10">
    {{ Form::text('title', $strips->title, ['class'=>'form-control', 'placeholder' => Lang::get('strip.title')]); }}
    {{ $errors->first('title', '<p class="alert alert-danger">:message</p>'); }}
    </div>
</div>

@if (Route::currentRouteName() == "strip.create")
    <div class="form-group">
    {{ Form::label('strip', Lang::get('strip.stripFileSelector'), ['class'=>'col-sm-2 control-label']); }}
        <div class="col-sm-10">
        {{ Form::file('strip', ['class'=>'filestyle']); }}
        {{ $errors->first('strip', '<p class="alert alert-danger">:message</p>'); }}
        </div>
    </div>
@else
<div class="form-group text-center">
       {{ HTML::image($strips->path, '', array('class' => 'img-thumbnail')) }}
</div>

@endif
<br />

<div class="btn-group pull-right" role="group">
    @if (Route::currentRouteName() == "strip.edit")
    <span class="btn btn-primary" onclick="$('#_method').val('DELETE'); $('#stripForm').attr('action',
          '{{ URL::route('strip.destroy', [$strips->id]) }}'); $('#stripForm').submit();"> @lang('base.delete') </span>
    @endif
    <a href="{{ URL::route('home') }}" class="btn btn-primary"> @lang('base.cancel') </a>
    {{ Form::submit(Lang::get((Route::currentRouteName() == "strip.create")? 'base.add' : 'base.update'),['class'=>'btn btn-primary']); }}
</div>
{{ Form::close(); }}