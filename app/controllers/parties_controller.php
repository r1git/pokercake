<?php

class PartiesController extends AppController
{
    var $name = 'Parties';
    var $uses = array('Party', 'Joueur', 'Resultat');

    function index()
    {
        $this->set('parties', $this->Party->findAll(null, null, 'date DESC'));
    }
	
    function rss()
    {
	$this->layout='xml';
	$this->set('parties', $this->Party->findAll(null, null, 'date DESC', 15));
	$this->set('listenoms',
                $this->Joueur->generateList(
                        null,
                        'nom ASC',
                        null,
                        null,
                        '{n}.Joueur.nom',
                        '{n}.Joueur.id')
        );
    }

    function orga($id = null)
    {
	$joueur = $this->Joueur->find('id ='.$id);
	if($joueur['Joueur']['compagnon']>0)
		$req = ' OR joueur_id ='.$joueur['Joueur']['compagnon'];
	else
		$req = '';
	$this->set('parties', $this->Party->findAll('joueur_id ='.$id.$req, null, 'date DESC'));
	$this->render('index');
    }

    function last()
    {
	$lastparty = $this->Party->findAll(null, null, 'date DESC', 1, 0);
	$this->redirect('/parties/view/'.$lastparty['0']['Party']['id']);
    }

    function view($id = null)
    {
        if (!empty($this->data))
        {
	    $this->checkSession();
            $this->Resultat->save($this->data);
        }

        $this->Party->id = $id;
	$this->set('id', $id);
        $this->set('party', $this->Party->read());
	$this->set('listenoms',
                $this->Joueur->generateList(
                        null,
                        'nom ASC',
                        null,
                        null,
                        '{n}.Joueur.nom',
                        '{n}.Joueur.id')
        );
    }

    function add()
    {
	$this->set(
		'listenoms', 
		$this->Joueur->generateList(
                        null,
                        'nom ASC',
                        null,
                        null,
                        '{n}.Joueur.nom',
                        '{n}.Joueur.id')
	);

        if (!empty($this->data))
        {
	    $this->checkSession();
            if (!$this->Party->save($this->data))
            {
                $this->flash('Erreur lors de l\'ajout','/parties/add');
            } else
		$this->redirect('/parties/view/'.$this->Party->getLastInsertId());
        }
    }

    function del($id)
    {
	$this->checkSession();
       	$this->Party->del($id);
       	$this->flash('Partie effacée', '/parties');
    }
}
?>
