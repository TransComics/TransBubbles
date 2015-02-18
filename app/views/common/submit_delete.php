<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">@lang('base.confirm')</div>
			<div class="modal-body">
				<p>You are about to delete one role, this procedure is
					irreversible.</p>
				<p>Do you want to proceed?</p>
				<input id="inputB" type="hidden" value="" name="testinput">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('base.cancel')</button>
				<a href="#" id="submit" class="btn btn-success success">@lang('base.submit')</a>
			</div>
		</div>
	</div>
</div>