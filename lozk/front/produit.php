      <?php 
      session_start();
        require_once "../includes/connection.php";
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM produit WHERE id = ?");
        $stmt->execute([$id]);
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        
        
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/produit.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
    <title>PRODUIT | <?php echo $produit['libelle']?></title>
</head>
<body>
    <?php include '../includes/nav_front.php';?>
    <div class="container py-2">
          <h4><?php echo $produit['libelle']?> </h4>
    <div class="container">
      <div class="row">
       
        <div class="col-md-6">

          <img class="img img-fluid w-75" src="../upload/produit/<?php echo $produit['image'] ?>" alt="">
        </div>
        <div class="col-md-6">
          <?php 
          $discount = $produit['discount'];
          $prix = $produit['prix'];
          ?>
          <div class="d-flex align-items-center">

          <h1 class="w-100"><?php echo $produit['libelle']?></h1>
          
          
          <?php 
              if(!empty($discount) ){
                ?>

                <span class="badge text-bg-success"> - <?php echo $discount ?> %</span>
                
                <?php 
              }
          
          ?>
          </div>
          <hr>
          <p><?php echo $produit['description']?></p>
          <hr>

          <div class="d-flex">
          
          <?php 
          
          if(!empty($discount) ){
            $total = $prix - (($prix*$discount )/100);
            ?>
                <h5 class="mx-1">
                  <span class="badge text-bg-danger"><strike><?php echo $prix ?> MAD</strike> </span>
                </h5>
                <h5 class="mx-1">
                  <span class="badge text-bg-success"><?php echo $total ?> MAD</span>
                </h5>
            <?php
          }else{
            $total = $prix;
            ?>
                <h5>
                  <span class="badge text-bg-success"><?php echo $total ?> MAD</span>
                </h5>
                <?php
          }
          ?>
          
          </div>
          <hr>
          <?php
          $id_produit = $produit['id'];
          include '../includes/front/counter.php'; ?>
          <hr>
          
        
      </div>
    </div>
</div>
 <script src="../assets/js/produit/counter.js"></script>

</body>
</html>