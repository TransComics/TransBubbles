$(document).ready(
		function() {
			// alert(document.getElementById('txtLang').value);
			// attach a jQuery live event to the button
			// $('#loader').ajaxLoader();
			$('#getdata-button').bind( 'click', function() {

						var text = document.getElementById('txtString').value
						var lang = document.getElementById('txtLang').value;
						var api = document.getElementById('api').value;

						var json_url = 'translatetest/' + api + '?text=' + text
								+ '&to=' + lang;

						$.getJSON(json_url, function(data) {

							// alert(data); //uncomment this for debug
							// alert (data.item1+" "+data.item2+" "+data.item3);
							// //further debug
							if (data.translation)
								$('#showdata').html(
										"<div class=\"alert alert-info\" role=\"alert\">"
												+ data.translation + "</div>");
							else
								$('#showdata').html(
										"<div id=\"signupalert\" class=\"alert alert-danger\">Errors = "
												+ data.errorReason + "</div>");
						});
					});

			$("#api").bind("change", function() {

						var text = document.getElementById('txtString').value
						var lang = document.getElementById('txtLang').value;
						var api = document.getElementById('api').value;

						var json_url = 'translatetest/' + api + '?text=' + text
								+ '&to=' + lang;
						$.getJSON(json_url, function(data) {

							// alert(data); //uncomment this for debug
							// alert (data.item1+" "+data.item2+" "+data.item3);
							// //further debug
							if (data.translation)
								$('#showdata').html(
										"<div class=\"alert alert-info\" role=\"alert\">"
												+ data.translation + "</div>");
							else
								$('#showdata').html(
										"<div id=\"signupalert\" class=\"alert alert-danger\">Errors = "
												+ data.errorReason + "</div>");

						});
					});
		});