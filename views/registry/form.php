<h2>Inscrição para o curso</h2>

<?php if (isset($success) && ! $success): ?>
	<?php echo Presenter::render_partial('registry/registration_failure') ?>
<?php endif ?>

<form action="#confirm" id="registry" method="post">
	<?php if (isset($is_admin) && $is_admin): ?>
		<div class="failure">
			<?php _e("Você está logado como editor. Você pode cadastrar alunos <strong>VIP</strong> (que estarão automaticamente confirmados, e não precisarão pagar)."); ?>
			<div>
				<input type="checkbox" name="registree[vip]" value="true">
				<?php _e("<strong>Sim</strong>, quero cadastrar um usuário VIP.") ?>
			</div>
		</div>
		<?php if (isset($success) && $success): ?>
			<div class="success">
				<?php _e('Você cadastrou com sucesso um usuário VIP.') ;?>
			</div>
		<?php endif ?>
	<?php endif ?>
	<fieldset id="informacoes_pessoais">

		<legend>Informações pessoais</legend>
		<label for="nome">Nome:</label>
		<input class="required" id="nome" name="registree[person_name]" type="text" value="">
			<div class="sexo required">
				<label for="feminino">Feminino:</label>
				<input checked="checked" id="feminino" name="registree[person_gender]" type="radio" validate="required:true" value="feminino" />
				<label for="masculino" id="masc">Masculino:</label>
				<input id="masculino" name="registree[person_gender]" type="radio" value="masculino" />
				<label class="error" for="sexo" style="display:none;">Por favor selecione o sexo.</label>
			</div>
			<label for="data_nascimento">Data de nascimento:</label>
			<input class="required litle" id="data_nascimento" name="registree[person_birthdate]" type="text" value="">
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
		<input class="required litle rg" id="rg" name="registree[person_rg]" type="text" value="">
			<br>
				<label for="cpf">CPF:</label>
				<input class="required cpf litle" id="cpf" name="registree[person_cpf]" type="text" value="" />
			</br>
		</input>
	</fieldset>
	<fieldset id="contato">
		<legend>Contato</legend>
		<label for="mail">E-mail:</label>
		<input class="required email" id="mail_mail" name="registree[person_email]" type="text" value="">
			<label for="tel_fixo">Telefone:</label>
			<input class="required litle" id="tel_fixo" name="registree[person_phone]" type="text" value="">
				<label for="celular">Celular:</label>
				<input class="litle" id="celular" name="registree[person_mobile]" type="text" value="" />
			</input>
		</input>
	</fieldset>
	<fieldset id="endereco">
		<legend>Endereço</legend>
		<label for="cep">CEP<small> (ao preencher o restante das informações serão completadas automaticamente) | </small><small><a href="http://www.buscacep.correios.com.br/" target="blank"> Não sei o cep do meu endereço.</a></small></label>
		<input class="required mask-cep litle" id="endereco_cep" name="registree[person_address_zip]" type="text" value="">
			<div id="address_fields">
				<label for="rua">Rua (Av. etc.):</label>
				<input class="required" id="endereco_rua" name="registree[person_address_street]" type="text" value="">
					<label for="numero">Numero:</label>
					<input class="required digits litle" id="endereco_numero" name="registree[person_address_number]" type="text" value="" />
				</input>
			
				<label for="complemento">Complemento:</label>
				<input id="endereco_complemento" name="registree[person_address_complement]" type="text" value="">
				<label for="complemento">Bairro:</label>
				<input id="endereco_bairro" name="registree[person_address_district]" type="text" value="">
					<div>
						<label for="endereco_estado">Estado:</label>
					</div>
					<input class="required" id="endereco_estado" name="registree[person_address_state]" type="text">
						<label for="cidade">Cidade:</label>
					</input>
					<input class="required" id="endereco_cidade" name="registree[person_address_city]" type="text" />
				</input>
			</input>
		</div>
	</fieldset>
	<fieldset id="situação_especial">
		<legend>Necessidade especial</legend>
		<label for="">Selecione se possui alguma necessidade especial:</label>
		<select id="situacao_especial" name="registree[person_disability]" size="1">
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