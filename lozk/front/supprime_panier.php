<?php 
session_start();
if(!isset($_SESSION['utili'])){
    header("location: ../connexion.php");
    
}

$id_utilisateur = $_SESSION['utili']['id'];

$id = $_POST['id'];
unset($_SESSION['panier'][$id_utilisateur][$id] );
header("location:".$_SERVER['HTTP_REFERER']);

?>