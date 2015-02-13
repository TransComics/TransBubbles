@extends('layouts.tool')

@section('tool.title')
Interface de nettoyage
@stop

@section('tool.items')
    <div class="btn-group pull-right" role="group">
        <a class='btn btn-primary icon-undo' href="" id="undo"></a>
        <a class='btn btn-primary icon-redo' href="" id="redo"></a>
    </div>

    <div class="btn-group pull-right" role="group">
        <a class='btn btn-primary glyphicon glyphicon-zoom-out' href="" id="btnZoomOut"></a>
        <a class='btn btn-primary glyphicon glyphicon-zoom-in' href="" id="btnZoomIn"></a>
        <a class='btn btn-primary glyphicon glyphicon-search' href="" id="btnResetZoom"></a>
    </div>

    <div class="btn-group pull-right" role="group">
        <a class='btn btn-primary glyphicon glyphicon-eye-open' href="" id="viewAll"></a>
        <span class='btn btn-primary icon-selectAll' href="" id="selectAll"></span>
    </div>

    <div class="btn-group pull-right" role="group">
        <a class='btn btn-primary icon-rect' href="" id="rect"></a>
        <a class='btn btn-primary icon-circle' href="" id="circle"></a>
    </div>

    <div class="btn-group pull-right" role="group">
        <input class="btn btn-primary" style="height:34px;" type="color" name="colorPicker" id="colorPicker" value="#ffffff" />
        <input class="btn btn-primary" style="width:65px;" type="number" name="sizePicker" id="sizePicker" value="20" min="1" max="999" />
        <a class='btn btn-primary icon-brush' href="" id="brush"></a>
    </div>

    <div class="btn-group pull-right" role="group">
        <a class='btn btn-primary icon-update' href="" id="update"></a>
        <a class='btn btn-primary glyphicon glyphicon-trash' href="" id="del"></a>
    </div>

    <div class="btn-group pull" role="group">
        <a class='btn btn-primary glyphicon glyphicon-eye-open' href="" id="hidden-origin"> Cacher</a>
    </div>
@stop
    <div id="main">
        <table id="paint">
            <tr>
                <td class="origin-td">
                    <div class='origin'>
                        {{ HTML::image($strip->path, 'strip', array('id' => 'i')) }}
                    </div>
                </td>
                <td id="delivered">
                    <canvas id="c"></canvas>
                </td>
            </tr>
        </table>
    </div>
    {{ Form::open(['route' => ['strip.saveClean', $strip->id], 'method' => 'put', 'class'=>'form-horizontal', 'id' => 'saveCleanForm']) }}
    {{ Form::hidden('id', $shape->id) }}
    {{ Form::text('value', $shape->value, ['id' => 'cleanSave']) }}
    {{ Form::close() }}
@stop

@section('tool.nav')
    <a class='btn btn-primary glyphicon glyphicon-remove' href='' id='cancel'> Quitter</a>
    <a class='btn btn-primary glyphicon glyphicon-floppy-disk' href='' id='saveClean'> Terminer</a>
    <a class='btn btn-primary glyphicon glyphicon-floppy-disk' href='' id='nextStep'> Suivant</a>
@stop
