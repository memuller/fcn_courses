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
	
	//general
	$("#confirm #internet_banking a").click(function() {
		$("#transfer").show('fast');
	});
});
