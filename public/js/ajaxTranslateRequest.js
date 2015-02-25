function ajaxTranslate() {
    var texttotranslate = document.getElementById('texttotranslate').value;
    var from = $('#langOrigin').val();
    var to = $('#langPicker').val();
    var api = $('#api').val();

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
        url: encodeURI(json_url),
        type: 'PUT',
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        success: function (data) {
            if (data.translation)
                $('#ajax-content').val(data.translation);
            else
                $('#ajax-content').val(
                        "<div id=\"signupalert\" class=\"alert alert-danger\">Errors = "
                        + data.errorReason + "</div>");
        },
        error: function (data) {
            console.log('error json');
        }
    });
}
;

function bubbleVote() {
    var bubble_id = $('#bubble_id').val();
    var user_id = $('#user_id').val();
    var strip_id = $('#strip_id').val();
    var lang_id = $('#lang_id').val();

    $.ajax({
                type: 'POST',
                data: {
                    user_id: user_id,
                    strip_id: strip_id,
                    lang_id: lang_id,
                    bubble_id: bubble_id
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                success: function (data) {
                    switch (data.status) {
                        case 'success':
                        case 'revote':
                            $('#ajax-response')
                                    .html(
                                            "<div id=\"signupalert\" class=\"alert alert-dismissible alert-success\">"
                                            + "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>"
                                            + data.msg + " </div>");
                            break;
                        case 'error':
                            $('#ajax-response')
                                    .html(
                                            "<div id=\"signupalert\" class=\"alert alert-dismissible alert-danger\">"
                                            + "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>"
                                            + data.msg + "</div>");
                            break;
                    }
                },
                error: function (data) {
                    console.log('error json');
                }
            });

    // .....
    // do anything else you might want to do
    // .....
    // prevent the form from actually submitting in browser
    return false;
}
;

$(document).ready(function () {
    $("#api").on("change", function () {
        ajaxTranslate();
    });
    $('#getdata').on(
            'click',
            function () {
                //$('#texttotranslate').val("Ever heard of the trolley problem?");
                ajaxTranslate();
            });
    $('#textButton').on('click', function () {
        ajaxTranslate();
    });
    $('#form-vote').on('submit', function (e) {
        e.preventDefault();
        bubbleVote();
        return false;
    });
});