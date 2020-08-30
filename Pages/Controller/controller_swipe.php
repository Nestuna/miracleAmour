<?php 

/*Swipe ! 
Infos à récupérer: Photo, nom, âge, résumé de la description. 
On utilise la méthode usr_match qui renvoie un tableau avec l'id_usr des matchs.
depuis le tableau usr_match, on récupère les infos du profil.
On utilise les méthodes get_profil et get_photo pour afficher les informations dont on a besoin.
• AJAX : Like / Dislike
    ◦ Envoie d’une requête POST avec object = { POST[‘like’]  =  true / false, POST[‘id_usr’] }
    ◦ Recup par requête GET du prochain profil*/

require("../Model/Model.php") ;
$m = Model::getModel();
session_start() ;
$_SESSION['id_usr'] = 2 ;  
if(isset($_SESSION['id_usr'])) {
    $tab_match = $m->usr_match($_SESSION['id_usr']);
}


/*On utilise le tableau de match pour récupérer les infos du profil. 
On crée un tableau de profils avec les éléments du profil, les clés sont les id_usr 
et les valeurs sont un tableau des attributs de chaque profil, on y ajoute les urls
des photos */
$html = '' ; 
$i = 0 ; 

$info_utilisateur = $m -> get_profil($_SESSION['id_usr']) ;

/*age_usr*/
$now = new DateTime("now") ;
$annive = new DateTime($info_utilisateur[0]["date_naissance"]) ; 
$age_usr = date_diff($now,$annive) ->format("%y") ;

/*sexe & orientation*/

$sexe_usr = $info_utilisateur[0]["sexe"] ; 
$orientation_usr =  $info_utilisateur[0]["orientation_sexe"] ; 
 
foreach($tab_match as $key => $value){
    $profils[$i] = $m->get_profil($key);
    $profils[$i][0]['url_photo'] = $m->get_photo($key);

    if(!empty($profils[$i][0]["url_photo"])){
        $url_photo = $profils[$i][0]["url_photo"] ; 
    }
    else{
        $url_photo = "Images/alper_number_one.jpeg" ; 
    }

    $now = new DateTime("now") ;
    $annive = new DateTime($profils[$i][0]["date_naissance"]) ; 
    $age = date_diff($now,$annive) ->format("%y") ;

    $prenom = ucfirst($profils[$i][0]["prenom"]) ;

    $sexe = $profils[$i][0]["sexe"] ; 
    $orientation =  $profils[$i][0]["orientation_sexe"] ;
    
    $description = $profils[$i][0]["description"] ; 


    //il faut afficher les profils avec du html:
    if(abs($age_usr-$age) <= 15 && $orientation_usr == $sexe && $sexe_usr == $orientation){
        $html .='<div id="portrait" data-id='.$profils[$i][0]["id_usr"].'> 
                    <div id="photo-profil" class="row justify-content-center">
                        <div class="col">
                            <img class="img-fluid" src="'.$url_photo.'">
                        </div>                
                    </div>
                    <div id="infos" class="row justify-content-center">
                        <div class="col-md-4">
                            <p>'.$prenom.', '.$age.'</p> 
                        </div>
                    </div>
                    <div id="resume" class="row justify-content-center">
                        <div id="description" class="col-md-4">
                            <p>'.$description.'</p>
                        </div>
                    </div>
                </div>' ;
    }
    
    $i+=1 ; 
}

   

/*var_dump($tab_match);*/
/*var_dump($profils) ; */

echo $html ;


$m ->match($id_like,$id_usr) ; 

/*if(isset($_POST['like']){
    if($_POST['like'] == true){
        $m = insertMatch($_SESSION['id_usr'],$profils['id_usr'],0);
        return next $profils;
    }
    else{
        return next $profils;
    }
}
else {
    $this->action_error("There is no Alper with such ID!!!");
}*/

?>