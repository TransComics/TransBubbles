@extends('layouts.tool')

@section('tool.title')
	@lang('strip.translateInterface')
@stop
@section('tool.scripts')
    {{HTML::script('js/ajaxTranslateRequest.js') }} 
@stop 

@section('tool.items')
    {{ Form::open(['route' => ['strip.lang'], 'method' => 'post', 'id' => 'langFormFrom', 'style' => 'display : inline;']) }}
    {{ Form::select('lang_id', $available_languages, $lang_strip,['class'=>'selectpicker','data-width'=>'auto', 'id'=>'langOrigin', 'onChange' => '$("#langFormFrom").submit();'])}}
    {{ Form::close() }}
    <span class='glyphicon glyphicon-arrow-right'></span>
    {{ Form::open(['route' => ['strip.lang_to'], 'method' => 'post', 'id' => 'langFormTo', 'style' => 'display : inline;']) }}
    {{ Form::select('lang_id', $translate_languages, $lang_strip_to,['class'=>'selectpicker','data-width'=>'auto', 'id'=>'langPicker', 'onChange' => '$("#langFormTo").submit();']) }}
    {{ Form::close() }}
    <div class="btn-group pull-right margin-5" role="group">
        <a class='btn btn-primary fa fa-undo' href="" id="undo" title="@lang('tool.undo')"></a>
        <a class='btn btn-primary fa fa-repeat' href="" id="redo" title="@lang('tool.redo')"></a>
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
        <span class='btn btn-primary fa fa-align-left' id="alignLeft" title="@lang('tool.alignLeft')"></span>
        <span class='btn btn-primary fa fa-align-center' id="alignCenter" title="@lang('tool.alignCenter')"></span>
        <span class='btn btn-primary fa fa-align-right' id="alignRight" title="@lang('tool.alignRight')"></span>
        <span class='btn btn-primary fa fa-align-justify' id="alignJustify" title="@lang('tool.alignJustify')"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
        <span class='btn btn-primary fa fa-bold' id="textBold" title="@lang('tool.bold')"></span>
        <span class='btn btn-primary fa fa-italic' id="textItalic" title="@lang('tool.italic')"></span>
        <span class='btn btn-primary fa fa-underline' id="textUnderline" title="@lang('tool.underline')"></span>
        <span class='btn btn-primary fa fa-strikethrough' id="textLineThrough" title="@lang('tool.lineThrough')"></span>
    </div>

    <div class="btn-group pull-right margin-5" role="group">
	<a class='btn btn-primary fa fa-location-arrow' href="" id="update" title="@lang('tool.select')"></a>
        <input class="btn btn-primary" style="height:37px;" type="color" name="colorPickerText" id="colorPickerText" value="#000000" title="@lang('tool.textColor')" />
	<input class="btn btn-primary" style="height:37px;" type="color" name="colorPickerBackground" id="colorPickerBackground" value="#ffffff"  title="@lang('tool.backgroundColor')" />
        <input class="btn btn-primary" style="width:65px;height:37px;" type="number" name="sizePickerText" id="sizePickerText" value="14" min="1" max="999" title="@lang('tool.fontSize')" />
        
        {{ Form::select('fontPicker', $fonts, $font_id,['title'=>Lang::get('tool.font'),'class'=>'btn btn-primary', 'id'=>'fontPicker', 'style' => 'width:120px;height:37px;padding: 3px;']); }}
    </div>
    <div class="btn-group pull-right margin-5" role="group">
        <span id="getdata" type="button" class="btn btn-primary fa fa-language" data-toggle="modal" data-target="#myModal"> @lang('tool.autoTranslate')</span>
    </div>
@stop

@section('tool.content')
    <div id="main">
        <table id="paint">
            <tr>
                <td id="origin">
                    <div class="showCanvas text-right">
                        <span class="showCanvas-json hidden">{{$canvas_original}}</span>
                        <span class="showCanvas-height hidden">{{$strip_height}}</span>
                        <span class="showCanvas-width hidden">{{$strip_width}}</span>
                        <span class="id hidden">canvas-{{$bubble->id}}</span>
                        <canvas id="canvas-{{$bubble->id}}" class="showCanvas-canvas" width="706" height="283"></canvas>
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
    @include('translate.popup')
    
    <span id="interface" class="hidden">translate</span>
    <span id="canvasSave" class="hidden">{{$canvas_delivered}}</span>
    <span id="canvasHeight" class="hidden">{{$strip_height}}</span>
    <span id="canvasWidth" class="hidden">{{$strip_width}}</span>
    <span id="strip" class="hidden">
        {{ HTML::image($strip->path) }}
    </span>
    
    {{ Form::open(['route' => ['strip.saveTranslate', $strip->comic->id, $strip->id], 'method' => 'put', 'class'=>'form-horizontal', 'id' => 'saveTranslateForm']) }}
    {{ Form::hidden('lang_id', '', ['id' => 'lang_id']) }}
    {{ Form::hidden('id', $bubble->id) }}
    {{ Form::hidden('value', $bubble->value, ['id' => 'translateSave']) }}
    {{ Form::close() }}
@stop

@section('tool.nav')
    <a class='btn btn-primary glyphicon glyphicon-remove' href='{{ URL::previous() }}' id='cancel'> @lang('base.quit')</a>
    <a class='btn btn-primary glyphicon glyphicon-floppy-disk' href='' id='saveTranslate'> @lang('base.finish')</a>
@stop
