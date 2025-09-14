<?php 

include 'includes/connection.php';
$id = $_GET['id'];
$stmt = $pdo->prepare('DELETE FROM produit WHERE id =?');
$supprime = $stmt->execute([$id]);



if($supprime){
    header ('location: produits.php');
}else {
    ?> 
            <div class="alert alert-danger" role="alert">
              <strong>Error!</strong> .
            </div>
    <?php
}
?>