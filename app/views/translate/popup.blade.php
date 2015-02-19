<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">@Lang('popup.title')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="radio">
							<div class="input-group">
								<div class="checkbox">
									<a class="list-group-item"> <label> <input type="radio"
											name="optionsRadios" id="optionsRadios0" value="option0"
											checked>
											<h4 class="list-group-item-heading">Original translation</h4>
											<p id="originalTranslation" class="list-group-item-text">Ever
												heard the trolley problem?</p>
									</label>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-3 col-md-4 col-xs-height col-center">
						<div class="form-group">
							{{ Form::text('text','Ever heard the trolley problem?',
							array('class'=>'form-control', 'style' => 'margin-bottom: 5px;', 'placeholder'=> 'Demo text to
							translate', 'id' => 'texttotranslate' )) }}
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
						</div>
					</div>
				</div>
				<div class="row">
					<div class="row-same-height">
						<div class="col-xs-9 col-md-8 col-xs-height">
							<div class="radio">
								<div class="input-group">
									<div class="checkbox">
										<a href="" class="list-group-item"> <label> <input
												type="radio" name="optionsRadios" id="optionsRadios1"
												value="option1">
												<h4 id="apiName" class="list-group-item-heading">Google
													Translate</h4>
												<div id="ajax-content"></div>
										</label>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="radio">
							<div class="input-group">
								<div class="checkbox">
									<a href="" class="list-group-item"> <label> <input type="radio"
											name="optionsRadios" id="optionsRadios2" value="option2">
											<h4 class="list-group-item-heading">History translation from
											</h4>
											<p class="list-group-item-text">
											
											<div id="ajax-content-history">translations..</div>
											</p>
									</label>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Confirm</button>
				</div>
			</div>
		</div>
	</div>
</div>
