$(document).ready(function () {
    $(".showCanvas").each(function() {
        var canvas = new fabric.Canvas($(this).find(".id").text());
        canvas.setHeight($(this).find(".showCanvas-height").text());
        canvas.setWidth($(this).find(".showCanvas-width").text());
        canvas.loadFromJSON($(this).find(".showCanvas-json").text(), function () {
            canvas.forEachObject(function (o) {
                    o.selectable = false;
            });
            canvas.renderAll(true);
        });
        canvas.renderAll();
    });
});