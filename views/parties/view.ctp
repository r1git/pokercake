<h1>Partie chez <?php echo $party['Joueur']['nom']?> le <?php echo $party['Party']['date']?></h1>
<table>
<tr>
	<th>Rang</th>
        <th>Joueur</th>
        <th>Score</th>
	<?php if ($this->Session->check('User')) echo '<th></th>'; ?>
</tr>
<?php $total=0.0; $i=0; ?>
<?php foreach ($party['Resultat'] as $key => $resultat): ?>
    <tr<?php if($i++%2==0) echo ' class="altRow"'?>>       
	<td><?php echo $i;?></td>
        <td>
            <?php echo $html->link($joueurs[$resultat['joueur_id']], "/joueurs/view/".$resultat['joueur_id']); ?>
        </td>
        <td><?php echo $resultat['score']; ?> &euro;</td>
	<?php $total=bcadd($total, $resultat['score'], 2); ?>
	<?php if ($this->Session->check('User')) {
		echo '<td>'; 
		echo $html->link('Del', "/resultats/del/".$resultat['id']."/".$id, null, 'Effacer ce resultat ?'); 
		echo '</td>';} ?>
    </tr>
<?php endforeach; ?>
<tr>
	<td></td>
	<td><h2>Total</h2></td>
	<td><h2><?php echo $total?> &euro;</h2></td>
	<?php if ($this->Session->check('User')) echo '<td></td>'; ?>
</tr>
</table>
<?php if($this->Session->check('User')) {?>
<div class="resultats form">
<?php echo $this->Form->create('Resultat', array('action'=>'add'));?>
        <fieldset>
                <legend><?php __('Nouveau resultat'); ?></legend>
        <?php
                echo $this->Form->input('joueur_id');
                echo $this->Form->input('score');
                echo $this->Form->hidden('party_id', array('value' => $id));
        ?>
        </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php }?>
<?php echo $this->element('navig'); ?>
