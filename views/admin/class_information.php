<div id="class-info">
	<div>
		Inscritos: <strong><?php echo $class->confirmed_registrees() ?></strong> 
		<em>(<?php echo $class->vips() ?> vips)</em>
	</div>
	<div>
		Vagas disponíveis:  <strong><?php echo $class->remaining_spaces() ?></strong>
	</div>
	<div>
		Pendentes: <strong><?php echo $class->pending_registrees() ?></strong>
	</div>
	<div>
		Total arrecadado: <strong><?php printf("R$ %01.2f",  $class->income() ) ?></strong>
	</div>
</div>