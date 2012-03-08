jQuery(document).ready( function($) {

	$('#payment-confirmation a').on('click', function(event){
		$('#text-paste').toggle('fast');
		$('#file-upload').toggle('fast') ;
	});

});