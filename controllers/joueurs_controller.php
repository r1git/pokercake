<?php
set_time_limit(400);

class JoueursController extends AppController
{
    var $helpers = array('Cache');
    var $cacheAction = true;

    var $name = 'Joueurs';
    var $uses = array('Joueur', 'Party');

    function indexaux($all=1, $annee=0, $mois=0)
    {
	$this->set('mois', $mois);
	if($mois>0 && $mois<10)
		$mois = '0'.$mois;
	if($annee==0)
		$annee=date("Y");	
	if($annee==1)
		$condi=array();
	else {
		if($mois==0)
			$range=$annee.'0101 AND '.$annee.'1231';	
		else
			$range=$annee.$mois.'01 AND '.$annee.$mois.'31';
		$condi = array('date(Party.date) BETWEEN '.$range);
	}
	$games = $this->Party->find('all', array('conditions' => $condi));
	$totalp = sizeof($games);
	$this->set('totalp', $totalp);
	$this->set('annee', $annee);
	$this->set('all', $all);
	$everybody=array();

	$count=0;	
	$SCORE=0;
	$NBRPARTIES=1;
	$ORGA=2;
	$NOM=3;
	$JOUEUR_ID=4;
	$LASTRATE=5;

        foreach($games as $game) {
		foreach($game['Resultat'] as $resultat) {
			$joueur_id = $resultat['joueur_id'];
			if(!isset($everybody[$joueur_id])) {
				$everybody[$joueur_id][$SCORE]=0.0;
				$everybody[$joueur_id][$NBRPARTIES]=0;
				$everybody[$joueur_id][$JOUEUR_ID]=$joueur_id;
			}				
			$everybody[$joueur_id][$SCORE]=bcadd($everybody[$joueur_id][$SCORE], $resultat['score'], 2);
			$everybody[$joueur_id][$NBRPARTIES]++;
		}
	}
	
	
	if(sizeof($everybody)!=0) {	
	foreach($everybody as $joueur_id => $joueur) {
		if($joueur[$NBRPARTIES]==0 || ($all!=2 && $joueur[$NBRPARTIES]<$totalp*0.1))
			unset($everybody[$joueur_id]);
		else {
			$player = $this->Joueur->find('id ='.$joueur_id, null, null, 0);
			$cond_aux = array('OR' => array(
				array('Joueur.id' => $joueur_id)));
			if($player['Joueur']['compagnon']>0)
				$cond_aux['OR'] += array('Joueur.compagnon' => $joueur_id);	
				
			$everybody[$joueur_id][$ORGA]= $this->Party->find('count', array('conditions'=>$condi+$cond_aux));
			$everybody[$joueur_id][$NOM]= $player['Joueur']['nom'];	
		}
	}
	
	foreach ($everybody as $key => $row) {
		$score[$key] = $row[$SCORE];
		$jouees[$key] = $row[$NBRPARTIES];
		$organisees[$key] = $row[$ORGA];
		$names[$key] = $row[$NOM];
	}

	$aux = $everybody;
	$aux = serialize($aux);	
	array_multisort($score, SORT_DESC, SORT_NUMERIC,
			$jouees, SORT_DESC, SORT_NUMERIC,
			$organisees, SORT_DESC, SORT_NUMERIC,
			$names, SORT_ASC, SORT_STRING,
			$everybody);
	$aux = unserialize($aux);

	$lastparty = $this->Party->find('all', array('conditions' => $condi), null, 'date DESC', 1, 0);

	if(isset($aux[$lastparty['0']['Party']['joueur_id']]))
		$aux[$lastparty['0']['Party']['joueur_id']][$ORGA]--;		
	foreach($lastparty['0']['Resultat'] as $lastresultat) {
		if(isset($aux[$lastresultat['joueur_id']])) {
			$aux[$lastresultat['joueur_id']][$SCORE]-=$lastresultat['score'];
			$aux[$lastresultat['joueur_id']][$NBRPARTIES]--;
		}
	}
			
	foreach ($aux as $key2 => $row2) {
		$score2[$key2] = $row2[$SCORE];
		$jouees2[$key2] = $row2[$NBRPARTIES];
		$organisees2[$key2] = $row2[$ORGA];
		$names2[$key2] = $row2[$NOM];
	}	


	$everybody = serialize($everybody);
	array_multisort($score2, SORT_DESC, SORT_NUMERIC,
			$jouees2, SORT_DESC, SORT_NUMERIC,
			$organisees2, SORT_DESC, SORT_NUMERIC,
			$names2, SORT_ASC, SORT_STRING, 
			$aux);
	$everybody = unserialize($everybody);

	$count=1;
	foreach($aux as $old) {
		foreach($everybody as $key => $new) {
			if($new[$JOUEUR_ID]==$old[$JOUEUR_ID]) {
				$everybody[$key][$LASTRATE]=$count;
				$count++;
				break;
			}
		}
	}	
	}
	return $everybody;
    }

    function index($all=1, $annee=0, $mois=0) {
	$tout = $this->indexaux($all,1);
	if(sizeof($tout)!=0)
		$this->set('tout', $tout[0][3]);
	else
		$this->set('tout', '?');
	for($year=2007;$year<=date("Y");$year++) {
		$an = $this->indexaux($all,$year);
		if(sizeof($an)!=0)
			$anne[$year-2007] = $an[0][3];
	}
	$this->set('anne', $anne);
	if($annee!=1) {
	for($i=1;$i<13;$i++) {
		$aux = $this->indexaux($all, $annee, $i);
		if(sizeof($aux)!=0) { 
			$lesmois[$i]=$aux[0][3];
		}
		else
			$lesmois[$i]='?';
		$this->set('lesmois', $lesmois);
	}
	}
	$this->set('everybody', $this->indexaux($all,$annee,$mois));	
    }

    function view($id=2){
    	$this->set('joueur', $this->Joueur->find('id ='.$id, null, null, 3));
     }

    function bilan($id = 2, $annee=0, $mois=0)
    {
	ini_set('memory_limit', '256M');
	$this->set('mois', $mois);
	if($mois>0 && $mois<10)
		$mois = '0'.$mois;
	if($annee==0)
		$annee=date("Y");	
	if($annee==1)
		{$start='0000-00-00'; $end='9999-99-99'; }
	else {
		if($mois==0)
			{$start=$annee.'-01-01'; $end=$annee.'-12-31';}
		else
			{$start=$annee.'-'.$mois.'-01'; $end= $annee.'-'.$mois.'-31';}
	}

	$this->set('id', $id);
	$this->set('annee', $annee);
	$resultats = $this->Joueur->find('id ='.$id, null, null, 3);
	$fric['Joueur']=$resultats['Joueur'];	

	$totalpar=0;
	foreach($resultats['Resultat'] as $res) {
		if($res['Party']['date']>=$start && $res['Party']['date']<=$end) {
			$som=0;
			$totalpar++;
			foreach($res['Party']['Resultat'] as $player)
				if($player['score']>0) 						
					$som+=$player['score'];	
			if($res['score']<0) {
				foreach($res['Party']['Resultat'] as $player) {
					if($player['score']>0) {
						if(!isset($fric[0][$player['joueur_id']]))
							$fric[0][$player['joueur_id']]=0;
						if(!isset($fric[1][$player['joueur_id']]))
							$fric[1][$player['joueur_id']]=0;
						if(!isset($fric[3][$player['joueur_id']]))
							$fric[3][$player['joueur_id']]=0;
						$fric[3][$player['joueur_id']]++;
						$fric[1][$player['joueur_id']]+=($player['score']*$res['score'])/$som;
						if(!isset($noms[$player['joueur_id']])) {
							$tmp=$this->Joueur->find('id ='.$player['joueur_id'], 'nom', null, -1);
							$noms[$player['joueur_id']]=$tmp['Joueur']['nom'];
						}
					}
				}
			} else {				
				foreach($res['Party']['Resultat'] as $player) {
					if($player['score']<0) {
						if(!isset($fric[0][$player['joueur_id']]))
							$fric[0][$player['joueur_id']]=0;
						if(!isset($fric[1][$player['joueur_id']]))
							$fric[1][$player['joueur_id']]=0;
						if(!isset($fric[3][$player['joueur_id']]))
							$fric[3][$player['joueur_id']]=0;
						$fric[3][$player['joueur_id']]++;
						$fric[0][$player['joueur_id']]-=($player['score']*$res['score'])/$som;
						if(!isset($noms[$player['joueur_id']])) {
							$tmp=$this->Joueur->find('id ='.$player['joueur_id'], 'nom', null, -1);
							$noms[$player['joueur_id']]=$tmp['Joueur']['nom'];
						}
					}
				}
			}
		}
	}

	$this->set('totalpar', $totalpar);
	foreach($fric[0] as $jid => $score) {
		$fric[0][$jid] = round($fric[0][$jid],2);
		$fric[1][$jid] = round($fric[1][$jid],2);
		$fric[2][$jid] = round($fric[0][$jid]+$fric[1][$jid],2);
	}	

	if(isset($fric[2]))
		arsort($fric[2]);
	$this->set('fric', $fric);
	if(isset($noms))
		$this->set('noms', $noms);
    }

    function add()
    {
        if (!empty($this->data))
        {
            if ($this->Session->check('User') and $this->Joueur->save($this->data))
            {
                $this->flash('Joueur ajouté','/joueurs');
            }
        }
    }
}

?>
