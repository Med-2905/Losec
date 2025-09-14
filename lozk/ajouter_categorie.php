<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Ajouter catégorie</title>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
      <h4>Ajouter un  catégorie</h4>
      <?php
      if(isset($_POST['ajouter'])){
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $icone = $_POST['icone'];

        if(!empty($libelle) && !empty($description)){

          require_once 'includes/connection.php';
          $stmt = $pdo->prepare('INSERT INTO categorie(libelle,description,icone) VALUES(?, ?, ?)');
          $stmt->execute([$libelle, $description, $icone]);
          header('location: categories.php'); 
        }else{
          ?> 
          <div class="alert alert-danger" role="alert">
            <strong>Attention!</strong> Veuillez remplir tous les champs.
  
          </div>
          <?php
        }
      }


      
      
      
      ?>
      
        
<form method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Libelle</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="libelle" aria-describedby="emailHelp"  >
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <textarea class="form-control"name="description" ></textarea>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Icone</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="icone" aria-describedby="emailHelp"  >
    
  </div>
  <button type="submit" class="btn btn-primary" name="ajouter">Ajouter catégorie</button>
</form>
</div>
</body>
</html>