<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@Lang('popup.title')</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-3 col-md-4 col-xs-height col-center">
                        <div class="form-group">
                            {{ Form::textarea('text','Select a bubble ?', array('class'=>'form-control', 'style' => 'margin-bottom: 5px;height:100px;', 'id' => 'texttotranslate' )) }}
                            <div class="row">
                                <div class="col-xs-12 col-md-12 ">
                                    <button id="textButton" type="button" class="btn btn-primary">Translate</button>
                                    <div class="selectContainer pull-right">
                                        <select id="api" name="api" class="form-control pull-right">
                                            <option value="google">Google Translate</option>
                                            <option value="bing">Bing Tranlate</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <br />
                            
                            <label>
                            <h4 id="apiName" class="list-group-item-heading">Google Translate</h4>
                            </label>
                            <textarea id="ajax-content" class="form-control" style="margin-bottom: 5px;height:100px;" > </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="auto-translate">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
