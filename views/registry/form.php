<h2>Inscrição para o curso.</h2>
<form action="" id="registry" method="post">
	<fieldset id="informacoes_pessoais">
		<legend>Informações pessoais</legend>
		<label for="nome">Nome:</label>
		<input class="required" id="nome" name="registry[person_name]" type="text" value="">
			<div class="sexo required">
				<label for="feminino">Feminino:</label>
				<input checked="checked" id="feminino" name="registry[person_gender]" type="radio" validate="required:true" value="feminino" />
				<label for="masculino" id="masc">Masculino:</label>
				<input id="masculino" name="registry[person_gender]" type="radio" value="masculino" />
				<label class="error" for="sexo" style="display:none;">Por favor selecione o sexo.</label>
			</div>
			<label for="data_nascimento">Data de nascimento:</label>
			<input class="required litle" id="data_nascimento" name="registry[person_birthdate]" type="text" value="">
				<div id="">
					<label for="naturalidade">Natural de:</label>
					<input class="required litle" id="naturalidade0" name="naturalidade" type="text" value="">
						<label for="uf">Estado de:</label>
						<select class="required comboboxrequired litle" id="uf0" name="uf" value="">
							<option value="0">Selecione um Estado</option>
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AM">Amazonas</option>
							<option value="AP">Amapá</option>
							<option value="BH">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espírito Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MG">Minas Gerais</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MT">Mato Grosso</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="PR">Paraná</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="RS">Rio Grande do Sul</option>
							<option value="SC">Santa Catarina</option>
							<option value="SE">Sergipe</option>
							<option value="SP">São Paulo</option>
							<option value="TO">Tocantins</option>
							<option value="AC">Outra cidade</option>
						</select>
					</input>
				</div>
			</input>
		</input>
	</fieldset>
	<fieldset id="documentacao">
		<legend>Documentação</legend>
		<label for="rg">RG:</label>
		<input class="required litle" id="rg" name="registry[person_rg]" type="text" value="">
			<br>
				<label for="cpf">CPF:</label>
				<input class="required mask-cpf litle" id="cpf" name="registry[person_cpf]" type="text" value="" />
			</br>
		</input>
	</fieldset>
	<fieldset id="contato">
		<legend>Contato</legend>
		<label for="mail">E-mail:</label>
		<input class="required email" id="mail_mail" name="registry[person_email]" type="text" value="">
			<label for="tel_fixo">Telefone:</label>
			<input class="required mask-fone litle" id="tel_fixo" name="registry[person_phone]" type="text" value="">
				<label for="celular">Celular:</label>
				<input class="required litle" id="celular" name="registry[person_mobile]" type="text" value="" />
			</input>
		</input>
	</fieldset>
	<fieldset id="endereco">
		<legend>Endereço</legend>
		<label for="cep">CEP:</label>
		<input class="required mask-cep litle" id="cep" name="registry[person_address_cep]" type="text" value="">
			<div>
				<label for="rua">Rua (Av. etc.):</label>
				<input class="required" id="rua" name="registry[person_address_street]" type="text" value="">
					<label for="numero">Numero:</label>
					<input class="required litle" id="numero" name="registry[person_address_number]" type="text" value="" />
				</input>
			</div>
			<label for="complemento">Complemento:</label>
			<input id="complemento" name="registry[person_address_complement]" type="text" value="">
			<label for="complemento">Bairro:</label>
			<input id="complemento" name="registry[person_address_district]" type="text" value="">
				<div>
					<label for="endereco_uf">Estado:</label>
				</div>
				<input class="required" id="endereco_uf" name="registry[person_address_state]" type="text">
					<label for="cidade">Cidade:</label>
				</input>
				<input class="required" id="cidade" name="registry[person_address_city]" type="text" />
			</input>
		</input>
	</fieldset>
	<fieldset id="situação_especial">
		<legend>Necessidade especial</legend>
		<label for="">Selecione se possui alguma necessidade especial:</label>
		<select id="situacao_especial" name="registry[person_disability]" size="1">
			<option value="">Não possuo</option>
			<option value="motion">Locomotora</option>
			<option value="seeing">Visual</option>
			<option value="hearing">Auditiva</option>
			<option value="other">Outros</option>
		</select>
	</fieldset>
	<input id="inscrever" name="inscrever" type="submit" value="Inscreva-me" />
	<input <?php html_attributes(array ('name' => 'action', 'value' => 'registree_signup', 'type' => 'hidden')); ?> />
	<input <?php html_attributes(array ('name' => 'registree[class_id]', 'value' => $class->ID, 'type' => 'hidden')); ?> />
	<input <?php html_attributes(array ('name' => 'nonce', 'value' => wp_create_nonce('registree_signup'), 'type' => 'hidden')); ?> />
</form>