<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">@lang('base.confirm_delete')</div>
            <div class="modal-body">
                <p>@lang('moderate.content')</p>
                <p>@lang('moderate.proceed')</p>
                <input id="inputB" type="hidden" value="" name="testinput">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('base.cancel')</button>
                <a id="submit" class="btn btn-primary">@lang('base.submit')</a>
            </div>
        </div>
    </div>
</div>