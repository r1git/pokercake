<div class="parties form">
<?php echo $this->Form->create('Party');?>
	<fieldset>
		<legend><?php __('Nouvelle partie'); ?></legend>
	<?php
		echo $this->Form->input('date');
		echo $this->Form->input('joueur_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php echo $this->element('navig'); ?>
