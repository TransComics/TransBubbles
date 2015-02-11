$(document).ready(function() {

	/* ********************************************************************************************** *
	 * *********************************** Canvas handler ******************************************** *
	 * ********************************************************************************************** */

	var canvas = new fabric.Canvas('c');
	var color = $('#colorPicker').val();
	var size = $('#sizePicker').val();
        var textSize = $('#sizePickerText').val();
        var font = $('#fontPicker').val();
	var background = null; // we need to keep an reference for background because it neet to stay unselectable

	canvas.freeDrawingBrush.width = size; // default brush size
	canvas.freeDrawingBrush.color = color; // default brush color
	canvas.renderAll();

	function initCanvas() {
		if(background == null) {
			background = new fabric.Image('i', {
				left: 0,
				top: 0,
				angle: 0,
				opacity: 0.85,
				selectable: false
			});
		}
		canvas.add(background);
		updateModifications();
		canvas.renderAll(true);
	}

	function TBCanvasParam() {
		// initialisation de nos parametre de canvas
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
	TBCanvasParam.prototype.allSelectable = function(selectable, canvas) {
		canvas.forEachObject(function(o) {
			if(o.type != 'image')
				o.selectable = selectable;
			else
				o.selectable = false;
		});
	}

	TBCanvasParam.prototype.allActive = function(active, canvas) {
		canvas.deactivateAll();
		canvas.forEachObject(function(o) {
			if(o.type != 'image')
				o.set('active', active);
		});
		
		canvas.renderAll();
	}

	TBCanvasParam.prototype.allSelected = function(selected, canvas) {
		canvas.deactivateAll();
		if(selected){
			var objects = canvas.getObjects();

			objects = jQuery.grep(objects, function(value) {
				return value.type != 'image';
			});

			canvas.setActiveGroup(new fabric.Group(objects));
		}

		canvas.renderAll();
	}

	TBCanvasParam.prototype.desactivateButton = function(){
		$('#rect' ).css('border', '1px solid #379dbf');
		$('#circle' ).css('border', '1px solid #379dbf');
		this.shape = false;
		this.allSelectable(true, canvas);
		$('#viewAll' ).css('border', '1px solid #379dbf');
		this.viewAll = false;
		this.allActive(false, canvas);
		$('#brush' ).css('border', '1px solid #379dbf');
		canvas.isDrawingMode = false;
		$('#selectAll' ).css('border', '1px solid #379dbf');
		this.selectAll = false;
		this.allSelected(false, canvas);
		$('#update' ).css('border', '1px solid #379dbf');
		this.update = false;
	}


	TBCanvasParam.prototype.activateButton = function(id){
		$(id).css('border-color', '#f00');
	}

	/* ********************************************************************************************** *
	 * ********************************* Undo Redo handler ****************************************** *
	 * ********************************************************************************************** */
	var state = [];
	var mods = 0;
	var updateActivate = true;

	function updateModifications() {
            if (updateActivate) {
                    myjson = JSON.stringify(canvas);
                    state.push(myjson);
                    //console.log("Update : state.length : " +state.length + " / mods : " +mods);
                    for (var i in state) {
                        console.log("i : "+i+" => "+state[i]);
                    }
            }
	}

	function undo() {
            if (mods < state.length) {
                    updateActivate = false;
                    console.log("Undo => OK");
                    //console.log("undo : state.length : " +state.length + " / mods : " +mods);
                    canvas.clear();
                    var i = state.length - mods -1;
                    canvas.loadFromJSON(state[i],function(){
                            canvas.renderAll(true);
                            updateActivate = true;
                            param.allSelectable(true, canvas); // we desactivate all object, beacause if one object is selected, it wont able to undo correctly
                            mods += 1;
                    });
                    //console.log("index " + (state.length - mods -1));
                    //console.log("state " + state.length);
                    //console.log("mods " + mods);
            }else {
                    console.log("Undo => KO");
            }
            //console.log("Undo : state.length : "+state.length+ " / mods : "+mods);
	}

	function redo() {
            if (mods > 1) {
                    updateActivate = false;
                    console.log("Redo => OK");
                    canvas.clear();
                    var i = state.length - mods +1;
                    canvas.loadFromJSON(state[i],function(){
                            canvas.renderAll(true);
                            updateActivate = true;
                            param.allSelectable(true, canvas); // we desactivate all object, beacause if one object is selected, it wont able to undo correctly
                            mods -= 1;
                    });
                    //console.log("index " + (state.length - mods +1));
                    //console.log("state " + state.length);
                    //console.log("mods " + mods);
            }else {
                    console.log("Redo => KO");
            }
            //console.log("Redo : state.length : "+state.length+ " / mods : "+mods);
	}

	function clearcan() {
		canvas.clear().renderAll();
		newleft = 0;
	}
	/* ********************************************************************************************** *
	 * *********************************** Zoom handler ******************************************** *
	 * ********************************************************************************************** */

	var canvasScale = 1;
	var SCALE_FACTOR = 1.2;

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
	}

	/* ********************************************************************************************** *
	 * *********************************** init canvas ******************************************** *
	 * ********************************************************************************************** */


	initCanvas();

	var param = new TBCanvasParam();

	/* ********************************************************************************************** *
	 * *********************************** Event handler ******************************************** *
	 * ********************************************************************************************** */
	
	canvas.observe('mouse:down', function(e) { mousedown(e); });
	canvas.observe('mouse:move', function(e) { mousemove(e); });
	canvas.observe('mouse:up', function(e) { mouseup(e); });

	// Gestion de la création d'un rectangle
	$('#hidden-origin' ).click(function() {
		if($('.origin').is(":visible")){
			$('.origin').hide();
			$('#hidden-origin').html('Afficher l\'original');
		}
		else {
			$('.origin').show();
			$('#hidden-origin').html('cacher');
		}
		return false;
	});

	$('#rect').click(function() {
		if(param.shape != "rect") {
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
	
	$('#circle').click(function() {
		if(param.shape != "circle") {
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

	$("#text" ).click(function() {
		param.desactivateButton();
		param.shape = 'text';
		return false;
	});

	$("#del" ).click(function() {
		canvas.remove(canvas.getActiveObject());
		canvas.renderAll();
		return false;
	});

	$('#brush' ).click(function() {
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


	$('#viewAll' ).click(function() {
		if(!param.viewAll) {
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

	$('#colorPicker' ).change(function() {
		color = $('#colorPicker' ).val();
		canvas.freeDrawingBrush.color = color;
	});
        
        $('#sizePickerText' ).change(function() {
		textSize = $('#sizePickerText' ).val();
		if(textSize > 999) $('#sizePickerText' ).val('999');
		if(textSize < 1) $('#sizePickerText' ).val('1');
	});

	$('#sizePicker' ).change(function() {
		size = $('#sizePicker' ).val();
		if(size > 999) $('#sizePicker' ).val('999');
		if(size < 1) $('#sizePicker' ).val('1');
		canvas.freeDrawingBrush.width = size;
	});
        
        $('#fontPicker' ).change(function() {
		font = $('#fontPicker').val();
		if(size > 999) $('#fontPicker' ).val('999');
		if(size < 1) $('#fontPicker' ).val('1');
	});

	$('#selectAll' ).click(function() {
		if(!param.selectAll) {
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

	$('#update' ).click(function() {
		if(!param.update) {
			param.desactivateButton();
			param.activateButton('#update');
			param.update = true;
		}
		else {
			param.desactivateButton();
		}
		return false;
	});
        
        $('#alignLeft' ).click(function() {
            var o = canvas.getActiveObject();
            if(o.type == 'i-text'){
                o.set('textAlign', 'left');
            }
            return false;
	});
        
        $('#alignRight' ).click(function() {
            var o = canvas.getActiveObject()
            if(o.type == 'i-text'){
                o.set('textAlign', 'right');
            }
            return false;
	});
        
        $('#alignCenter' ).click(function() {
            var o = canvas.getActiveObject()
            if(o.type == 'i-text'){
                o.set('textAlign', 'center');
            }
            return false;
	});
        
        $('#alignJustify' ).click(function() {
            var o = canvas.getActiveObject()
            if(o.type == 'i-text'){
                o.set('textAlign', 'justify');
            }
            return false;
	});

	$('#magnifier' ).click(function() {
		//test1234();
		alert('pas-ok');
		return false;
	});

	// button Zoom In
	$("#btnZoomIn").click(function(){
		param.desactivateButton(); // we desactivate all object, beacause if one object is selected, it will not magnifier
		zoomIn();
		return false;
	});
	// button Zoom Out
	$("#btnZoomOut").click(function(){
		param.desactivateButton(); // we desactivate all object, beacause if one object is selected, it will not magnifier
		zoomOut();
		return false;
	});
	// button Reset Zoom
	$("#btnResetZoom").click(function(){
		param.desactivateButton(); // we desactivate all object, beacause if one object is selected, it will not magnifier
		resetZoom();
		return false;
	});

	$("#undo").click(function(){
		undo();
		return false;
	});

	$("#redo").click(function(){
		redo();
		return false;
	});

	canvas.on('object:modified', function () {
		console.log("An object has modified :"+updateActivate);
		updateModifications();
	});
	canvas.on('object:added', function () {
			console.log("An object has created :"+updateActivate);
			updateModifications();
	});
	canvas.on('object:removed', function () {
		console.log("An object has removed :"+updateActivate);
		updateModifications();
	});
	
	//$("body").keydown( function(e) { alert(e.keyCode); }); // affiche keyCode
	$("body").keyup( function(e) {
		if(e.keyCode == 17 || e.keyCode == 224 || e.keyCode == 16) {
			this.ctr = false;
			console.log("Touche control/pomme/shit disable.");
		}
	});
	$("body").keydown( function(e) {


		if(e.keyCode == 17 || e.keyCode == 224 || e.keyCode == 16) {
			this.ctr = true;
			console.log("Key control/pomme/shit enable.");
		}
		else {
			console.log("Key "+e.keyCode+" down.");
		}

		if(this.ctr) {
			switch(e.keyCode){
			case 65:
				$('#selectAll' ).click();
				break;
			case 84:
				$('#viewAll' ).click();
				break;
			case 89:
				$('#redo' ).click();
				break;
			case 90:
				$('#undo' ).click();
				break;
			case 8:
				$('#del' ).click();
				break;
			case 61: case 187:
				$('#btnZoomIn' ).click();
				break;
			case 173: case 189:
				$('#btnZoomOut' ).click();
				break;
			case 48:
				$('#btnResetZoom' ).click();
				break;
			default:
				// do nothing
				break;
			}
		}
	});
	//shit => 16
	//a => 65
	//ctr => 17
	//pomme ==> 224
	//c ==> 67
	//v ==> 86
	//s ==> 83
	//z ==> 90
	// y ==> 89
	// p ==> 80
	// r ==> 82
	// t ==> 84

	// Mousedown
	function mousedown(e) {
		if(!param.shape || param.started)
			return false;
		var mouse = canvas.getPointer(e.e);
		param.started = true;
		param.x = mouse.x;
		param.y = mouse.y;
		var fshape = null;
		if(param.shape == 'rect'){
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
		else if(param.shape == 'circle'){
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
                                textAlign : 'center',
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
		if(!param.started) {
			return true;
		}

		var mouse = canvas.getPointer(e.e);
		var fshape = canvas.getActiveObject();

		if(mouse.x - param.x < 0)
			fshape.originX = 'right';
		else
			fshape.originX = 'left';
		if(mouse.y - param.y < 0)
			fshape.originY = 'bottom';
		else
			fshape.originY = 'top';

		var w = Math.abs(mouse.x - param.x),
		h = Math.abs(mouse.y - param.y);

		if (!w || !h) {
			return false;
		}

		if(param.shape == 'circle')
			fshape.set('rx', w).set('ry', h);
		else if(param.shape == 'rect')
			fshape.set('width', w).set('height', h);

		canvas.renderAll(true); 
	}

	// Mouseup
	function mouseup(e) {
		if(param.started) {
			param.started = false;
			param.allSelected(true, canvas);
			canvas.deactivateAll();
			canvas.renderAll(true);
		}
	}
    /* ********************************************************************************************** *
    * ********************************** Text Edit Handler ****************************************** *
    * *********************************************************************************************** */

    function setStyle(object, styleName, value) {
      if (object.setSelectionStyles && object.isEditing) {
        var style = { };
        style[styleName] = value;
        object.setSelectionStyles(style);
      }
      else {
        object[styleName] = value;
      }
    }
    function getStyle(object, styleName) {
      return (object.getSelectionStyles && object.isEditing)
        ? object.getSelectionStyles()[styleName]
        : object[styleName];
    }

    function addHandler(id, fn, eventName) {
        document.getElementById(id)[eventName || 'onclick'] = function() {
            var el = this;
            if (obj = canvas.getActiveObject()) {
                fn.call(el, obj);
                canvas.renderAll();
            }
        };
    }
    
    addHandler('textBold', function(obj) {
      var isBold = getStyle(obj, 'fontWeight') === 'bold';
      setStyle(obj, 'fontWeight', isBold ? '' : 'bold');
    });

    addHandler('textItalic', function() {
      var isItalic = getStyle(obj, 'fontStyle') === 'italic';
      setStyle(obj, 'fontStyle', isItalic ? '' : 'italic');
    });

    addHandler('textUnderline', function(obj) {
      var isUnderline = (getStyle(obj, 'textDecoration') || '').indexOf('underline') > -1;
      setStyle(obj, 'textDecoration', isUnderline ? '' : 'underline');
    });

    addHandler('textLineThrough', function(obj) {
      var isLinethrough = (getStyle(obj, 'textDecoration') || '').indexOf('line-through') > -1;
      setStyle(obj, 'textDecoration', isLinethrough ? '' : 'line-through');
    });
    
    addHandler('colorPickerText', function(obj) {
      setStyle(obj, 'fill', this.value);
    }, 'onchange');
    
    addHandler('colorPickerBackground', function(obj) {
      setStyle(obj, 'textBackgroundColor', this.value);
    }, 'onchange');
    
    addHandler('sizePickerText', function(obj) {
      setStyle(obj, 'fontSize', parseInt(this.value, 10));
    }, 'onchange');
    
    addHandler('fontPicker', function(obj) {
      setStyle(obj, 'fontFamily', this.value);
    }, 'onchange');
    
});

