<h1>Parties:</h1>
<table>
    <tr>
	<th>Num</th>
        <th>Date</th>
        <th>Chez</th>
	<th>Nbr joueurs</th>
	<?php if ($this->Session->check('User')) echo '<th></th>'; ?>
    </tr>

    <?php $i=0; $numb=sizeof($parties); ?>
    <?php foreach ($parties as $party): ?>
    <tr<?php if($i%2==0) echo ' class="altRow"' ?>>
	<td><?php echo $numb-$i;?></td>
        <td>
            <?php echo $html->link($party['Party']['date'], "/parties/view/".$party['Party']['id']); ?>
        </td>
        <td>
            <?php echo $html->link($party['Joueur']['nom'], "/parties/view/".$party['Party']['id']); ?>
        </td>
	<td><?php echo sizeof($party['Resultat']);?></td>
	<?php if ($this->Session->check('User')) {
		echo '<td>'; 
		echo $html->link('Del', "/parties/del/".$party['Party']['id'], null, 'Effacer cette partie ?'); 
		echo '</td>';
	} ?>
    </tr>
    <?php $i++; endforeach; ?>

</table>
<?php echo $this->element('navig'); ?>
