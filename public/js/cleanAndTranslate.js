$(document).ready(function () {
    $(document).imageready(function () {
        /* ********************************************************************************************** *
         * *********************************** Canvas handler ******************************************** *
         * ********************************************************************************************** */
        var canvas = new fabric.Canvas('c');
        var interface = $('#interface').text();
        if (interface !== "translate") {
            canvas.setHeight($('#i').height());
            canvas.setWidth($('#i').width());
        }
        else {
            canvas.setHeight($('#canvasHeight').text());
            canvas.setWidth($('#canvasWidth').text());
        }

        canvas.includeDefaultValues = false;
        var color = $('#colorPicker').val();
        var size = $('#sizePicker').val();
        var textSize = $('#sizePickerText').val();
        var font = $('#fontPicker').val();
        var background = null; // we need to keep an reference for background because it need to stay unselectable
        canvas.freeDrawingBrush.width = size; // default brush size
        canvas.freeDrawingBrush.color = color; // default brush color
        canvas.renderAll();
        function initCanvas() {
            if (interface !== "translate") {
                if (background == null) {
                    background = new fabric.Image('i', {
                        left: 0,
                        top: 0,
                        angle: 0,
                        opacity: 1,
                        selectable: false
                    });
                }
                canvas.add(background);
                canvas.renderAll(true);
            }
        }

        function TBCanvasParam() {
// initialisation de nos parametre de canvas
            this.isEyedropper = false;
            this.started = false;
            this.shape = false;
            this.viewAll = false;
            this.selectAll = false;
            this.update = false;
            this.ctr = false;
            this.x = 0;
            this.y = 0;
        }

// Add methods like this.  All Person objects will be able to invoke this
        TBCanvasParam.prototype.allSelectable = function (selectable, canvas) {
            if (interface === "clean") {
                canvas.forEachObject(function (o) {
                    if (o.type != 'image')
                        o.selectable = selectable;
                    else
                        o.selectable = false;
                });
            }
            else {
                canvas.forEachObject(function (o) {
                    if (o.type === 'i-text')
                        o.selectable = selectable;
                    else
                        o.selectable = false;
                });
            }
        }

        TBCanvasParam.prototype.allActive = function (active, canvas) {
            canvas.deactivateAll();
            canvas.forEachObject(function (o) {
                if (interface === "clean") {
                    if (o.type !== 'image')
                        o.set('active', active);
                }
                else {
                    if (o.type === 'i-text')
                        o.set('active', active);
                }
            });
            canvas.renderAll();
        }

        TBCanvasParam.prototype.allSelected = function (selected, canvas) {
            canvas.deactivateAll();
            if (selected) {
                var objects = canvas.getObjects();
                if (interface === "clean") {
                    objects = jQuery.grep(objects, function (value) {
                        return value.type !== 'image';
                    });
                }
                else {
                    objects = jQuery.grep(objects, function (value) {
                        return value.type === 'i-text';
                    });
                }

                canvas.setActiveGroup(new fabric.Group(objects));
            }

            canvas.renderAll();
        }

        TBCanvasParam.prototype.desactivateButton = function () {
            canvas.defaultCursor = 'default';
            $('#rect').css('background', '#375a7f');
            $('#circle').css('background', '#375a7f');
            this.shape = false;
            this.allSelectable(true, canvas);

            $('#eyedropper').css('background', '#375a7f');
            this.isEyedropper = false;

            $('#viewAll').css('background', '#375a7f');
            this.viewAll = false;
            this.allActive(false, canvas);
            $('#brush').css('background', '#375a7f');
            canvas.isDrawingMode = false;
            $('#selectAll').css('background', '#375a7f');
            this.selectAll = false;
            this.allSelected(false, canvas);
            $('#update').css('background', '#375a7f');
            this.update = false;
        }


        TBCanvasParam.prototype.activateButton = function (id) {
            $(id).css('background-color', '#0ce3ac');
        }
        
        /* initialisation variable to zoom and to undo/redo */
        var canvasScale = 1;
        var SCALE_FACTOR = 1.2;
        
        var save = [];
        var scaleSave = []; // to zoom
        var save_index = 0; // because we sauv the original before - and save index become 0
        var save_max = 0;
        var updateActivate = true;
        
        /* ********************************************************************************************** *
         * *********************************** Zoom handler ******************************************** *
         * ********************************************************************************************** */
        
    // Zoom do
        function zoomDo(canvasScaleFrom, canvasScaleTo) {
            var objects = canvas.getObjects();
            for (var i in objects) {
                var scaleX = objects[i].scaleX;
                var scaleY = objects[i].scaleY;
                var left = objects[i].left;
                var top = objects[i].top;
                var tempScaleX = scaleX * (1 / canvasScaleFrom);
                var tempScaleY = scaleY * (1 / canvasScaleFrom);
                var tempLeft = left * (1 / canvasScaleFrom);
                var tempTop = top * (1 / canvasScaleFrom);
                objects[i].scaleX = tempScaleX;
                objects[i].scaleY = tempScaleY;
                objects[i].left = tempLeft;
                objects[i].top = tempTop;
                objects[i].setCoords();
            }
            
            canvas.renderAll();
            var zoom = (canvasScaleTo > 1)? true : false;
            
            var objects = canvas.getObjects();
            for (var i in objects) {
                var scaleX = objects[i].scaleX;
                var scaleY = objects[i].scaleY;
                var left = objects[i].left;
                var top = objects[i].top;
                var tempScaleX = scaleX * canvasScaleTo;
                var tempScaleY = scaleY * canvasScaleTo;
                var tempLeft = left * canvasScaleTo;
                var tempTop = top * canvasScaleTo;
                objects[i].scaleX = tempScaleX;
                objects[i].scaleY = tempScaleY;
                objects[i].left = tempLeft;
                objects[i].top = tempTop;
                objects[i].setCoords();
            }
            canvas.renderAll();
        }
// Zoom In
        function zoomIn() {
            // TODO limit the max canvas zoom in

            canvasScale = canvasScale * SCALE_FACTOR;
            canvas.setHeight(canvas.getHeight() * SCALE_FACTOR);
            canvas.setWidth(canvas.getWidth() * SCALE_FACTOR);
            var objects = canvas.getObjects();
            for (var i in objects) {
                var scaleX = objects[i].scaleX;
                var scaleY = objects[i].scaleY;
                var left = objects[i].left;
                var top = objects[i].top;
                var tempScaleX = scaleX * SCALE_FACTOR;
                var tempScaleY = scaleY * SCALE_FACTOR;
                var tempLeft = left * SCALE_FACTOR;
                var tempTop = top * SCALE_FACTOR;
                objects[i].scaleX = tempScaleX;
                objects[i].scaleY = tempScaleY;
                objects[i].left = tempLeft;
                objects[i].top = tempTop;
                objects[i].setCoords();
            }

            canvas.renderAll();
        }

// Zoom Out
        function zoomOut() {
            // TODO limit max cavas zoom out

            canvasScale = canvasScale / SCALE_FACTOR;
            canvas.setHeight(canvas.getHeight() * (1 / SCALE_FACTOR));
            canvas.setWidth(canvas.getWidth() * (1 / SCALE_FACTOR));
            var objects = canvas.getObjects();
            for (var i in objects) {
                var scaleX = objects[i].scaleX;
                var scaleY = objects[i].scaleY;
                var left = objects[i].left;
                var top = objects[i].top;
                var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                var tempLeft = left * (1 / SCALE_FACTOR);
                var tempTop = top * (1 / SCALE_FACTOR);
                objects[i].scaleX = tempScaleX;
                objects[i].scaleY = tempScaleY;
                objects[i].left = tempLeft;
                objects[i].top = tempTop;
                objects[i].setCoords();
            }

            canvas.renderAll();
        }

// Reset Zoom
        function resetZoom() {

            canvas.setHeight(canvas.getHeight() * (1 / canvasScale));
            canvas.setWidth(canvas.getWidth() * (1 / canvasScale));
            var objects = canvas.getObjects();
            for (var i in objects) {
                var scaleX = objects[i].scaleX;
                var scaleY = objects[i].scaleY;
                var left = objects[i].left;
                var top = objects[i].top;
                var tempScaleX = scaleX * (1 / canvasScale);
                var tempScaleY = scaleY * (1 / canvasScale);
                var tempLeft = left * (1 / canvasScale);
                var tempTop = top * (1 / canvasScale);
                objects[i].scaleX = tempScaleX;
                objects[i].scaleY = tempScaleY;
                objects[i].left = tempLeft;
                objects[i].top = tempTop;
                objects[i].setCoords();
            }

            canvas.renderAll();
            canvasScale = 1;
            //scaleSave[save_index-1] = canvasScale; // to be adapted at the undo/redo function
        }


        /* ********************************************************************************************** *
         * ********************************* Undo Redo handler ****************************************** *
         * ********************************************************************************************** */

        function updateModifications() {
            if (updateActivate) {
                myjson = JSON.stringify(canvas);
                save[save_index] = myjson;
                scaleSave[save_index] = canvasScale;
                save_index++;
                save_max = save_index;
            }
        }

        function undo() {
            if (save_index > 1) {
                updateActivate = false;
                save_index -= 1;
                console.log("Undo => OK - "+(save_index-1));
                canvas.clear();
                canvas.loadFromJSON(save[save_index-1], function () {
                    // handler of zoom
                    zoomDo(scaleSave[save_index-1] ,canvasScale); // to handle zoom
                    
                    canvas.renderAll(true);
                    updateActivate = true;
                    param.allSelectable(true, canvas); // we desactivate all object, beacause if one object is selected, it wont able to undo correctly
                });
            } else {
                console.log("Undo => KO");
            }
        }

        function redo() {
            if (save_index <  save_max) {
                updateActivate = false;
                save_index += 1;
                console.log("Redo => OK - "+(save_index-1));
                canvas.clear();
                canvas.loadFromJSON(save[save_index-1], function () {
                    // handler of zoom
                    zoomDo(scaleSave[save_index-1] ,canvasScale); // to handle zoom
                    
                    canvas.renderAll(true);
                    updateActivate = true;
                    param.allSelectable(true, canvas); // we desactivate all object, beacause if one object is selected, it wont able to undo correctly
                });
            } else {
                console.log("Redo => KO");
            }
        }

        function clearcan() {
            canvas.clear().renderAll();
            save = [];
        }
        
        /* ********************************************************************************************** *
         * *********************************** init canvas ******************************************** *
         * ********************************************************************************************** */


        initCanvas();
        /* load the cleanning */
        
        updateActivate = false;
        if($('#canvasSave').text() != ''){
            canvas.loadFromJSON($('#canvasSave').text(), function () {
                canvas.renderAll(true);
                param.allSelectable(true, canvas); // we desactivate all object, beacause if one object is selected, it wont able to undo correctly
                updateActivate = true;
                updateModifications();
            });
        }else {
            updateActivate = true;
            updateModifications();
        }

        var param = new TBCanvasParam();
       
       /* ********************************************************************************************** *
         * *********************************** Eyedropper handler ******************************************** *
         * ********************************************************************************************** */

       function eyedropper (e) {
            var mouse = canvas.getPointer(e.e); // get the current mouse position
            var x = parseInt(mouse.x);
            var y = parseInt(mouse.y);


            var context = canvas.getContext('2d');
            var imageData = context.getImageData(x, y, 1, 1);
            var data = imageData.data;

            $('#colorPicker').val('#'+data[0].toString(16)+data[1].toString(16)+data[2].toString(16));
            param.desactivateButton();
            $('#colorPicker').change();
        }

        /* ********************************************************************************************** *
         * *********************************** Event handler ******************************************** *
         * ********************************************************************************************** */

        canvas.observe('mouse:down', function (e) {
            mousedown(e);
        });
        canvas.observe('mouse:move', function (e) {
            mousemove(e);
        });
        canvas.observe('mouse:up', function (e) {
            mouseup(e);
        });
// handling to hide origin strip
        $('#hidden-origin').click(function () {
            if ($('.origin').is(":visible")) {
                $('.origin').hide();
                $('#hidden-origin').html(' Afficher l\'original');
            }
            else {
                $('.origin').show();
                $('#hidden-origin').html(' Cacher');
            }
            return false;
        });
// handling to save the cleaning
        $('#saveClean').click(function () {
            resetZoom();
            myjson = JSON.stringify(canvas);
            $('#saveCleanAction').val("saveClean");
            $('#cleanSave').val(myjson);
            $('#saveCleanForm').submit();
            return false;
        });
// handling to save the translation
        $('#saveTranslate').click(function () {
            resetZoom();
            myjson = JSON.stringify(canvas);
            $('#translateSave').val(myjson);
            $('#lang_id').val($('#langPicker').val());
            $('#saveTranslateForm').submit();
            return false;
        });
// handling to save the import origin text
        $('#saveImport').click(function () {
            resetZoom();
            myjson = JSON.stringify(canvas);
            $('#importSave').val(myjson);
            $('#lang_id').val($('#langPicker').val());
            $('#saveImportForm').submit();
            return false;
        });
// handling to save the cleaning
        $('#nextStep').click(function () {
            resetZoom();
            myjson = JSON.stringify(canvas);
            $('#saveCleanAction').val("nextStep");
            $('#cleanSave').val(myjson);
            $('#saveCleanForm').submit();
            return false;
        });
// handling to create a rect
        $('#rect').click(function () {
            if (param.shape != "rect") {
                param.desactivateButton();
                param.shape = "rect";
                param.allSelectable(false, canvas);
                param.activateButton('#rect');
            }
            else {
                param.desactivateButton();
            }
            return false;
        });
        $('#circle').click(function () {
            if (param.shape != "circle") {
                param.desactivateButton();
                param.shape = "circle";
                param.allSelectable(false, canvas);
                param.activateButton('#circle');
            }
            else {
                param.desactivateButton();
            }
            return false;
        });
        $('#eyedropper').click(function () {
            if (!param.isEyedropper) {
                param.desactivateButton();
                param.isEyedropper = true;
                canvas.defaultCursor = 'url(/images/icons/16/eyedropper.png), auto';
                param.allSelectable(false, canvas);
                param.activateButton('#eyedropper');
            }
            else {
                param.desactivateButton();
            }
            return false;
        });
        $("#text").click(function () {
            param.desactivateButton();
            param.shape = 'text';
            return false;
        });
        $("#del").click(function () {
            canvas.remove(canvas.getActiveObject());
            canvas.renderAll();
            return false;
        });
        $('#brush').click(function () {
            if (!canvas.isDrawingMode) {
                param.desactivateButton();
                canvas.isDrawingMode = true;
                param.activateButton('#brush');
            }
            else {
                param.desactivateButton();
            }
            return false;
        });
        $('#viewAll').click(function () {
            if (!param.viewAll) {
                param.desactivateButton();
                param.viewAll = true;
                param.allActive(true, canvas);
                param.activateButton('#viewAll');
            }
            else {
                param.desactivateButton();
            }
            return false;
        });
        $('#colorPicker').change(function () {
            color = $('#colorPicker').val();
            canvas.freeDrawingBrush.color = color;
        });
        $('#sizePickerText').change(function () {
            textSize = $('#sizePickerText').val();
            if (textSize > 999)
                $('#sizePickerText').val('999');
            if (textSize < 1)
                $('#sizePickerText').val('1');
        });
        $('#sizePicker').change(function () {
            size = $('#sizePicker').val();
            if (size > 999)
                $('#sizePicker').val('999');
            if (size < 1)
                $('#sizePicker').val('1');
            canvas.freeDrawingBrush.width = size;
        });
        $('#fontPicker').change(function () {
            font = $('#fontPicker').val();
            if (size > 999)
                $('#fontPicker').val('999');
            if (size < 1)
                $('#fontPicker').val('1');
        });
        $('#selectAll').click(function () {
            if (!param.selectAll) {
                param.desactivateButton();
                param.activateButton('#selectAll');
                param.selectAll = true;
                param.allSelected(true, canvas);
            }
            else {
                param.desactivateButton();
            }
            return false;
        });
        $('#update').click(function () {
            if (!param.update) {
                param.desactivateButton();
                param.activateButton('#update');
                param.update = true;
            }
            else {
                param.desactivateButton();
            }
            return false;
        });
        $('#alignLeft').click(function () {
            var o = canvas.getActiveObject();
            if (o.type == 'i-text') {
                o.set('textAlign', 'left');
            }
            return false;
        });
        $('#alignRight').click(function () {
            var o = canvas.getActiveObject();
            if (o.type == 'i-text') {
                o.set('textAlign', 'right');
            }
            return false;
        });
        $('#alignCenter').click(function () {
            var o = canvas.getActiveObject();
            if (o.type == 'i-text') {
                o.set('textAlign', 'center');
            }
            return false;
        });
        $('#alignJustify').click(function () {
            var o = canvas.getActiveObject();
            if (o.type == 'i-text') {
                o.set('textAlign', 'justify');
            }
            return false;
        });
        $('#magnifier').click(function () {
            alert('pas-ok');
            return false;
        });
// button Zoom In
        $("#btnZoomIn").click(function () {
            param.desactivateButton(); // we desactivate all object, beacause if one object is selected, it will not magnifier
            zoomIn();
            return false;
        });
// button Zoom Out
        $("#btnZoomOut").click(function () {
            param.desactivateButton(); // we desactivate all object, beacause if one object is selected, it will not magnifier
            zoomOut();
            return false;
        });
// button Reset Zoom
        $("#btnResetZoom").click(function () {
            param.desactivateButton(); // we desactivate all object, beacause if one object is selected, it will not magnifier
            resetZoom();
            return false;
        });
        $("#undo").click(function () {
            undo();
            return false;
        });
        $("#redo").click(function () {
            redo();
            return false;
        });
        
        $('#auto-translate').click(function() {
            var o = canvas.getActiveObject();
            if(o.type == 'i-text'){
                console.log('############## ok');
                o.text = $('#ajax-content').val();
                canvas.renderAll(true);
                $('#myModal').modal('hide');
            }
            return false;
	});

        canvas.on('object:modified', function () {
            console.log("An object has modified :" + updateActivate);
            updateModifications();
        });
        canvas.on('object:added', function (e) {
            var activeObject = e.target;
            if(activeObject.type != "rect" && activeObject.type != "ellipse"){
                console.log("An object has created :" + updateActivate);
                updateModifications();
            }
        });
        canvas.on('object:removed', function () {
            console.log("An object has removed :" + updateActivate);
            updateModifications();
        });
        canvas.on('object:selected', function (e) {
            var activeObject = e.target;
            if(activeObject.type == "i-text") {
                console.log("An object has selected :" + activeObject.text);
                
                // to auto translate
                $('#texttotranslate').val(activeObject.text);
                
                // to update size/color/font
                $('#sizePickerText').val(getStyle(activeObject, 'fontSize'));
                $('#colorPickerBackground').val(getStyle(activeObject, 'textBackgroundColor'));
                $('#colorPickerText').val(getStyle(activeObject, 'fill'));
                $('#fontPicker').val(getStyle(activeObject, 'fontFamily'));
            }
	});
        canvas.on('text:editing:exited', function () {
            console.log("An object has exited :" + updateActivate);
            updateModifications();
        });
        

//$("body").keydown( function(e) { alert(e.keyCode); }); // affiche keyCode
        $("body").keyup(function (e) {
            if (e.keyCode == 17 || e.keyCode == 224) {
                this.ctr = false;
                console.log("Touche control/pomme/shit disable.");
            }
        });
        $("body").keydown(function (e) {
            if (e.keyCode == 17 || e.keyCode == 224) {
                this.ctr = true;
                console.log("Key control/pomme.");
            }
            else {
                console.log("Key " + e.keyCode + " down.");
            }

            if (this.ctr) {
                switch (e.keyCode) {
                    case 65:
                        $('#selectAll').click();
                        break;
                    case 84:
                        $('#viewAll').click();
                        break;
                    case 89:
                        $('#redo').click();
                        break;
                    case 90:
                        $('#undo').click();
                        break;
                    case 8:
                        $('#del').click();
                        break;
                    case 61:
                    case 187:
                        $('#btnZoomIn').click();
                        break;
                    case 173:
                    case 189:
                        $('#btnZoomOut').click();
                        break;
                    case 48:
                        $('#btnResetZoom').click();
                        break;
                    default:
                        // do nothing
                        break;
                }
            }
        });

// Mousedown
        function mousedown(e) {
            if (!param.shape || param.started)
                return false;
            var mouse = canvas.getPointer(e.e);
            param.started = true;
            param.x = mouse.x;
            param.y = mouse.y;
            var fshape = null;
            if (param.shape == 'rect') {
                fshape = new fabric.Rect({
                    selectable: false,
                    originX: 'left',
                    originY: 'top',
                    width: 0,
                    height: 0,
                    left: param.x,
                    top: param.y,
                    fill: color
                });
            }
            else if (param.shape == 'circle') {
                fshape = new fabric.Ellipse({
                    selectable: false,
                    originX: 'left',
                    originY: 'top',
                    rx: 0,
                    ry: 0,
                    left: param.x,
                    top: param.y,
                    fill: color
                });
            }
            else {
                fshape = new fabric.IText('Nouveau texte', {
                    selectable: true,
                    hasControls: true,
                    hasRotatingPoint: true,
                    lockScalingX: true,
                    lockScalingY: true,
                    fontFamily: font,
                    textAlign: 'center',
                    left: param.x,
                    top: param.y,
                    width: 0,
                    height: 0,
                    fontSize: textSize
                });
                param.shape = false;
                param.started = false;
            }

            canvas.add(fshape);
            canvas.setActiveObject(fshape);
            canvas.renderAll(true);
        }

// Mousemove
        function mousemove(e) {
            if (!param.started) {
                return true;
            }

            var mouse = canvas.getPointer(e.e);
            var fshape = canvas.getActiveObject();
            if (mouse.x - param.x < 0)
                fshape.originX = 'right';
            else
                fshape.originX = 'left';
            if (mouse.y - param.y < 0)
                fshape.originY = 'bottom';
            else
                fshape.originY = 'top';
            var w = Math.abs(mouse.x - param.x),
                    h = Math.abs(mouse.y - param.y);
            if (!w || !h) {
                return false;
            }

            if (param.shape == 'circle')
                fshape.set('rx', w).set('ry', h);
            else if (param.shape == 'rect')
                fshape.set('width', w).set('height', h);
            canvas.renderAll(true);
        }

// Mouseup
        function mouseup(e) {
            if(param.isEyedropper){ // eyedropper handler
                eyedropper(e);
                return false;
            }else if (param.started) {
                param.started = false;
                param.allSelected(true, canvas);
                canvas.deactivateAll();
                canvas.renderAll(true);
                console.log("An object has created :" + updateActivate);
                updateModifications();
            }
        }
        /* ********************************************************************************************** *
         * ********************************** Text Edit Handler ****************************************** *
         * *********************************************************************************************** */

        function setStyle(object, styleName, value) {
            if (object.setSelectionStyles && object.isEditing) {
                var style = {};
                style[styleName] = value;
                object.setSelectionStyles(style);
            }
            else {
                object[styleName] = value;
                object.styles.forEach(function (word){
                    word.forEach(function (letter){
                        if(letter === null)
                            return;
                        delete letter[styleName];
                    });
                });
            }
        }
        
        function getStyle(object, styleName) {
            return (object.getSelectionStyles && object.isEditing)
                    ? object.getSelectionStyles()[styleName]
                    : object[styleName];
        }

        function addHandler(id, fn, eventName) {
            if (document.getElementById(id)) {
                document.getElementById(id)[eventName || 'onclick'] = function () {
                    var el = this;
                    if (obj = canvas.getActiveObject()) {
                        fn.call(el, obj);
                        canvas.renderAll();
                    }
                };
            }
        }

        addHandler('textBold', function (obj) {
            var isBold = getStyle(obj, 'fontWeight') === 'bold';
            setStyle(obj, 'fontWeight', isBold ? '' : 'bold');
        });
        addHandler('textItalic', function () {
            var isItalic = getStyle(obj, 'fontStyle') === 'italic';
            setStyle(obj, 'fontStyle', isItalic ? '' : 'italic');
        });
        addHandler('textUnderline', function (obj) {
            var isUnderline = (getStyle(obj, 'textDecoration') || '').indexOf('underline') > -1;
            setStyle(obj, 'textDecoration', isUnderline ? '' : 'underline');
        });
        addHandler('textLineThrough', function (obj) {
            var isLinethrough = (getStyle(obj, 'textDecoration') || '').indexOf('line-through') > -1;
            setStyle(obj, 'textDecoration', isLinethrough ? '' : 'line-through');
        });
        addHandler('colorPickerText', function (obj) {
            setStyle(obj, 'fill', this.value);
        }, 'onchange');
        addHandler('colorPickerBackground', function (obj) {
            setStyle(obj, 'textBackgroundColor', this.value);
        }, 'onchange');
        addHandler('sizePickerText', function (obj) {
            setStyle(obj, 'fontSize', parseInt(this.value, 10));
        }, 'onchange');
        addHandler('fontPicker', function (obj) {
            setStyle(obj, 'fontFamily', this.value);
        }, 'onchange');
    });
});

