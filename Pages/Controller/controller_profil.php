<?php 


/*contrôleur profil
On récupère l'id_usr et on renvoie sa page de profil.
Utilisation des méthodes usr_pref, get_photo, get_profil*/

require("../Model/Model.php") ;
$m = Model::getModel();

session_start() ; 

    
// On recupère toutes les infos, les préférences et la photo de l'utilisateur dans 3 tableaux:
if(isset($_SESSION['id_usr'])) {
    $tab_profil = $m->get_profil($_SESSION['id_usr']);
    $tab_pref = $m->usr_pref($_SESSION['id_usr']);
    $photo = $m->get_photo($_SESSION['id_usr']);
}   

if($photo == null){
    $photo = "../../Images/alper_number_one.jpeg" ; 
}



    //var_dump($tab_profil);
    //var_dump($tab_pref);
    //var_dump($photo);

    /*age*/
    $now = new DateTime("now") ;
    $annive = new DateTime($tab_profil[0]["date_naissance"]) ; 
    $age = date_diff($now,$annive) ->format("%y") ;


    //variables pour chaque élément du profil:
    $prenom = $tab_profil[0]["prenom"] ;
    $ville = $tab_profil[0]["ville"] ;
    $sexe = $tab_profil[0]["sexe"] ;
    $orientation =  $tab_profil[0]["orientation_sexe"] ; 
    $profession = "Alper's fan";
    $description =  $tab_profil[0]["description"] ;
    $citation = "SEND NUDE NOW!"; 

    //variables pour les préférences:
    $cinema[0] = $m->get_prefCinema($tab_pref[0]['id_cinema']);
    $litterature[0]= $m->get_prefLitterature($tab_pref[0]['id_litterature']);
    $musique[0]= $m->get_prefMusique($tab_pref[0]['id_musique']);
    $sport[0]= $m->get_prefSport($tab_pref[0]['id_sport']);

    if (!empty($tab_pref)){
        for($i=1; $i<sizeof($tab_pref);$i++){
            if(!empty($tab_pref[$i]["id_cinema"]) && ($tab_pref[$i]['id_cinema'] != $tab_pref[$i-1]['id_cinema'])){
                 
                array_push($cinema, $m->get_prefCinema($tab_pref[$i]['id_cinema']));   
            }
            if(!empty($tab_pref[$i]["id_litterature"]) && ($tab_pref[$i]['id_litterature'] != $tab_pref[$i-1]['id_litterature'])){
                array_push($litterature, $m->get_prefLitterature($tab_pref[$i]['id_litterature']));    
            }
            if(!empty($tab_pref[$i]['id_musique']) && $tab_pref[$i]['id_musique'] !== $tab_pref[$i-1]['id_musique']){
                array_push($musique, $m->get_prefMusique($tab_pref[$i]['id_musique']));
            }
            if(!empty($tab_pref[$i]['id_sport']) && $tab_pref[$i]['id_sport'] !== $tab_pref[$i-1]['id_sport']){
                array_push($sport , $m->get_prefSport($tab_pref[$i]['id_sport']));
            }
        }     
    }

    /*var_dump($cinema);
    var_dump($litterature);*/
        
    $html ='<div class="row">
                <div id="image-profil" class="col-md-2">
                    <img class="img-fluid img-thumbnail" src="'.$photo.'" alt="'.ucfirst($prenom).'">  
                </div>
                <div class="col-md-4">
                    <ul>
                        <li id="prenom"><h2>Prenom: '.ucfirst($prenom).'</h2></li>
                        <li id="ville">Ville: '.ucfirst($ville).'</li>
                        <li id="sexe">Sexe: '.ucfirst($sexe).'</li>
                        <li id="orientation">Orientation: '.ucfirst($orientation).'</li>
                        <li id ="profession">Profession: '.ucfirst($profession).'</li>
                        <li id="age">'.ucfirst($age).' ans</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <p>"'.$citation.'"</p>
                </div>
            </div>

                    
            <div class="row no-gutters">
                <div class="col">
                    <h2>Description</h2>       
                </div>

                <div class="w-100"></div>

                <div class="col">
                    <p id="texte-description">
                        '.$description.'
                    </p>
                </div>
            </div>



            <div class="row">
                <div class="col">
                    <h2>Intérêts</h2>
                </div>

                <div class="w-100"></div>

                                            
                <div class="col-md-3" id="col-cinema">
                    <h4>Cinéma</h4>
                    <ul>';
        
            foreach($cinema as $key=>$value){
                $html.= '<li>'.ucfirst($value['nom_genre']).'</li>';
            };

            
            $html.= '</ul>
                </div>
                <div class="col-md-3" id="col-litte">
                    <h4>Littérature</h4>
                    <ul>';
            
            foreach($litterature as $key=>$value){
                $html.= '<li>'.ucfirst($value['nom_litterature']).'</li>';
            };
            
            $html.='</ul>
                    
                </div>
                <div class="col-md-3" id="col-musique">
                    <h4>Musique</h4>
                    <ul>';

            foreach($musique as $key=>$value){
                $html.= '<li>'.ucfirst($value['nom_musique']).'</li>';
            };

            $html.= '</ul>
                    
                </div>
                <div class="col-md-3" id="col-sport">
                    <h4>Sport</h4>
                    <ul>';

            foreach($sport as $key=>$value){
                $html.= '<li>'.ucfirst($value['nom_sport']).'</li>';
            };
            
            $html.='</ul>           
                </div>                 
            </div>';

    echo $html ;
?>