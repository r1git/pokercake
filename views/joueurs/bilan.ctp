<h1><?php echo $fric['Joueur']['nom'].' (sur '.$totalpar.' parties)';?></h1>

<table>
<tr>
        <th>Joueur</th>
	<th>Parties</th>
	<th>Gains</th>
        <th>Pertes</th>
	<th>Bilan</th>
</tr>
<?php if(isset($fric[2])) { ?> 
<?php $i=0; foreach ($fric[2] as $jid => $score): ?>
    <tr<?php if($i--%2==0) echo ' class="altRow"'; ?>>
        <td>
            <?php echo $html->link($noms[$jid], "/joueurs/bilan/".$jid.'/'.$annee.'/'.$mois); ?>
	</td>
	<td><?php echo $fric[3][$jid]; ?></td>
	<td><?php echo $fric[0][$jid]; ?> &euro;</td>
        <td><?php echo $fric[1][$jid]; ?> &euro;</td>
	<td><?php echo $fric[2][$jid]; ?> &euro;</td>
    </tr>
<?php endforeach; }?>
</table>
<?php echo $this->element('navig', array("filtre" => "true", "bilan" => "true")); ?>
