$(document).ready(function() {
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
	      o.selectable = selectable;
	      //o.set({left: o.get('left') + 200, top: o.get('top') + 200});
	    });
	}

	TBCanvasParam.prototype.allActive = function(active, canvas) {
		canvas.deactivateAll();
		canvas.forEachObject(function(o) {
    		o.set('active', active);
    	});
    	canvas.renderAll();
	}

	TBCanvasParam.prototype.allSelected = function(selected, canvas) {
		canvas.deactivateAll();
		if(selected){
			canvas.setActiveGroup(new fabric.Group(canvas.getObjects()));
		}
		canvas.renderAll();
	}

	TBCanvasParam.prototype.desactivateButton = function(){
		$('#rect' ).css('border-color', '#fff');
		this.shape = false;
		this.allSelectable(true, canvas);
		$('#viewAll' ).css('border-color', '#fff');
		this.viewAll = false;
		this.allActive(false, canvas);
		$('#brush' ).css('border-color', '#fff');
		canvas.isDrawingMode = false;
		$('#selectAll' ).css('border-color', '#fff');
		this.selectAll = false;
		this.allSelected(false, canvas);
		$('#update' ).css('border-color', '#fff');
		this.update = false;
	}


	TBCanvasParam.prototype.activateButton = function(id){
		$(id).css('border-color', '#f00');
	}

 // ***********************************************************************************************

	var canvas = new fabric.Canvas('c')
	canvas = canvas;
	canvas.backgroundImage = new fabric.Image('i', {
	  left: 0,
	  top: 0,
	  angle: 0,
	  opacity: 1
	});

	var param = new TBCanvasParam();

	canvas.freeDrawingBrush.width = 20; // defautl brush size
	canvas.freeDrawingBrush.color = '#fff'; // defautl brush color
	canvas.renderAll();

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

	$('#rect' ).click(function() {
		if(!param.shape) {
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
	//$("body").keydown( function(e) { alert(e.keyCode); }); // affiche keyCode
	$("body").keydown( function(e) { if(e.keyCode == 17 || e.keyCode == 224) {this.ctr = true;} });
	$("body").keyup( function(e) { if(e.keyCode == 17 || e.keyCode == 224) {this.ctr = false;} });
	$("body").keydown( function(e) {
		if(this.ctr) {
			if(e.keyCode == 65) {
				$('#selectAll' ).click();
			}
			else if(e.keyCode == 84) {
				$('#viewAll' ).click();
			}
			else if(e.keyCode == 8) {
				$('#del' ).click();
			}
		}
	});
	//65 => a
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
		        fill: '#fff'
		    });
	    }
	    else {
	    	fshape = new fabric.IText('Nouveau texte', { 
			  selectable: true,
		  	  hasControls: true,
			  fontFamily: 'arial',
			  left: param.x, 
		      top: param.y,
		      width: 0, 
		      height: 0, 
			  fontSize: 12
			});
			param.shape = false;
			param.started = false;
	    }

	    canvas.add(fshape); 
	    canvas.renderAll();
	    canvas.setActiveObject(fshape); 
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

	    
	    fshape.set('width', w).set('height', h);
	    canvas.renderAll(); 
	}

	// Mouseup
	function mouseup(e) {
		if(param.started) {
	        param.started = false;
	        //shape = false;
	        var fshape = canvas.getActiveObject();
	        canvas.remove(fshape);
	       	canvas.add(fshape);
		 	canvas.deactivateAll();
		 	canvas.renderAll();
	    }
	}
});