

$(document).ready(function () {
    $(document).imageready(function () {
        $(".showCanvas").each(function() {
            var canvas = new fabric.Canvas($(this).find(".id").text());
            var h_size = $(this).find(".showCanvas-height").text();
            var w_size = $(this).find(".showCanvas-width").text();
            
            var responsive_size = $('#'+$(this).find('.img_id').text()).width();
            canvas.setHeight(h_size);
            canvas.setWidth(w_size);
            
            function zoomDo(canvasScaleTo) {
                canvas.setHeight(canvas.getHeight() * canvasScaleTo);
                canvas.setWidth(canvas.getWidth() * canvasScaleTo);
                canvas.forEachObject(function (object) {
                    var scaleX = object.scaleX;
                    var scaleY = object.scaleY;
                    var left = object.left;
                    var top = object.top;
                    var tempScaleX = scaleX * canvasScaleTo;
                    var tempScaleY = scaleY * canvasScaleTo;
                    var tempLeft = left * canvasScaleTo;
                    var tempTop = top * canvasScaleTo;
                    object.scaleX = tempScaleX;
                    object.scaleY = tempScaleY;
                    object.left = tempLeft;
                    object.top = tempTop;
                    object.setCoords();
                });
                canvas.renderAll(true);
            }
            
            canvas.loadFromJSON($(this).find(".showCanvas-json").text(), function () {
                canvas.forEachObject(function (o) {
                        o.selectable = false;
                });
                if(responsive_size != null && responsive_size != '' && responsive_size < w_size) {
                    var objects = canvas.getObjects();
                    zoomDo(responsive_size / w_size);
                }
                canvas.renderAll();
            });
        });
    });
});