<h1>Resultats:</h1>
<table>
    <tr>
	<th>Num</th>
        <th>Joueur</th>
        <th>Chez</th>
        <th>Score</th>
    </tr>

   <!-- Here's where we loop through our $posts array, printing out post info -->
    <?php $i=0;?>
    <?php foreach ($resultats as $resultat): ?>
    <tr<?php if($i%2==0) echo ' class="altRow"' ?>>
	<td><?php echo $i; ?></td>
        <td>
            <?php echo $html->link($resultat['Joueur']['nom'], "/joueurs/view/".$resultat['Resultat']['joueur_id']); ?>
        </td>
        <td>
            <?php echo $html->link($resultat['Resultat']['party_id'], "/parties/view/".$resultat['Resultat']['party_id']); ?>
        </td>
        <td><?php echo $resultat['Resultat']['score']; ?> &euro;</td>
    </tr>
    <?php $i++; endforeach; ?>

</table>
<?php echo $this->element('navig'); ?>
