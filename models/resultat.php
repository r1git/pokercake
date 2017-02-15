<?php
class Resultat extends AppModel {
	var $name = 'Resultat';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Joueur' => array(
			'className' => 'Joueur',
			'foreignKey' => 'joueur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Party' => array(
			'className' => 'Party',
			'foreignKey' => 'party_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
