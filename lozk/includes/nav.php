<?php
session_start();
$connected = false;

if(isset($_SESSION['utili'])){
  $connected = true;
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Lozec</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php
        $currentPage = $_SERVER['PHP_SELF'];
    ?>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php if ($currentPage == '/lozk/index.php') echo 'active' ?>" aria-current="page" href="index.php"><i class="fa-solid fa-house-user"></i> Accueil</a>
        </li>
        <?php
          if($connected){
            ?>
            <li class="nav-item">
              <a class="nav-link <?php if ($currentPage == '/lozk/categories.php') echo 'active' ?> " aria-current="page" href="categories.php"><i class="fa fab fa-dropbox"></i> Liste des catégorie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if ($currentPage == '/lozk/produits.php') echo 'active' ?> " aria-current="page" href="produits.php"><i class="fas fa-tag"></i> Liste des produites</a>
            </li>
            <!---
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="ajouter_categorie.php">Ajouter catégorie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="ajouter_produit.php">Ajouter produit</a>
            </li> --->
            <li class="nav-item">
              <a class="nav-link <?php if ($currentPage == '/lozk/commands.php') echo 'active' ?>" aria-current="page" href="commands.php"><i class="fa-solid fa-comments-dollar"></i> Commandes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="deconnexion.php"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
            </li>
            
            <?php
          }else {
            ?>
            
            <li class="nav-item">
              <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
            
            <?php
          }
        
        ?>
       
      </ul>
    </div>
    <?php
    if($connected) {

      ?>
    <a class="btn float-end" href="front/"><i class="fa-solid fa-cart-shopping"></i> Site front</a> 
    <?php
    }
    ?>
  
  </div>
</nav>