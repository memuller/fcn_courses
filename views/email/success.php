<table border="0" cellspacing="0" cellpadding="0" style="width:600px;font-family:arial,sans-serif;">
	<tr>
		<th style="text-align:left;">
			<img src="http://www.fcn.edu.br/wp-content/themes/faculdade/images/logotipo.png" alt="Faculdade Canção Nova">
		</th>
	</tr>
	<tr>
		<td>
			<h1 style="color: #0883BE;font-size: 18px;font-weight: normal; margin-bottom: 12px; margin-top: 20px;">Olá <?php printf(__("Olá %s,"), $registree->person->first_name()) ?></h1>
			<p style="color:#008000;font-size:12px;line-height:150%;">
				Você está recebendo esse email porque a sua inscrição foi efetivada com sucesso no curso<strong><?php echo $course->post_title ?></strong><br/>
			</p>
			<hr>
			<h1 style="color: #0883BE;font-size: 18px;font-weight: normal; margin-bottom: 12px; margin-top: 20px;">Resumo do Cadastro</h1>
			<p style="color:#333333;font-size:12px;line-height:150%;">
				Nome: <?php echo $registree->person->name ?> <br/>	
				Email: <?php echo $registree->person->email ?> <br/>
				Curso: <?php echo $course->post_title ?> <br/>
				Período: <?php echo $class->start_date . " à " . $class->end_date ?> <br/>
				Horário:  <?php echo $class->human_time ?><br/>
				Local: As aulas serão ministradas no campus da Faculdade Canção Nova. Para saber como chegar lá, acesse <a href="http://www.fcn.edu.br/contato/como-chegar/">http://www.fcn.edu.br/contato/como-chegar/</a>
				
			</p>
			
			<hr>
			<p style="color:#333333;font-size:12px;line-height:150%;">
				*Em caso de dúvidas e-mail: faleconosco@fcn.edu.br ou Telefone: (12) 3186 2000 <br/>
				*Para solucionar qualquer dúvida, guarde com você o comprovante de depósito.
			</p>
		</td>
	</tr>
</table>