<?php
/* Resultat Fixture generated on: 
Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected the timezone 'UTC' for now, but please set date.timezone to select your timezone. in /usr/share/php/cake/console/templates/default/classes/fixture.ctp on line 24
2017-02-13 15:51:41 : 1487001101 */
class ResultatFixture extends CakeTestFixture {
	var $name = 'Resultat';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'joueur_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'party_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'score' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'joueur_id' => 1,
			'party_id' => 1,
			'score' => 1
		),
	);
}
