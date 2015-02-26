<script type="text/javascript">


    function duplicateItem(container) {
        var new_inputs = $(container.concat(' div:first-child')).clone();
        new_inputs.find('.bootstrap-filestyle').remove();
        new_inputs.find(':input').filestyle();
        new_inputs.find(':input').each(function () {
            this.value = '';
        });

        new_inputs.appendTo(container);
        checkForHidden();
    }

    function checkForHidden() {
        var style;
        if ($('.remove_strip_inputs').length > 1) {
            style = 'visible';
        } else {
            style = 'hidden';
        }

        $('.remove_strip_inputs').each(function () {
            $(this).css('visibility', style);
        });
    }

    function removeParent(item) {
        $(item).parent().remove();
        checkForHidden();
    }
</script>

@extends('layouts.master')

@section('master.content')
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif


<div class="text-center">
    <h1>{{(Route::currentRouteName() == "strip.create") ? Lang::get('strip.addTitle') : Lang::get('strip.updateTitle');}}</h1>
</div>


{{ Form::open(['route' => ['strip.store', $comic_id ], 'method' => 'post', 'files' => true, 'id' => 'stripForm', 'class' => 'form-horizontal']); }}
<div id="formContainer">
    <div>
        <br />
        <span onclick="removeParent(this)" style="visibility: hidden" class="remove_strip_inputs btn btn-danger btn-sm glyphicon glyphicon-remove"></span>
        <div class="form-group">
            {{ Form::label('titles[]', Lang::get('strip.title'), ['class'=>'col-sm-2 control-label', 'id' => 'label']); }}
            <div class="col-sm-10 ">
                {{ Form::text('titles[]', $strips->title, ['class'=>'form-control', 'placeholder' => Lang::get('strip.title')]); }}
                {{ $errors->first('title', '<p class="alert alert-danger">:message</p>'); }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('indexes[]', 'Index' , ['class' => 'col-sm-2 control-label']); }}
            <div class="col-sm-10">
                {{ Form::number('indexes[]', $index, ['class' => 'form-control']); }}
                {{ $errors->first('index', '<p class="alert alert-danger">:message</p>'); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('files[]', Lang::get('strip.stripFileSelector'), ['class'=>'col-sm-2 control-label', 'title' => Lang::get('strip.stripFileSelectorTitle')]); }}
            <div class="col-sm-10 ">
                {{ Form::file('files[]', array('class'=>'filestyle')) }}
                {{ $errors->first('strip', '<p class="alert alert-danger">:message</p>'); }}
            </div>
        </div>
    </div>
</div>

<br />

<div class="col-xs-2 col-xs-height col-bottom">
    <span onclick="duplicateItem('#formContainer')" class='btn btn-sm btn-primary glyphicon glyphicon-plus'></span>
</div>


<div class="btn-group pull-right" role="group">
    <a href="{{ URL::route('home') }}" class="btn btn-primary"> @lang('base.cancel') </a>
    {{ Form::submit(Lang::get((Route::currentRouteName() == "strip.create")? 'base.add' : 'base.update'),['class'=>'btn btn-primary']); }}
</div>
{{ Form::close(); }}
@stop
