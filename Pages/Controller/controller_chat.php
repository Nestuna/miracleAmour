<?php 


/*contrôleur chat  
Récupérer le dernier message envoyé, les 10 derniers messages envoyé, l'id envoyeur et receveur.
Utilisation des méthodes getId_receveur, getMessages, getLastMessage*/

    require("../Model/Model.php") ;
    $m = Model::getModel();

    session_start() ; 
    $id_usr = $_SESSION['id_usr']  ;


    if (isset($_GET['id_usr_dest'])) {$id_usr_dest = $_GET['id_usr_dest'];}
    if (isset($_POST['id_usr_dest'])) {$id_usr_dest = $_POST['id_usr_dest'];}
     
    if (isset($_GET['methode'])) {$methode = $_GET['methode'];}
    if (isset($_POST['methode'])) {$methode = $_POST['methode'];}
        
    
    // LISTE USERS
    if(isset($_SESSION['id_usr']) && $methode == "usrList") {
        $list_match = $m ->recupMatch($_SESSION['id_usr']) ; 
        
        
        if(empty($list_match[0]) && empty($list_match[1])){
            $html = '<p>MATCH AVEC UNE PERSONNE</p>' ; 
            echo $html ; 
            exit() ; 
        }
        
        else{
            $html = '' ; 
            $i = 0 ;
            while($i<sizeof($list_match[0])){
                $last_message = $m->getLastMessage($_SESSION['id_usr'],$list_match[0][$i][0]) ;
                $destinataire = $m->get_profil($list_match[0][$i][0]) ;

                 
                if(empty($last_message)){
                    $last_message['message'] = 'SEND NUDE' ; 
                }

                $html .= '<div class="col-12 block-usr" data-user='.$destinataire[0]['id_usr'].'>
                            <div class="usr-list-nom">
                                <h4>'.ucfirst($destinataire[0]['prenom']).' '.ucfirst($destinataire[0]['nom']).'</h4>
                            </div>
                            <div class="usr-list-lastMessage">
                                <p>
                                '.$last_message['message'].'
                                </p>
                            </div>
                        </div>';
                
                $i+=1 ;
            }

           
            $i = 0 ; 
            while($i<sizeof($list_match[1])){
                $last_message = $m->getLastMessage($_SESSION['id_usr'],$list_match[1][$i][0]) ;
                $destinataire = $m->get_profil($list_match[1][$i][0]) ;

                if(empty($last_message)){
                    $last_message['message'] = 'SEND NUDE' ; 
                }

                $html .= '<div class="col-12 block-usr" data-user="'.$destinataire[0]['id_usr'].'">
                            <div class="usr-list-nom">
                                <h4>'.ucfirst($destinataire[0]['prenom']).' '.ucfirst($destinataire[0]['nom']).'</h4>
                            </div>
                            <div class="usr-list-lastMessage">
                                <p>
                                '.$last_message['message'].'
                                </p>
                            </div>
                        </div>';
                
                $i+=1 ;
            }
            echo $html ;
            exit(); 
        }
        
    }

    // DERNIERS MESSAGES
    if(isset($_SESSION['id_usr']) && $methode = "lastConversation") {
        $nb_messages = $_GET['nb_messages'];
        $last_messages = $m -> getMessages($id_usr, $id_usr_dest, $nb_messages) ;
        $html = '' ; 
        $receveur = $m->get_profil($id_usr_dest) ;
        $id_dest = $receveur[0]['id_usr'];

        // if(empty($last_messages)){
        //     $html = "<p class='accueil-chat text-center'>Commence le chat ! &#x1F609; et surtout SEND NUDE &#129488;</p>" ; 
        //     echo $html ;
        //     exit() ;
        // }

        foreach($last_messages as $key => $value){

           
            $date = new DateTime($value['date']); 

            $heure = $date->format('H') ;
            $min_date =  $date->format('i - d/m/Y') ;
            
            


            if($value['id_envoyeur'] == $_SESSION['id_usr']){
                
                
                
                $html.='<div class="row justify-content-end ">
                        <div class="col-6 message text-right" data-id="'.$value['id_message'].'">
                            <div class="nom-message">Moi</div>
                            <div class="message-expediteur rounded">
                                <p>'.$value['message'].'</p> 
                            </div>
                            <div class="date-message">'.$heure.'h'.$min_date.'</div>
                        </div>
                    </div>';
            }
            else {
                $html.='<div class="row justify-content-start ">
                <div class="col-6 message" data-id="'.$value['id_message'].'">
                    <div class="nom-message">'.ucfirst($receveur[0]['prenom']).' '.ucfirst($receveur[0]['nom']).'</div>
                    <div class="message-destinataire rounded">
                        <p>'.$value['message'].'</p> 
                    </div>
                    <div class="date-message">'.$heure.'h'.$min_date.'</div>
                </div>
            </div>';
            }
        }

        header('Content-Type: text/html');
        echo $html;
        exit();
    }


?>