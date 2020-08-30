<?php
    session_start();
    $id_usr = $_SESSION['id_usr'] ;
    require("../Model/Model.php") ;
    $m = Model::getModel();
    // INSERER MESSAGE

    $m -> insert_chat($id_usr, $_POST['id_usr_dest'], $_POST['message']) ; 
    header("Content-Type: text/html");
    echo "coucou";

?>