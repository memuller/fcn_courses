jQuery(document).ready( function($) {

	// Masks: personal information and phones
	$('#data_nascimento').mask('99/99/99') ;
	$('#cpf').mask('999.999.999-99') ;
	$('#rg').mask('99 999-999');
	$('#tel_fixo').mask('(99) 9999-9999') ;
	$('#celular').mask('(99) 9999-9999') ;

	// Validations: follows validations rules set on each field's 'class' property.
	$("form#registry").validate();
	
	/* Address:
	 * masks CEP,
	 * when 8 digits are inserted on CEP field, uses it to fetch other addres fields and shows them.
	 * * if CEP is invalid or an error happens, inform about it and show fields for manual edition. */
	$('#endereco_cep').mask('99999-999') ;
	$('#endereco_cep').on('keyup', function(event){
		if($(this)[0].value.length >= 8){
			$(this).cep({
				success: function(data){ 
					$('#endereco_rua')[0].value = data.logradouro ;
					$('#endereco_bairro')[0].value = data.bairro ;
					$('#endereco_estado')[0].value = data.estado ;
					$('#endereco_cidade')[0].value = data.cidade ;
					$('#address_fields').show('fast');
				},
				error: function(data){
					$('#endereco').prepend("<div class='failure'> Seu cep não foi encontrado. Se tiver certeza que o digitou corretamente, insira o restante do seu endereço manualmente abaixo. </div>") ;
					$('#address_fields').show('fast');
				} 
			}) ;
		}
	});
});