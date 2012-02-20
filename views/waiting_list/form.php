<div id="waitee" >
	<h2>Lista de espera</h2>
	
	<?php if($success) : ?>
			<?php echo Presenter::render_partial('waiting_list/success', array('waitee' => $waitee)); ?>
	<?php endif ?>
		
	<?php if(isset($success) && ! $success) : ?>
			<?php echo Presenter::render_partial('waiting_list/failure') ; ?>
	<?php endif ?>
	
	<p>
		Não há classes abertas para este curso agora, mas você
		pode se inscrever aqui para ser notificado quando uma for
		aberta.
	</p>
	<form <?php html_attributes(array ('name' => 'waitee_signup', 'action' => '', 'method' => 'POST')); ?>>
		<div class="field">
			<label for="waitee[person_name]" >
				Nome *
			</label>
			<input <?php html_attributes(array ('name' => 'waitee[person_name]', 'id' => 'waitee[person_name]', 'type' => 'text')); ?> />
		</div>
		<div class="field">
			<label for="waitee[person_email]" >
				Email *
			</label>
			<input <?php html_attributes(array ('name' => 'waitee[person_email]', 'id' => 'waitee[person_email]', 'type' => 'text')); ?> />
		</div>
		<div class="field">
			<label for="waitee[person_phone]">
				Telefone
			</label>
			<input<?php html_attributes(array ('name' => 'waitee[person_phone]', 'id' => 'waitee[person_phone]', 'type' => 'text')); ?> />
		</div>
		
		<input <?php html_attributes(array ('value' => 'Inscrever', 'type' => 'submit', 'id' => 'submit')); ?> />
		<input <?php html_attributes(array ('name' => 'waitee[active]', 'value' => 1, 'type' => 'hidden')); ?> />
		<input <?php html_attributes(array ('name' => 'action', 'value' => 'waitee_signup', 'type' => 'hidden')); ?> />
		<input <?php html_attributes(array ('name' => 'waitee[course_id]', 'value' => $post->ID, 'type' => 'hidden')); ?> />
		<input <?php html_attributes(array ('name' => 'nonce', 'value' => wp_create_nonce('waitee_signup'), 'type' => 'hidden')); ?> />
	</form>
</div>