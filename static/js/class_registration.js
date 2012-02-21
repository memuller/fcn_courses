jQuery(document).ready( function($) {

	$('#data_nascimento').mask('99/99/99') ;
	$('#cpf').mask('999.999.999-99') ;
	$('#rg').mask('99 999-999');
	$('#address_fields').hide(0);
	$('#endereco_cep').mask('99999-999') ;
	$('#endereco_cep').on('keyup', function(event){
		if($(this)[0].value.length >= 8){
			$(this).cep({success: function(data){ 
				$('#endereco_rua')[0].value = data.logradouro ;
				$('#endereco_bairro')[0].value = data.bairro ;
				$('#endereco_estado')[0].value = data.estado ;
				$('#endereco_cidade')[0].value = data.cidade ;
				$('#address_fields').show('fast');
			}}) ;
		}
	});
});