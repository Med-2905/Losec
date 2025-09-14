<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Liste des catégories</title>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
   <h2>📃Liste des catégorie</h2>
   <a href="ajouter_categorie.php" class="btn btn-primary">Ajouter catégorie</a>      
  <table class="table table-striped table-hover">
    
    <tr>
      <!---<th>ID</th>--->
      <th>Libelle</th>
      <th>Description</th>
      <th>Icone</th>
      <th>Date</th>
      <th>Operation</th>
    </tr>
    <tbody>
      <?php 
        require_once "includes/connection.php";

        $categories = $pdo->query('SELECT *FROM categorie' )->fetchAll(PDO::FETCH_ASSOC);

        foreach($categories as $categorie){
          ?>
          <tr>
            <!---<td><?php echo $categorie['id'];?></td>--->
            <td><?php echo $categorie['libelle'];?></td>
            <td><?php echo $categorie['description'];?></td>
            <td><i class="fa <?php echo $categorie['icone'];?>"></i></td>
            <td><?php echo date_format(date_create($categorie['date_creation']),'Y-m-d');?></td>
            <td>
              <a href="modifier_categorie.php?id=<?php echo $categorie['id']; ?>" class="btn btn-primary">Modifier</a>
              <a href="supprimer_categorie.php?id=<?php echo $categorie['id']; ?>" onclick="return confirm('Voulez vous vraiment supprime la categorie <?php echo $categorie['libelle'];?>')" class="btn btn-danger">Supprimer</a>
            </td>
          </tr>
            
          
          <?php
        }
      ?>

    </tbody>
</table>
</div>
</body>
</html>