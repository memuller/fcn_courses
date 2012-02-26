jQuery(document).ready( function($) {
	$('.inlineDatePicker').datepick()

	// kills token from wp_list_table ; otherwise publishing classes won't work.
	$('#publish').on('click', function(event){
		$('#class-registrees #_wpnonce').remove();
	});


	$('.registree_show_payment_form').colorbox({
		inline:true, escKey: false, close:'',
		href: function(){return '#registree_' +this.id.split('_')[1] + '_receipt' ;},  
		onLoad: function(){
			$('#registree_'+ this.id.split('_')[1] +'_receipt').show();
		},
		onClosed: function(){
			$('#registree_'+ this.id.split('_')[1] +'_receipt').hide();	
		}
	}) ;

	$('.registree-payment-button').on('click', function(event){
		$('#post').append("<input type='hidden' id='registree_payment_change' name='registree_payment_change' value='"+this.id+  "' >" ) ;
		$('#publish').trigger('click');
	});
});