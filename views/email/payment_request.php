<table border="0" cellspacing="0" cellpadding="0" style="width:600px;font-family:arial,sans-serif;">
	<tr>
		<th style="text-align:left;">
			<p style="font-size:10px;font-weight:normal;">
				caso não esteja visualizando esse email acesse: <a href="<?php echo $registree->payment_url() ?>"><?php echo $registree->payment_url() ?></a>
			</p>
			<img src="http://www.fcn.edu.br/wp-content/themes/faculdade/images/logotipo.png" alt="Faculdade Canção Nova">
		</th>
	</tr>
	<tr>
		<td>
			<h1 style="color: #0883BE;font-size: 18px;font-weight: normal; margin-bottom: 12px; margin-top: 20px;">
				<?php printf(__("Olá %s,"), $registree->person->first_name()) ?>
			</h1>
			<p style="color:#008000;font-size:12px;line-height:150%;">
				Você está recebendo esse email porque se inscreveu para o curso <strong><?php echo $course->post_title ?></strong><br/>
				Para confirmar sua inscrição, você precisa realizar o pagamento correspondente no prazo de 5 dias; <br/>
				
			</p>
			
			<p style="color:#333333;font-size:12px;line-height:150%;">
				Você pode encontrar as instruções para fazê-lo em <a href="<?php echo $registree->payment_url() ?>">aqui.</a>
			</p>
			<hr>
			<p style="color:#333333;font-size:12px;line-height:150%;">
				*O não pagamento da taxa de inscrição implica na não efetivação da inscrição.<br>
				*Em caso de dúvidas e-mail: faleconosco@fcn.edu.br ou Telefone: (12) 3186 2000 <br>
				*Para solucionar qualquer dúvida, guarde com você o comprovante de depósito.		 
			</p>
		</td>
	</tr>
</table>