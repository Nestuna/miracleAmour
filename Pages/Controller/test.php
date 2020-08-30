<?php 
    require("../Model/Model.php") ;
    $n =Model::getModel() ;

    $tab = $n ->usr_match(72) ; 
    var_dump($tab);

    echo $n->getSex(8) ; 
    echo $n->getOrientation(8) ;
    
    
    echo $n->checkMatch(72) ; 
    




?>