<h1><?php echo $joueur['Joueur']['nom']?></h1>

<table>
<tr>
	<th>Num</th>
        <th>Date</th>
	<th>Chez</th>
        <th>Score</th>
</tr>

<?php $total=0.0; $i=sizeof($joueur['Resultat'])+1; ?>
<?php foreach ($joueur['Resultat'] as $key => $resultat): ?>
    <tr<?php if($i%2==0) echo ' class="altRow"'?>>
	<td><?php $i--; echo $i; ?></td>
        <td>
            <?php echo $html->link($resultat['Party']['date'], "/parties/view/".$resultat['party_id']); ?>
	</td>
	<td>
	    <?php echo $html->link($resultat['Party']['Joueur']['nom'], "/parties/view/".$resultat['party_id']); ?>
        </td>
        <td><?php echo $resultat['score']; ?> &euro;</td>
	<?php $total=bcadd($total, $resultat['score'], 2); ?> 
    </tr>
<?php endforeach; ?>
<tr>
	<td></td>
	<td></td>
	<td><h2>Total</h2></td>
	<td><h2><?php echo $total ?> &euro;</h2></td>
</table>
<?php echo $this->element('navig', array("filtre" => "false")); ?>
