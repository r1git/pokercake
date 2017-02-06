<?php

class Joueur extends AppModel
{
    var $name = 'Joueur';

    var $validate = array(
        'nom'  => VALID_NOT_EMPTY
    );

    var $hasMany = array('Resultat' =>
                        array('className'    => 'Resultat',
                              'conditions'   => '',
                              'order'        => '',
                              'dependent'    =>  true,
                              'foreignKey'   => 'joueur_id'
                        )
    );

}

?>
