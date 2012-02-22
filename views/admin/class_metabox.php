<div id="parent_course">
	<?php echo "Curso:" ?>
	<strong> <?php echo $courses_menu ?> </strong>
</div>
<div id="start_date">
	<?php echo "Início:" ?>
	<strong> <input type="text" class="inlineDatePicker" name="start_date" size="8" value="<?php echo $edition->start_date ?>"></strong>
</div>
<div id="end_date">
	<?php echo "Término:" ?>
	<strong> <input type="text" class="inlineDatePicker" name="end_date" size="8" value="<?php echo $edition->end_date ?>"></strong>
</div>