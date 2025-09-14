<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Ajouter produit</title>
</head>
<body>
    <?php 
    require_once 'includes/connection.php';
    include 'includes/nav.php'; ?>
    <div class="container">
      <h4>Ajouter un  produit</h4>
      <?php
        if(isset($_POST['ajouter_produit'])){
          $libelle = $_POST['libelle'];
          $prix = $_POST['prix'];
          $discount = $_POST['discount'];
          $description = $_POST['description'];
          $categorie =  $_POST['categorie'];
          $date = date('Y-m-d H:i:s');

          
          $filename = "produit.png";

          if(!empty($_FILES['image'])){
            $image = $_FILES['image']['name'];
            $filename = uniqid() .  $image;
            move_uploaded_file($_FILES['image']['tmp_name'], 'upload/produit/' . $filename);
            
            
            
          }
          
          if(!empty($libelle) && !empty($prix) && !empty($categorie)){
           
            $stmt = $pdo->prepare('INSERT INTO produit  VALUES (null,?, ?, ?, ?, ?, ?, ?)');
            $inserted = $stmt->execute([$libelle, $prix, $discount, $categorie, $date, $description , $filename]);
            if($inserted){

            header('location: produits.php');
            }else {
              ?> 
            <div class="alert alert-danger" role="alert">
              <strong>Error!</strong> .
            </div>
            <?php
            }
          }
          else{
            ?> 
            <div class="alert alert-danger" role="alert">
              <strong>Attention!</strong> Veuillez remplir tous les champs.
            </div>
            <?php
          }
        }
      ?>
      
        
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Libelle</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="libelle" aria-describedby="emailHelp"  >
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Prix</label>
    <input type="number" step="0.1" class="form-control"name="prix" min="0" ></input>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Discount</label>
    <input type="number" class="form-control"name="discount" min="0" max="90" ></input>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <textarea type="text" class="form-control"name="description"  ></textarea>
    
  </div>
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Image</label>
    <input type="file" class="form-control" name="image"  ></input>
    
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
        echo "<option value='".$categorie['id']."'>".$categorie['libelle']."</option>";
      }
      ?>
      
    </select>
    
  </div>
  <button type="submit" class="btn btn-primary" name="ajouter_produit">Ajouter produit</button>
</form>
</div>
</body>
</html>