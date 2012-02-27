<div id="signup_start">
	<?php echo "Abertura em:" ?>
	<strong>
		<input type="text" class="inlineDatePicker" name="signup_start_date" size="8" value="<?php echo $edition->signup_start_date ?>">
	</strong>
</div>

<div id="signup_end">
	<?php echo "Fechamento em:" ?>
	<strong>
		<input type="text" class="inlineDatePicker" name="signup_end_date" size="8" value="<?php echo $edition->signup_end_date ?>">
	</strong>
</div>

<div id="price">
	<?php echo "Preço:" ?>
	<strong>
		R$ <input type="text" name="signup_cost" size="5" value="<?php echo $edition->signup_cost ?>">
	</strong>
</div>

<div id="pending_signups_expiry_time">
	<?php echo "Inscrições não-pagas expiram em:" ?>
	<strong>
		<input type="text" name="pending_signups_expiry_time" size="3" value="<?php echo $edition->pending_signups_expiry_time ?>"> dias
	</strong>
</div>

<div id="spaces">
	<?php echo "Vagas:" ?>
	<strong>
		<input type="text" name="signup_spaces" size="5" value="<?php echo $edition->signup_spaces ?>">
	</strong>
</div>