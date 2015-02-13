function ajaxTranslate() {
	var texttotranslate = document.getElementById('texttotranslate').value;
	var from = document.getElementById('from').value;
	var to = document.getElementById('to').value;
	var api = document.getElementById('api').value;

	console.log(api);
	console.log(texttotranslate);
	switch (api) {
	case 'google':
		$('#apiName').text("Google Translate");
		break;
	case 'bing':
		$('#apiName').text("Bing Translate");
		break;
	default:
		break;
	}
	var json_url = '/ws/translate/' + api + '?text=' + texttotranslate
			+ '&from=' + from + '&to=' + to;

	$.ajax({
		url : encodeURI(json_url),
		type : 'PUT',
		headers : {
			'X-CSRF-Token' : $('meta[name="_token"]').attr('content')
		},
		success : function(data) {
			if (data.translation)
				$('#ajax-content').html(data.translation);
			else
				$('#ajax-content').html(
						"<div id=\"signupalert\" class=\"alert alert-danger\">Errors = "
								+ data.errorReason + "</div>");
		},
		error : function(data) {
			console.log('error json');
		}
	});
}

$(document).ready(function() {
	$("#api").on("change", function() {
		ajaxTranslate();
	});
	$('#getdata').on('click', function() {
		$('#texttotranslate').val("Ever heard of the trolley problem?");
		ajaxTranslate();
	});
	$('#textButton').on('click', function() {
		ajaxTranslate();
	});
});