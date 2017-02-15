<?php

class PartiesController extends AppController
{
    var $name = 'Parties';
    var $uses = array('Party', 'Joueur', 'Resultat');

    function index()
    {
        $this->set('parties', $this->Party->find('all', array('order' => 'date DESC')));
    }
	
    function rss()
    {
	$this->layout='xml';
	$this->set('parties', $this->Party->find('all', null, null, 'date DESC', 15));
	$this->set('listenoms',
                $this->Joueur->find('list', array(
			'order' => 'nom ASC',
                        'fields' => array('Joueur.id', 'Joueur.nom')))
        );
    }

    function orga($id = null)
    {
	$joueur = $this->Joueur->find('id ='.$id);
	if($joueur['Joueur']['compagnon']>0)
		$req = ' OR joueur_id ='.$joueur['Joueur']['compagnon'];
	else
		$req = '';
	$this->set('parties', $this->Party->find('all', 'joueur_id ='.$id.$req, null, 'date DESC'));
	$this->render('index');
    }

    function last()
    {
	$lastparty = $this->Party->find('all', array('order' => 'date DESC', 'limit' => 1));
	$this->redirect('/parties/view/'.$lastparty['0']['Party']['id']);
    }

    function view($id = null)
    {
        $this->Party->id = $id;
	$this->set('id', $id);
        $this->set('party', $this->Party->read());
	$this->set('joueurs',
                $this->Joueur->find('list', array(
			'order' => 'nom ASC',
                        'fields' => array('Joueur.id', 'Joueur.nom')))
        );
    }

    function add()
    {
	$this->set('joueurs',
                $this->Joueur->find('list', array(
			'order' => 'nom ASC',
                        'fields' => array('Joueur.id', 'Joueur.nom')))
        );

        if (!empty($this->data))
        {
            if (!$this->Session->check('User') or !$this->Party->save($this->data))
            {
                $this->flash('Erreur lors de l\'ajout','/parties/add');
            } else
		$this->redirect('/parties/view/'.$this->Party->getLastInsertId());
        }
    }

    function del($id)
    {
	if ($this->Session->check('User'))
	{
       		$this->Party->delete($id);
		$this->redirect($this->referer());
	} else
       		$this->flash('Unauthorized', '/parties');
    }
}
?>
