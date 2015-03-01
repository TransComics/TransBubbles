$(document).ready(function () {
	$('.helper').tooltip({'placement': 'top'})
    //add the function to modify the vote
    $(".popularities").click(function (e) {

        //get class name (down_button / up_button) of clicked element
        if($(this).hasClass("glyphicon-thumbs-up"))
           var clicked_button= "up";
        else if($(this).hasClass("glyphicon-thumbs-down"))
            var clicked_button= "down";

        var id= $(this).attr("id");

        //console.log("id vote " + id);
        //console.log("type "+ clicked_button);

        var json_url = '/ws/popularities/' + id + '?type=' + clicked_button;

         $.ajax({
            url: encodeURI(json_url),
            type: 'PUT',
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            },
            success: function (data) {
                //console.log(data);
                if(data.voted){
                    $(".popularity-group").popover({
                        content: "Already Voted!",
                        placement: "top"
                    });
                    $(".popularity-group").popover("show");
                }
                else{
                    $(".glyphicon-thumbs-up").find(">:first-child").html(data.up);
                    $(".glyphicon-thumbs-down").find(">:first-child").html(data.down);
                    $(".popularities").removeClass( "popularities" );
                }
                $(".popularity-group").children().prop('disabled', true);
            },
            error: function (data) {
                console.log('error json :'+data);
                $(".popularities").removeClass( "popularities" );
            }
        });
    });
});
//$(".popularities").removeClass( "popularities" );});