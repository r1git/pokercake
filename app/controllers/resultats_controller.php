<?php

class ResultatsController extends AppController
{
    var $name = 'Resultats';

    function index()
    {
        $this->set('resultats', $this->Resultat->findAll(null, null, 'score DESC'));
    }

    function del($id, $retour)
    {
 	$this->checkSession();	
        if($this->Resultat->del($id)) {
	        $this->flash('Resultat effacé', '/parties/view/'.$retour);
	}
    }
}

?>
