<?php

class Party extends AppModel
{
    var $name = 'Party';

    var $validate = array(
        'date'  => VALID_NOT_EMPTY
    );

    var $hasMany = array('Resultat' =>
                        array('className'    => 'Resultat',
                              'conditions'   => '',
                              'order'        => 'score DESC',
                              'dependent'    =>  true,
                              'foreignKey'   => 'party_id'
                        )
    );

    var $belongsTo = array('Joueur' =>
                           array('className'  => 'Joueur',
                                 'conditions' => '',
                                 'order'      => '',
                                 'foreignKey' => 'joueur_id'
                           )
                     );
}

?>
