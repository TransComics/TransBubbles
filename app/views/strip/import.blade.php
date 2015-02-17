@extends('layouts.tool')

@section('tool.title')
	Interface de traduction
@stop
@section('tool.scripts')
{{HTML::script('js/lib/json-jquery.js') }} 
@stop 

@section('tool.items')
   {{ Form::select('langPicker', $strip_languages , $strip_lang_id, ['class'=>'selectpicker', 'id'=>'langPicker']) }}    

    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-undo' href="" id="undo"></a>
        <a class='btn btn-primary fa fa-repeat' href="" id="redo"></a>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <span class='btn btn-primary fa fa-search-plus' id="btnZoomOut"></span>
        <span class='btn btn-primary fa fa-search-minus' id="btnZoomIn"></span>
        <span class='btn btn-primary fa fa-search' id="btnResetZoom"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-eye' href="" id="viewAll"></a>
        <span class='btn btn-primary fa fa-arrows' href="" id="selectAll"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <span class='btn btn-primary fa fa-align-left' id="alignLeft"></span>
        <span class='btn btn-primary fa fa-align-center' id="alignCenter"></span>
        <span class='btn btn-primary fa fa-align-right' id="alignRight"></span>
        <span class='btn btn-primary fa fa-align-justify' id="alignJustify"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <span class='btn btn-primary fa fa-bold' id="textBold"></span>
        <span class='btn btn-primary fa fa-italic' id="textItalic"></span>
        <span class='btn btn-primary fa fa-underline' id="textUnderline"></span>
        <span class='btn btn-primary fa fa-strikethrough' id="textLineThrough"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
	<a class='btn btn-primary fa fa-location-arrow' href="" id="update"></a>
        <a class='btn btn-primary fa fa-trash' href="" id="del"></a>
	<a class='btn btn-primary icon-text' href="" id="text"></a>
        <input class="btn btn-primary" style="height:37px;" type="color" name="colorPickerText" id="colorPickerText" value="#000000" />
	<input class="btn btn-primary" style="height:37px;" type="color" name="colorPickerBackground" id="colorPickerBackground" value="#ffffff" />
        <input class="btn btn-primary" style="width:65px;height:37px;" type="number" name="sizePickerText" id="sizePickerText" value="20" min="1" max="999" />
        
        {{ Form::select('fontPicker', $fonts, 1,['class'=>'btn btn-primary', 'id'=>'fontPicker', 'style' => 'width:120px;height:37px;padding: 3px;']); }}
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
    
    <span id="interface" class="hidden">import</span>
    <span id="canvasSave" class="hidden">{{$canvas_delivered}}</span>
    
    {{ Form::open(['route' => ['strip.saveImport', $strip->comic->id, $strip->id], 'method' => 'put', 'class'=>'form-horizontal', 'id' => 'saveImportForm']) }}
    {{ Form::hidden('lang_id', '', ['id' => 'lang_id']) }}
    {{ Form::hidden('id', $bubble->id) }}
    {{ Form::hidden('value', $bubble->value, ['id' => 'importSave']) }}
    {{ Form::close() }}
@stop

@section('tool.nav')
    <a class='btn btn-primary glyphicon fa fa-times' href='{{ URL::route('strip.index', $strip->comic->id, $strip->id) }}' id='cancel'> Quitter</a>
    <a class='btn btn-primary glyphicon fa fa-floppy-o' href='' id='saveImport'> Terminer</a>
@stop