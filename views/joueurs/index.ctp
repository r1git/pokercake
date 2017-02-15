<h1>Classement <?php 
	if($all==1)
		echo 'Officiel ';
	else
		echo 'Informatif ';
	if($annee>=2007 && $mois>0)
		echo $mois.'/';
	if($annee>=2007)		
		echo $annee;
	else
		echo 'global';
?>:</h1>

<table>
    <tr>
        <th>Rang</th>
        <th>Nom</th>
        <th>Score</th>
        <th>Ratio</th>
        <th>Jou&eacute;es</th>
	<th>Organis&eacute;es</th>
    </tr>

    <?php $count=1; foreach($everybody as $joueur): ?>
    <tr<?php if($count%2==0) echo ' class="altRow"' ?>>
        <td><?php echo $count;
		  $delta = $joueur[5]-$count; 
		  echo " (";
		  if($delta==0)
			echo "=";
		  else { if($delta>0) 
			echo "+".$delta;
			else echo $delta;
		  }
		  echo ")"; ?></td>
        <td>
            <?php echo $html->link($joueur[3], "/joueurs/bilan/".$joueur[4].'/'.$annee.'/'.$mois); ?>
        </td>
        <td><?php echo $joueur[0]; ?> &euro;</td>
        <td><?php $ratio=$joueur[0]/$joueur[1]; echo round($ratio,2); ?> &euro;</td>
        <td><?php echo $joueur[1]; ?> / <?php echo $totalp; ?></td>
        <td><?php if($joueur[2]>0) 
			echo $html->link($joueur[2], "/parties/orga/".$joueur[4]); 
		  else
			echo $joueur[2];
	?> / <?php echo $totalp; ?></td>
    </tr>
    <?php $count++; endforeach; ?>
</table>
<?php echo $this->element('navig', array("filtre" => "true", "bilan" => "false")); ?>
