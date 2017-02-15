<?php
class Joueur extends AppModel {
	var $name = 'Joueur';
	var $displayField = 'nom';
	
	var $hasMany = array('Resultat' => 
			array('className' => 'Resultat',
			'foreignKey' => 'joueur_id',
			'dependent' => true,
			'conditions' => '',
			'order' => '',
		)
	);

}
