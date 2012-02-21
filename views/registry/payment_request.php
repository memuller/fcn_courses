<?php $first_name = explode(' ', $registree->person_name) ; $first_name = $first_name[0] ; ?>
<div id="confirm">

	<h3>
		<?php printf(__("Olá %s,"), "<span>$first_name</span>" ) ?>
	</h3>

	<?php if (isset($success) && $success ) : ?>
		<?php echo Presenter::render_partial('registry/registration_successful', array('course' => $course)) ?>
	<?php endif ?>

	<p>
		<h2>Dados para pagamento:</h2>
		<ul>
			<li> Valor: <?php printf("R$ %01.2f", floatval($class->signup_cost) ) ?>
			<li> Banco: Santander - 033 </li>
			<li> Agencia: 0143 </li>
			<li> Conta Corrente: 13-003554-3 </li>
			<li> Razao Social: FAT - Fundaçao de Apoio a Tecnologia </li>
			<li> CNPJ: 58.415.092/0001-50 </li>
		</ul>
	</p>

	<ul id="steps">
		<li class="info">
			Sua inscrição ocorrerá em 3 etapas:
		</li>
		<li class="one">
			<span>Passo 1</span>
			<p>
				Faça um depósito na conta informada com o valor de inscrição
			</p>
		</li>
		<li class="due">
			<span>Passo 2</span>
			<p>
				Escaneie ou tire uma fotografia do comprovante de depósito.*
			</p>
			
		</li>
		<li class="tre">
			<span>Passo 3</span>
			<p>
				Envie esse arquivo no formulário abaixo.
			</p>
			
		</li>		
	</ul>
	<p id="internet_banking">
		<a href="#transfer">*Caso tenha feito transferência por internet banking</a>
	</p>
	
	<form action="" method="" accept-charset="utf-8" id="payment">
		<label for="envio">Selecione a imagem do comprovante de depósito</label>
		<input type="file" name="envio" value="" id="envio">
	</form>
	<form action="" method="" id="transfer">
			<label for="name">Caso tenha feito transferência por internet banking, preencha o campo ao lado</label>
			<textarea name="name" id="name" rows="8" cols="40"></textarea>
	</form>
	<hr />
	<h3>Resumo do seu cadastro</h3>
	<p>
		<ul>
			<li>Nome: <?php echo $registree->person_name ?> </li>
			<li>Email: <?php echo $registree->person_email ?> </li>
			<li>Curso: <?php echo $course->post_title ?></li>

		</ul>
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
	</p>
</div>