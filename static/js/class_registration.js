jQuery(document).ready( function($) {

	$('input#cep').on('keyup', function(event){
		if($(this)[0].value.length >= 8){
			$(this).cep({success: function(data){ 
				$('input#rua')[0].value = data.logradouro ;
				$('input#bairro')[0].value = data.bairro ;
				$('input#endereco_uf')[0].value = data.estado ;
				$('input#cidade')[0].value = data.cidade ;
			}}) ;
		}
	});
});