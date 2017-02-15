<?php

class ResultatsController extends AppController
{
    var $name = 'Resultats';

    function index()
    {
        $this->set('resultats', $this->Resultat->find('all', null, null, 'score DESC'));
    }

    function del($id, $retour)
    {
        if($this->Session->check('User') and $this->Resultat->delete($id)) {
		$this->redirect($this->referer());
	} else
		$this->flash('Unauthorized');
	
    }

    function add()
    {
	if (!empty($this->data))
        {
            if($this->Session->check('User'))
                $this->Resultat->save($this->data);
            else
                $this->flash('Unauthorized', '/parties');
        }
	$this->redirect($this->referer());
    }
}

?>
