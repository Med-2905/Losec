<?php 
session_start();
if(!isset($_SESSION['utili'])){
    header("location: ../connexion.php");
    
}


$id = $_POST['id'];
$qnt = $_POST['qnt'];
$id_utilisateur = $_SESSION['utili']['id'];
    

    if(!isset($_SESSION['panier'][$id_utilisateur])){
         $_SESSION['panier'][$id_utilisateur] = [];
    }
    if($qnt == 0 ){
        unset( $_SESSION['panier'][$id_utilisateur][$id]);
    }else{

        $_SESSION['panier'][$id_utilisateur][$id] = $qnt ;
    }


header("location:".$_SERVER['HTTP_REFERER']);


?>