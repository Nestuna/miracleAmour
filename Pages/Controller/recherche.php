<?php 
    require("../Model/Model.php") ;
    $n =Model::getModel() ;
    session_start() ;

    if(!empty($_POST)){

        //INIT TAB FOR SEARCH 
    
        $tab_litte = array_key_exists('litte' , $_POST) ? $_POST['litte'] : [1] ;
        $tab_cine = array_key_exists('cinema' , $_POST) ? $_POST['cinema'] : [1] ; 
        $tab_musique = array_key_exists('musique' , $_POST) ? $_POST['musique'] : [1] ; 
        $tab_sport = array_key_exists('sport' , $_POST) ? $_POST['sport'] : [1] ; 
        
        
        //INIT VAR SEX AND AGE 
        $sexe = array_key_exists('sexe' , $_POST) ? $_POST['sexe'] : $n -> getOrientation($_SESSION['id_usr']) ;
        $age = $_POST['age'] ; 
        


        
        $tab_pref = $n -> usr_recherche($tab_cine[0],$tab_litte[0],$tab_musique[0],$tab_sport[0],$sexe);
        if(empty($tab_pref)){
            $tab_pref[0] = [] ; 
            for($i = 0 ; $i < 10 ; $i+=1){
                array_push( $tab_pref[0], rand(1,45) ) ; 
            }
        }
         
        
         



        //HTML FAIRE UNE BOUCLE
        $i = 0 ; 
        $html = '' ; 
        while( $i < sizeof($tab_pref[0])){

            $tab_info_usr = $n -> get_profil($tab_pref[0][$i]) ;
            
            if(empty($tab_info_usr)){
                $i+=1 ; 
            }
            
            
            else{
                
                $url_photo = empty($n -> get_photo($tab_pref[0][0])) ?  "Images/alper_number_one.jpeg" : $n -> get_photo($tab_pref[0][0]) ; 
                $html .= 
                '
                <div id="profil1" class="col-lg-6">
                    <div class="row ">
                        <div id="photo" class="col-md-4"> 
                            <img class="img-fluid img-thumbnail" src="'.$url_photo.'" alt="alper"> 
                        </div>
                        <div id="informations" class="col-md-4">
                            <ul>
                                <li id="prenom"><h2>'.ucfirst($tab_info_usr[0]['prenom']).' '.ucfirst($tab_info_usr[0]['nom']).'</h2></li>
                                <li id="ville">'.ucfirst($tab_info_usr[0]['ville']).'</li>
                                <li id="sexe"> Est : '.ucfirst($tab_info_usr[0]['sexe']).'</li>
                                <li id="orientation"> Aime : '.ucfirst($tab_info_usr[0]['orientation_sexe']).'</li>
                                <li id="age">'.date_diff(new DateTime("now"),new DateTime($tab_info_usr[0]['date_naissance']))->format("%y").' ans</li>
                            </ul>                 
                        </div>
                        <div id="texte-description" class="col-md-4">
                            <p>"'.$tab_info_usr[0]['description'].'"</p> 
                            <button type="button" class="btn btn-info btn-lg"><a href="./Pages/Controller/relation.php?id_usr='.$tab_pref[0][$i].'">Envoie un message</a></button>
                        </div>
                    </div>
                </div>
                ';

                $i+=1 ; 
            }
            
        
        }
        echo $html ; 

        

        








        
    }
    else{
        echo "Erreur 402" ; 
    }



    




?>