$(document).ready(function () {
	$('#formsign').validate({
		 highlight: function(element) {
	        $(element).closest('.input-group').addClass('has-error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.input-group').removeClass('has-error').addClass('has-success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-block',
	    errorPlacement: function(error, element) {
	        if(element.parent('.input-group').length) {
	            error.insertAfter(element.parent());
	        } else {
	            error.insertAfter(element);
	        }
	    }
	});
	
	$('#comicForm,#stripForm').validate({
		 rules: {
			 'strips[]': {
			 required: true,
			 extension: "jpeg|bmp|png|tiff|tif|jpg"
			 }
		},
		 highlight: function(element) {
	        $(element).closest('.form-group').addClass('has-error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
	    },
	    errorElement: 'p',
	    errorClass: 'help-block',
	    errorPlacement: function(error, element) {
	        if(element.parent('.input-group').length 
	        	|| element.prop('type') === 'checkbox' 
	        	|| element.prop('type') === 'radio' 
	        	|| element.prop('type') === 'file' ) {
	            error.insertAfter(element.parent());
	        } else {
	            error.insertAfter(element);
	        }
	    }
	});
});