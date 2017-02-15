<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected the timezone 'UTC' for now, but please set date.timezone to select your timezone. in /usr/share/php/cake/console/templates/default/classes/test.ctp on line 22
/* Resultat Test cases generated on: 2017-02-13 15:51:41 : 1487001101*/
App::import('Model', 'Resultat');

class ResultatTestCase extends CakeTestCase {
	var $fixtures = array('app.resultat', 'app.joueur', 'app.party');

	function startTest() {
		$this->Resultat =& ClassRegistry::init('Resultat');
	}

	function endTest() {
		unset($this->Resultat);
		ClassRegistry::flush();
	}

}
