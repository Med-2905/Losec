      <?php 
      session_start();
        require_once "../includes/connection.php";
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM categorie WHERE id = ?");
        $stmt->execute([$id]);
        $categorie = $stmt->fetch(PDO::FETCH_ASSOC);
        

        $stmt = $pdo->prepare("SELECT * FROM produit WHERE id_categorie = ?");
        $stmt->execute([$id]);
        $produits = $stmt->fetchAll(PDO::FETCH_OBJ);
        
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/produit.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>                    
    <title><?php echo $categorie['libelle']?></title>
</head>
<body>
    <?php include '../includes/nav_front.php';?>
    <div class="container py-2">
          <h4><?php echo $categorie['libelle']?> <span class="fa <?php echo $categorie['icone'] ?>"></h4>
    <div class="container">
      <div class="row">
        <?php 
        
        foreach($produits as $produit){
        $id_produit = $produit->id;
          
          ?>
          
          <div class="card mb-3 col-md-4 m-1">
            <img   src="../upload/produit/<?php echo !empty($produit->image) ? $produit->image : 'produit.jpg';  ?>"  class="card-img-top w-50 mx-auto"  alt="">
            <div class="card-body">
              <a href="produit.php?id=<?php echo $id_produit ?>" class="btn stretched-link">Afficher détails</a>
              <h5 class="card-title"><?php echo $produit->libelle ?></h5>
              <p class="card-text"><?php echo $produit->description ?></p>
              <p class="card-text"><?php echo $produit->prix ?> MAD</p>
              <p class="card-text"><small class="text-body-secondary"> Ajouté le :<?php echo date_format(date_create($produit->date_creation) , 'Y/m/d') ?></small></p>
            </div>
            <div class="card-footer" style="z-index: 10;">
              <?php include '../includes/front/counter.php'; ?>
            </div>
          </div>
          
          <?php 
          
        }
        if(empty($produits)){
          ?>
          <div class="alert alert-info" role="alert">
            <p class='text-center'>Aucun produit dans cette catégorie pour l'instant</p>
  
          </div>
          <?php 
          
        }
        ?>
        
        
      </div>
    </div>
</div>
 <script src="../assets/js/produit/counter.js"></script>

</body>
</html>