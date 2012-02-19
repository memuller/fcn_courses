jQuery(document).ready(function($) {
	//do validate for waiting list
	$("form#registry").validate({
		rules:{
			mail:{
				required:true,
				email:true
			}
		}
	});
});
