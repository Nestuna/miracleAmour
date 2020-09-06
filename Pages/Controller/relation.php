<?php
    require("../Model/Model.php") ;
    $n =Model::getModel() ;
    session_start() ;


    print_r($_GET);
    $n -> insertMatch($_SESSION['id_usr'],$_GET['id_usr']) ;
    $n -> updateMatch($_SESSION['id_usr'],$_GET['id_usr']) ;

    header("Location: ../../index.php?page=chat") ; 
    exit();
?>