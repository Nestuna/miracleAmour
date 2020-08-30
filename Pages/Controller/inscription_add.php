<?php 

require("../Model/Model.php") ;
$n =Model::getModel() ;


//On check si les variables sont non NULL 
if( !empty($_POST["email"]) && !empty($_POST["pwd"]) && !empty($_POST["sexe"]) && !empty($_POST["prenom"])
&& !empty($_POST["nom"]) && !empty($_POST["date_naissance"]) && !empty($_POST["ville"]) ){
    echo "ON EST ICI" ; 
    $id_usr = $n ->  inscription_identifiant($_POST["pwd"], $_POST["email"]) ; //On insère dans la table identifiants et on recup l'id_usr

    //On convertit la date PARCE QUE LES RICAINS c'est DES CONs ils ont pas le même format de date 
    $date=$_POST["date_naissance"];
    $date = explode("/", $date);
    $newsdate=$date[2].'-'.$date[1].'-'.$date[0];

    //Et on insère le tout dans profile_indiv 
    $id_usr = $n -> inscription_profile_indiv($id_usr , $_POST["sexe"] , $newsdate , $_POST["ville"] , $_POST["nom"] , $_POST["prenom"]) ;
    session_start() ;
    $_SESSION["id_usr"] = (int)$id_usr ; 
    header("Location: ../../index.php?page=profil");
    exit();
}
else{
    echo "<p style='color:black' >manque une variable !</p>" ; 
}

?>