@extends('layouts.tool')

@section('tool.title')
Interface de nettoyage
@stop

@section('tool.items')
    <div class="btn-group pull-right margin-5" role="group">
        <span class='btn btn-primary fa fa-undo' id="undo"></span>
        <span class='btn btn-primary fa fa-repeat' id="redo"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <span class='btn btn-primary fa fa-search-minus' id="btnZoomOut"></span>
        <span class='btn btn-primary fa fa-search-plus' id="btnZoomIn"></span>
        <span class='btn btn-primary fa fa-search' id="btnResetZoom"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-eye' href="" id="viewAll"></a>
        <span class='btn btn-primary fa fa-arrows' href="" id="selectAll"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-square-o' href="" id="rect"></a>
        <a class='btn btn-primary fa fa-circle-thin' href="" id="circle"></a>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <input class="btn btn-primary" style="height:37px;" type="color" name="colorPicker" id="colorPicker" value="#ffffff" />
        <input class="btn btn-primary" style="width:65px;height:37px;" type="number" name="sizePicker" id="sizePicker" value="20" min="1" max="999" />
        <a class='btn btn-primary fa fa-paint-brush' href="" id="brush"></a>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-location-arrow' href="" id="update"></a>
        <a class='btn btn-primary fa fa-trash' href="" id="del"></a>
    </div>

    <div class="btn-group pull margin-5" role="group">
        <a class='btn btn-primary fa fa-eye' href="" id="hidden-origin"> Cacher</a>
    </div>
@stop

@section('tool.content')
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
    
    <span id="interface" class="hidden">clean</span>
    <span id="canvasSave" class="hidden">{{$canvas_delivered}}</span>

    {{ Form::open(['route' => ['strip.saveClean', $strip->comic->id, $strip->id], 'method' => 'put', 'class'=>'form-horizontal', 'id' => 'saveCleanForm']) }}
    {{ Form::hidden('id', $shape->id) }}
    {{ Form::hidden('action', '', ['id' => 'saveCleanAction']) }}
    {{ Form::hidden('value', $shape->value, ['id' => 'cleanSave']) }}
    {{ Form::close() }}
@stop

@section('tool.nav')
    <a class='btn btn-primary fa fa-times' href='{{ URL::previous() }}' id='cancel'> Quitter</a>
    <a class='btn btn-primary fa fa-floppy-o' href='' id='saveClean'> Terminer</a>
    <a class='btn btn-primary fa fa-floppy-o' href='' id='nextStep'> Suivant</a>
@stop
