<div id="confirm">

	<h3>
		<?php printf(__("Olá %s,"), "<span>".$registree->person->first_name()."</span>" ) ?>
	</h3>

	<?php if (isset($success) && $success ) : ?>
		<?php echo Presenter::render_partial('registry/registration_successful', array('course' => $course)) ?>
	<?php endif ?>

	<p>
		<h3>Dados para pagamento:</h3>
			Valor: <?php printf("R$ %01.2f", floatval($class->signup_cost) ) ?><br/>
			Banco do Brasil<br/>
			Agencia: 3358-8<br/>
			Conta Corrente: 5.894-7 <br/>
			Favorecido: Fundação João Paulo II.
	</p>

	<ul id="steps">
		<li class="info">
			Sua inscrição ocorrerá em 3 etapas:
		</li>
		<li class="one">
			<span>Passo 1</span>
			<p>
				Deposite ou transfira para a conta informada o valor da inscrição.
			</p>
		</li>
		<li class="due">
			<span>Passo 2</span>
			<p>
				Escaneie|Fotografe ou copie as informações do comprovante de depósito*
			</p>
			
		</li>
		<li class="tre">
			<span>Passo 3</span>
			<p>
				Envie a imagem do comprovante ou o cole as informações de confirmação da transferência.
			</p>
			
		</li>		
	</ul>
	<form <?php html_attributes(array( 'id' => 'payment-confirmation',
		'action' => '', 'method' => 'post', 'enctype' => 'multipart/form-data', 'accept-charset' => 'utf8')) ?> >
		
		<div id="file-upload">
			<label for="payment-confirmation[file]">
				<?php _e("Selecione a imagem contendo o comprovante do dépósito:") ?>
			</label>
			<input type="file" name="payment-confirmation[file]">

			<a href="#payment-confirmation"><?php _e("* Você deseja pagar através de transferência online?") ?></a>
		</div>
		
		<div id="text-paste">
			<label for="payment-confirmation[text]">
				<?php _e("Insira o texto do comprovante no seguinte campo:") ?>
				<br />
				<small> <?php _e("você pode fazer isso facilmente copiando e colando o comprovante na página de confirmação de transferência do seu banco.") ?> </small>
			</label>
			<textarea name="payment-confirmation[text]" cols="40" rows="8"></textarea>
			
			<a href="#payment-confirmation"><?php _e("escaneou ou fotografou o comprovante?") ?></a>
			
		</div>

		<input <?php html_attributes(array ('value' => __('Enviar comprovante'), 'type' => 'submit', 'id' => 'submit')); ?> />

		<?php // control fields ?>
		<input <?php html_attributes(array ('name' => 'action', 'value' => 'payment_confirmation', 'type' => 'hidden')); ?> />
		<input <?php html_attributes(array ('name' => 'payment-confirmation[registree_id]', 'value' => $registree->id, 'type' => 'hidden')); ?> />
		<input <?php html_attributes(array ('name' => 'nonce', 'value' => wp_create_nonce('payment_confirmation'), 'type' => 'hidden')); ?> />
	</form>

	<hr />
	<p>
		<h3>Resumo do seu cadastro</h3>
		Nome: <?php echo $registree->person->name ?><br/>
		Email: <?php echo $registree->person->email ?><br/>
		Curso: <?php echo $course->post_title ?>
	</p>
	
	<hr />
	
	<p>
		<small>
			*em caso de dúvidas e-mail: faleconosco@fcn.edu.br ou
			Telefone: (12) 3186 2000
		</small>
		<br />
		<small>
			*pressione ctrl+p para imprimir esse comprovante.
		</small>
		<br>
		<small>*Para solucionar qualquer dúvida, guarde com você o comprovante de depósito.</small>
	</p>
</div>