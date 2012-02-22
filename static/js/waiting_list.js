jQuery(document).ready(function($) {

	// Masks phone number.
	$('#waitee_phone').mask('(99) 9999-9999') ;

	// Validations: follows validations rules set on each field's 'class' property.
	$("#waitee form").validate();
});
