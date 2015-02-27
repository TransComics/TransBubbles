@extends('layouts.tool')

@section('tool.title')
	@lang('strip.importInterface')
@stop
@section('tool.scripts')
@stop 

@section('tool.items')
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
        <a class='btn btn-primary fa fa-trash' href="" id="del" title="@lang('tool.trash')"></a>
	<a class='btn btn-primary fa fa-text-height' href="" id="text" title="@lang('tool.text')"></a>
        <input class="btn btn-primary" style="height:37px;" type="color" name="colorPickerText" id="colorPickerText" value="#000000" title="@lang('tool.textColor')" />
	<input class="btn btn-primary" style="height:37px;" type="color" name="colorPickerBackground" id="colorPickerBackground" value="#ffffff" title="@lang('tool.backgroundColor')"   />
        <input class="btn btn-primary" style="width:65px;height:37px;" type="number" name="sizePickerText" id="sizePickerText" value="20" min="1" max="999" title="@lang('tool.fontSize')"  />
        
        {{ Form::select('fontPicker', $fonts, $font_id,['title'=>Lang::get('tool.font'),'class'=>'btn btn-primary', 'id'=>'fontPicker', 'style' => 'width:120px;height:37px;padding: 3px;']); }}
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
    
    <span id="interface" class="hidden">import</span>
    <span id="canvasSave" class="hidden">{{$canvas_delivered}}</span>
    
    {{ Form::open(['route' => ['strip.saveImport', $strip->comic->id, $strip->id], 'method' => 'put', 'class'=>'form-horizontal', 'id' => 'saveImportForm']) }}
    {{ Form::hidden('lang_id', '', ['id' => 'lang_id']) }}
    {{ Form::hidden('id', $bubble->id) }}
    {{ Form::hidden('value', $bubble->value, ['id' => 'importSave']) }}
    {{ Form::close() }}
@stop

@section('tool.nav')
    <a class='btn btn-primary glyphicon fa fa-times' href='{{ URL::route('strip.index', $strip->comic->id, $strip->id) }}' id='cancel'> @lang('base.quit')</a>
    <a class='btn btn-primary glyphicon fa fa-floppy-o' href='' id='saveImport'> @lang('base.save')</a>
@stop
