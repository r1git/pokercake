</div>
<div class="sidenav">
			<cake:nocache>
			<h1>Admin</h1>
			<ul>
			<?php if ($this->Session->check('User')) {?>
			   <li><?php echo $html->link('Ajouter une partie ', "/parties/add"); ?></li>
			   <li><?php echo $html->link('Ajouter un joueur', "/joueurs/add"); ?></li>
			   <li><?php echo $html->link('Logout', '/users/logout');?></li>
			<?php } else {?>
			   <li><?php echo $html->link('Login', '/users/login'); ?></li>
			<?php }?>
			</ul>
			</cake:nocache>
			<?php if ($filtre == "true") { ?>
			<h1>Filtres</h1>
			<ul>
				<li><?php if($annee==1) $txt='<b>Tout</b>'; else $txt='Tout';
					if($bilan == "true")
						echo $this->Html->link($txt, '/joueurs/bilan/'.$id.'/1', array('escape' => false));
					else
						echo $this->Html->link($txt.' - ('.$tout.')', '/joueurs/index/'.$all.'/1', array('escape' => false));
				?></li>
				<?php for ($year=date("Y"); $year>2006; $year--) {?>
				<li><?php if($annee==$year) $txt='<b>'.$year.'</b>'; else $txt=$year;
					if($bilan == "true")
						echo $this->Html->link($txt, '/joueurs/bilan/'.$id.'/'.$year, array('escape' => false));
					else
						echo $this->Html->link($txt.' - ('.$anne[$year-2007].')', '/joueurs/index/'.$all.'/'.$year, array('escape' => false));
				?></li>
				<?php } ?>
			</ul>
			<?php if($annee!=1) { ?>
			<h1>Mois</h1>
			<ul>
				<?php $nm = array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
				for($i=1; $i<13; $i++) {
					echo '<li>';
					if($i==$mois) $txt='<b>'.$nm[$i-1].'</b>'; else $txt=$nm[$i-1];
					if($bilan == "true")
						echo $this->Html->link($txt, '/joueurs/bilan/'.$id.'/'.$annee.'/'.$i, array('escape' => false));
					else
						echo $this->Html->link($txt.' - ('.$lesmois[$i].')', '/joueurs/index/'.$all.'/'.$annee.'/'.$i, array('escape' => false));
					echo '</li>';
				} ?>
			</ul>
			<?php } ?>
			<?php } ?>
