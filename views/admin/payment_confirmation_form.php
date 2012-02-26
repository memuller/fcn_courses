<div class="box-registree_receipt postbox" id="registree_<?php echo $registree->id ?>_receipt">
	<h3><?php _e("Comprovante de pagamento de ".$registree->person->first_name() ) ?></h3>
	<div class='inside'>
		<?php echo  $registree->receipt() ; ?>
	</div>
	<input type="button" value="Recusar" class='button-secundary registree-payment-button' 
		<?php html_attributes(array('id' => 'refuse_registree_payment_'. $registree->id)) ?> >
	<input type="button" value="Aprovar" class='button-primary registree-payment-button' 
		<?php html_attributes(array('id' => 'accept_registree_payment_'. $registree->id)) ?> >
</div>