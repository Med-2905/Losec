<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Liste des produites</title>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
      <h2>📃Liste des produits</h2>
      <a href="ajouter_produit.php" class="btn btn-primary">Ajouter produit</a>
        <table class="table table-striped table-hover">

        <tr>
          <!---<th>ID</th>--->
          <th>Libelle</th>
          <th>Prix</th>
          <th>Discount</th>
          <th>catégorie</th>
          <th>Date</th>
          <th>Image</th>
          <th>Operation</th>
        </tr>
        <tbody>
          <?php 
          require_once "includes/connection.php";
          $produits = $pdo->query("SELECT produit.*,categorie.libelle as 'categorie_libelle' FROM produit INNER JOIN categorie ON produit.id_categorie = categorie.id")->fetchAll(PDO::FETCH_OBJ);
          
          foreach($produits as $produit){
            $prix = $produit->prix;
            $discount = $produit->discount;
            //$prix_final = $prix - (($prix*$discount)/100);
            ?>
            <tr>
              <!---<td><?php echo $produit->id;?></td>--->
              <td><?php echo $produit->libelle;?></td>
              <td><?php echo $prix ;?> MAD</td>
              <td><?php echo $discount  ;?> % </td>
              <td><?php echo $produit->categorie_libelle;?></td>
              <td><?php echo date_format(date_create($produit->date_creation),'Y-m-d');?></td>
              <td><img class="img-fluid" width="90"  src="upload/produit/<?= !empty($produit->image) ? $produit->image : 'produit.png'; ?>" alt=""></td>
              <td>
              <a href="modifier_produit.php?id=<?php echo $produit->id; ?>" class="btn btn-primary">Modifier</a>
              <a href="supprimer_produit.php?id=<?php echo $produit->id; ?>" onclick="return confirm('Voulez vous vraiment supprime le produit <?php echo $produit->libelle;?>')" class="btn btn-danger">Supprimer</a>
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