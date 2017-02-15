<?php
class Party extends AppModel {
	var $name = 'Party';
	var $displayField = 'date';

	var $belongsTo = array(
		'Joueur' => array(
			'className' => 'Joueur',
			'foreignKey' => 'joueur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Resultat' => array(
			'className' => 'Resultat',
			'foreignKey' => 'party_id',
			'dependent' => true,
			'conditions' => '',
			'order' => 'score DESC',
		)
	);

}
