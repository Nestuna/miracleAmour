<?php
    session_start() ; 
    require("../Model/Model.php") ;
    $n =Model::getModel() ;
    
    /*partie filtrage*/
    
    $tab = $n ->  usr_recherche(1,1,1,4,"autre") ;
    $info_utilisateur = $n -> get_profil(72) ; 
    $i = 0 ; 
    foreach($tab as $key=>$value){ 

        $info_filtre = $n -> get_profil($value[$i]) ;

        if($info_filtre[$i]['orientation_sexe'] == $info_utilisateur[$i]['sexe']){
            $usr_filtrer[$i] = $info_filtre[$i] ; 
        }
        $i=$i+1 ; 
    }
    
    
    
    
    var_dump($info_filtre) ; 
    var_dump($info_utilisateur) ; 
    var_dump($usr_filtrer) ; 
   
    /*partie reponse */

    $html = '' ; 
    foreach($usr_filtrer as $value){
        $now = new DateTime("now") ;
        $annive = new DateTime($value["date_naissance"]) ; 
        $age = date_diff($now,$annive) ->format("%y") ;
        
        


        $html.= '<div id="profil'.$value["id_indiv"].'" class="col-lg-6">
            <div class="row ">
                <div id="photo" class="col-md-4"> 
                    <img class="img-fluid img-thumbnail" src="Images/alper_number_one.jpeg" alt="alper"> 
                </div>
                <div id="informations" class="col-md-4">
                    <ul>
                        <li id="prenom"><h2>'.$value["prenom"].'</h2></li>
                        <li id="ville">'.$value["ville"].'</li>
                        <li id="sexe">'.$value["sexe"].'</li>
                        <li id="orientation">Open</li>
                        <li id ="profession">Fumiste</li>
                        <li id="age">'.$age.'</li>
                    </ul>                 
                </div>
                <div id="texte-description" class="col-md-4">
                    <p>"Blabla blabla blabla Blabla blabla blabla askim Vinson"</p> 
                    <button type="button" class="btn btn-info btn-lg">Voir profil</button>
                </div>
            </div>
            </div>' ; 
    }

    echo $html ; 
    
    
  


?>