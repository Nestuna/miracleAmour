<?php
    session_start() ; 
    require("../Model/Model.php");
    $m = Model::getModel();
    
    
    if (isset($_GET['id_usr_dest'])) {$id_usr_dest = $_GET['id_usr_dest'];}
    
    $id_usr = $_SESSION['id_usr'] ; 
 
    $last_message = $m->getLastMessage($id_usr,$id_usr_dest);

    if (isset($_GET['id_dernier_message'])) {
        $id_dernier_message = $_GET['id_dernier_message'];
        $_SESSION['id_dernier_message'] = $id_dernier_message ; 
    }
    else{
        $id_dernier_message = $_SESSION['id_dernier_message'] ;
        $_SESSION['id_dernier_message'] =  $last_message['id_message'] ; 
    }

    $date = new DateTime($last_message['date']); 

    $heure = $date->format('H') ;
    $min_date =  $date->format('i - d/m/Y') ;

    if($id_dernier_message == $last_message['id_message']){
        $html = false ; 
    }

    else{
        if($last_message['id_envoyeur'] == $id_usr){
                
            $html ='<div class="row justify-content-end ">
            <div class="col-6 message text-right" data-id="'.$last_message['id_message'].'">
                <div class="nom-message">Moi</div>
                <div class="message-expediteur rounded">
                    <p>'.$last_message['message'].'</p> 
                </div>
                <div class="date-message">'.$heure.'h'.$min_date.'</div>
            </div>
        </div>';
        }
        else{
            $receveur = $m->get_profil($id_usr_dest) ;

            $html ='<div class="row justify-content-start ">
            <div class="col-6 message" data-usr="'.$last_message['id_message'].'">
                <div class="nom-message">'.ucfirst($receveur[0]['prenom']).' '.ucfirst($receveur[0]['nom']).'</div>
                <div class="message-destinataire rounded">
                    <p>'.$last_message['message'].'</p> 
                </div>
                <div class="date-message">'.$heure.'h'.$min_date.'</div>
            </div>
        </div>';
        
        }



        echo $html;
    }

    

?>