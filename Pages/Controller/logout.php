<?php 
    session_start() ; 
    if(!empty($_SESSION["id_usr"])){
        session_destroy() ; 
        header("Location: ../../index.php?page=login");
        exit();
    }
    else{
        echo "COUCOU" ;
    }





?>