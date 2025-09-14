<?php 

include 'includes/connection.php';
$id = $_GET['id'];
$stmt = $pdo->prepare('DELETE FROM categorie WHERE id =?');
$supprime = $stmt->execute([$id]);


if($supprime){
    header ('location: categories.php');
}else {
    ?> 
            <div class="alert alert-danger" role="alert">
              <strong>Error!</strong> .
            </div>
    <?php
}
?>