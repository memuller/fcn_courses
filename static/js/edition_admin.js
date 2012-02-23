jQuery(document).ready( function($) {
	$('.inlineDatePicker').datepick()

	// kills token from wp_list_table ; otherwise publishing classes won't work.
	$('#publish').on('click', function(event){
		$('#class-registrees #_wpnonce').remove();
	});
});