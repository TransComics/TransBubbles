@extends('layouts.tool')

@section('tool.title')
	Interface de traduction
@stop
@section('tool.scripts')
{{HTML::script('js/lib/json-jquery.js') }} 
@stop 

@section('tool.items')
    
    {{ Form::select('from', ['en' => 'English'], 1,['class'=>'btn btn-primary glyphicon glyphicon-globev', 'id'=>'from'])}}
    <span class='glyphicon glyphicon-arrow-right'></span>
    {{ Form::select('fontPicker', $languages->lists('label','shortcode') ,1,['class'=>'btn btn-primary glyphicon glyphicon-globe', 'id'=>'to']) }}
    

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
        <span class='btn btn-primary glyphicon glyphicon-align-left' id="alignLeft"></span>
        <span class='btn btn-primary glyphicon glyphicon-align-center' id="alignCenter"></span>
        <span class='btn btn-primary glyphicon glyphicon-align-right' id="alignRight"></span>
        <span class='btn btn-primary glyphicon glyphicon-align-justify' id="alignJustify"></span>
    </div>

    <div class="btn-group pull-right" role="group">
        <span class='btn btn-primary glyphicon glyphicon-bold' id="textBold"></span>
        <span class='btn btn-primary glyphicon glyphicon-italic' id="textItalic"></span>
        <span class='btn btn-primary' id="textUnderline">Underline</span>
        <span class='btn btn-primary' id="textLineThrough">Line-Through</span>
    </div>

    <div class="btn-group pull-right" role="group">
	<a class='btn btn-primary icon-update' href="" id="update"></a>
	<a class='btn btn-primary glyphicon glyphicon-trash' href="" id="del"></a>
	<a class='btn btn-primary icon-text' href="" id="text"></a>
        <input class="btn btn-primary" style="height:34px;" type="color" name="colorPickerText" id="colorPickerText" value="#000000" />
	<input class="btn btn-primary" style="height:34px;" type="color" name="colorPickerBackground" id="colorPickerBackground" value="#ffffff" />
        <input class="btn btn-primary" style="width:65px;" type="number" name="sizePickerText" id="sizePickerText" value="20" min="1" max="999" />
        
        {{ Form::select('fontPicker', $fonts, 1,['class'=>'btn btn-primary', 'id'=>'fontPicker']); }}
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
                                    <canvas id="c" width="706" height="283"></canvas>
                            </td>
                    </tr>
            </table>
    </div>

    <br/>
    <!-- Button trigger modal -->
    <button id="getdata" type="button" class="btn btn-primary btn-lg"
            data-toggle="modal" data-target="#myModal">Launch demo popup</button>
    @include('translate.popup')
    
    <span id="canvasSave" class="">{{$canvas_delivered}}</span>
    
    {{ Form::open(['route' => ['strip.saveImport', $strip->comic->id, $strip->id], 'method' => 'put', 'class'=>'form-horizontal', 'id' => 'saveImportForm']) }}
    {{ Form::hidden('id', $bubble->id) }}
    {{ Form::hidden('value', $bubble->value, ['id' => 'importSave']) }}
    {{ Form::close() }}
@stop

@section('tool.nav')
    <a class='btn btn-primary glyphicon glyphicon-remove' href='{{ URL::route('strip.index', $strip->comic->id, $strip->id) }}' id='cancel'> Quitter</a>
    <a class='btn btn-primary glyphicon glyphicon-floppy-disk' href='' id='saveImport'> Terminer</a>
@stop