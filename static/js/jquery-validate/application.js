    $(document).ready(function(){

        $("#vestibular_especial").validate();
        
        //APLICAÇÃO DAS MASCARAS
        $('.mask-data').mask('99/99/9999'); //data
        $('.mask-hora').mask('99:99'); //hora
        $('.mask-fone').mask('(99) 9999-9999'); //telefone
        $('.mask-cpf').mask('999.999.999-99'); //RG
        $('.mask-cep').mask('99999-999'); //RG


    
    
    });    