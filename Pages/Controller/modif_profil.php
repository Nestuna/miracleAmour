<?php
    require("../Model/Model.php") ;
    $n =Model::getModel() ;
    session_start() ; 
    


    var_dump($_POST) ;
    echo $_SESSION['id_usr'] ;

    if(!empty($_POST['orientation'])){
        $n -> update_profile1($_SESSION['id_usr'] , $_POST['orientation']) ; 
    }
    if(!empty($_POST['description'])){
        $n -> update_profile($_SESSION['id_usr'] , $_POST['description']) ; 
    }

    if (!empty($_POST['cinema'])){
        $n -> insert_cine($_SESSION['id_usr'] , $_POST['cinema']) ; 
    }

    if (!empty($_POST['Litterature'])){
        $n -> insert_litterature($_SESSION['id_usr'] , $_POST['Litterature']) ; 
    }

    if (!empty($_POST['Musique'])){
        $n -> insert_musique($_SESSION['id_usr'] , $_POST['Musique']) ; 
    }

    if (!empty($_POST['Sport'])){
        $n -> insert_sport($_SESSION['id_usr'] , $_POST['Sport']) ; 
    }
    
    header("Location: ../../index.php?page=profil");
    exit();

?>