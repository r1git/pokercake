<?php

class Resultat extends AppModel
{
    var $name = 'Resultat';
    
    var $belongsTo = array('Party' =>
		           array('className'  => 'Party',
                                 'conditions' => '',
                                 'order'      => '',
                                 'foreignKey' => 'party_id'
                           )
                     );
    
}
?>
