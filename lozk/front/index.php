<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <title>Catégorie</title>
</head>
<body>
    <?php include '../includes/nav_front.php';?>
    <div class="container">
      <h4><i class="fa fa-solid fa-list"></i> Liste des catégories</h4>
      <?php 
        require_once "../includes/connection.php";
        $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_OBJ);
      ?>
        
    <ul class="list-group list-group-flush w-25">
        <?php 
            foreach($categories as $categorie){
                ?> 
                <li class="list-group-item">
                <a  class="btn btn-light" href="categorie.php?id=<?php echo $categorie->id ?>">

                    <i class="<?php echo $categorie->icone ?>"></i> <?php echo $categorie->libelle ?>
                </a>    
                </li>
                <?php

            }
        
        
        ?>
        
        
    </ul>
</div>
</body>
</html>