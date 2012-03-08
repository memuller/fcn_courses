jQuery(document).ready( function($) {

	$('#payment-confirmation a').live('click', function(event){
		$('#text-paste').toggle('fast');
		$('#file-upload').toggle('fast') ;
	});

});