function ajaxTranslate() {
	var text = 'Ever heard the trolley problem?'
	var lang = 'fr'
	var api = document.getElementById('api').value;
	console.log(api);
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
	var json_url = '../../ws/translate/' + api + '?text=' + text + '&to='
			+ lang;
	$.ajax({
		url : json_url,
		type : 'PATCH',
		success : function(data) {
			if (data.translation)
				$('#ajax-content').html(data.translation);
			else
				$('#ajax-content').html(
						"<div id=\"signupalert\" class=\"alert alert-danger\">Errors = "
								+ data.errorReason + "</div>");
		}
	});
}

$(document).ready(function() {
	$("#api").on("change", function() {
		ajaxTranslate();
	});
	$('#getdata').on('click', function() {
		ajaxTranslate();
	});
});