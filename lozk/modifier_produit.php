<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    
    <title>Modifier produit</title>
</head>
<body>
    <?php 
    require_once 'includes/connection.php';
    include 'includes/nav.php'; ?>
    <div class="container">
      <h4>Modifie un  produit</h4>
      <?php
        $id = $_GET['id'];
        require_once 'includes/connection.php';
        $stmt = $pdo->prepare('SELECT * FROM produit WHERE id=?');
        $stmt->execute([$id]);
        $produit = ($stmt->fetch(PDO::FETCH_OBJ));
        
        if(isset($_POST['modifier_produit'])){
          $libelle = $_POST['libelle'];
          $prix = $_POST['prix'];
          $discount = $_POST['discount'];
          $categorie =  $_POST['categorie'];
          $description = $_POST['description'];

          $filename = '';

          if(!empty($_FILES['image'])){
            $image = $_FILES['image']['name'];
            $filename = uniqid() .  $image;
            move_uploaded_file($_FILES['image']['tmp_name'], 'upload/produit/' . $filename);
            
            
            
          }
          


          if(!empty($libelle) && !empty($prix) && !empty($categorie)){


            if(!empty($filename)){
              $query = 'UPDATE produit SET libelle=?,
                                                  prix=?,
                                                  discount=?,
                                                  id_categorie=?,
                                                  description=?,
                                                  image=?
                                                    WHERE id=? ';
              $stmt = $pdo->prepare($query);
              $updated =  $stmt->execute([$libelle , $prix , $discount , $categorie  ,$description, $filename, $id]);
            }else{
              $query = 'UPDATE produit SET libelle=?,
                                                  prix=?,
                                                  discount=?,
                                                  id_categorie=?,
                                                  description=?
                                                    WHERE id=? ';
              $stmt = $pdo->prepare($query);
              $updated =  $stmt->execute([$libelle, $prix, $discount, $categorie, $description, $id]);        
            }
            
            if($updated){

            header('location: produits.php');
            }else {
              ?> 
            <div class="alert alert-danger" role="alert">
              <strong>Attention!</strong> Veuillez remplir tous les champs.
            </div>
            <?php
            }
          }
          else{
            ?> 
            <div class="alert alert-danger" role="alert">
              <strong>Error!</strong> .
            </div>
            <?php
          }
        }
      ?>
      
        
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <input type="text" name="id" value="<?= $produit->id?>" hidden>
    <label for="exampleInputEmail1" class="form-label">Libelle</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="libelle" value="<?= $produit->libelle?>" aria-describedby="emailHelp"  >
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Prix</label>
    <input type="number" step="0.1" class="form-control"name="prix" min="0" value="<?= $produit->prix?>" ></input>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Discount</label>
    <input type="number" class="form-control"name="discount" max="90" value="<?= $produit->discount?>" ></input>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <textarea type="text" class="form-control"name="description"  ><?= $produit->description?></textarea>
    
  </div>
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" required ></input>
    <img width="250" src="upload/produit/<?php echo !empty($produit->image) ? $produit->image : 'produit.png'; ?>"  class="img img-fluid w-25 my-2"  alt="...">
    
  </div>
  <?php
   $categories = $pdo->query(('SELECT * FROM categorie'))->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <div class="mb-3">
    <label for="">Catégorie</label>
    <select class="form-control" name="categorie" my-2>
      <option value="">Choisissez une catégorie</option>
      <?php

      foreach($categories as $categorie){
        $selected = $produit->id_categorie == $categorie['id'] ? ' selected ' : '';
        echo "<option $selected value='" . $categorie['id'] . "'>" . $categorie['libelle'] . "</option>";
        
      }
      ?>
      
    </select>
    
  </div>
  <button type="submit" class="btn btn-primary" name="modifier_produit">Modifier produit</button>
</form>
</div>
</body>
</html>