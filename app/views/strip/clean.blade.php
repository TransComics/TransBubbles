@extends('layouts.tool')

@section('tool.title')
@lang('strip.cleanInterface')
@stop

@section('tool.items')
    <div class="btn-group pull-right margin-5" role="group">
        <span class='btn btn-primary fa fa-undo' id="undo" title="@lang('tool.undo')"></span>
        <span class='btn btn-primary fa fa-repeat' id="redo"  title="@lang('tool.redo')"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <span class='btn btn-primary fa fa-search-minus' id="btnZoomOut" title="@lang('tool.zoomOut')"></span>
        <span class='btn btn-primary fa fa-search-plus' id="btnZoomIn" title="@lang('tool.zoomIn')"></span>
        <span class='btn btn-primary fa fa-search' id="btnResetZoom" title="@lang('tool.zoomReset')"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-eye' href="" id="viewAll" title="@lang('tool.showAll')" ></a>
        <span class='btn btn-primary fa fa-arrows' href="" id="selectAll" title="@lang('tool.selectAll')"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-square-o' href="" id="rect" title="@lang('tool.rectangle')" ></a>
        <a class='btn btn-primary fa fa-circle-thin' href="" id="circle" title="@lang('tool.circle')" ></a>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-eyedropper' href="" title="@lang('tool.eyedropper')" id="eyedropper"></a>
        <input class="btn btn-primary" style="height:37px;" type="color" name="colorPicker" id="colorPicker" value="#ffffff"  title="@lang('tool.color')" />
        <input class="btn btn-primary" style="width:65px;height:37px;" type="number" name="sizePicker" id="sizePicker" value="20" min="1" max="999"  title="@lang('tool.brushSize')" />
        <a class='btn btn-primary fa fa-paint-brush' href="" id="brush" title="@lang('tool.brush')" ></a>

    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-location-arrow' href="" id="update" title="@lang('tool.select')" ></a>
        <a class='btn btn-primary fa fa-trash' href="" id="del" title="@lang('tool.trash')" ></a>
    </div>

    <div class="btn-group pull margin-5" role="group">
        <a class='btn btn-primary fa fa-eye' href="" id="hidden-origin"> @lang('tool.hide')</a>
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
    <a class='btn btn-primary fa fa-times' href='{{ URL::previous() }}' id='cancel'> @lang('base.quit')</a>
    <a class='btn btn-primary fa fa-floppy-o' href='' id='saveClean'> @lang('base.save')</a>
    <a class='btn btn-primary fa fa-floppy-o' href='' id='nextStep'> @lang('base.next')</a>
@stop
