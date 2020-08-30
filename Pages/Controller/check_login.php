<?php 
    require("../Model/Model.php") ;
    $n =Model::getModel() ;

   

    
    if(!empty($_POST["email"]) && !empty($_POST["pwd"])){
        $id_usr = $n ->  login($_POST["email"], $_POST["pwd"]) ; 
        if(!empty($id_usr)){
            session_start() ; 
            $_SESSION["id_usr"] = (int)$id_usr ; 
            header("Location: ../../index.php?page=profil") ; 
            exit();
        }
        else{
            header("Location: ../../index.php?page=login");
            exit();
        }
    }
    else{
        header("Location: ../../index.php?page=login");
        exit();
    }









?>