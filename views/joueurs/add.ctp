<div class="joueurs form">
<?php echo $this->Form->create('Joueur');?>
	<fieldset>
		<legend><?php __('Nouveau Joueur'); ?></legend>
	<?php
		echo $this->Form->input('nom');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php echo $this->element('navig'); ?>
