<link rel="stylesheet" href="../assets/css/produit.css">

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Lozec</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Liste des catégories</a>
        </li>

        
      </ul>
    </div>
    <?php
    //$id_utilisateur = $_SESSION['utili']['id'];
     $cart_count = 0;
    if (isset($_SESSION['utili']) && isset($_SESSION['utili']['id'])) {
        $id_utilisateur = $_SESSION['utili']['id'];
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
        if (!isset($_SESSION['panier'][$id_utilisateur])) {
            $_SESSION['panier'][$id_utilisateur] = array();
        }
        $cart_count = count($_SESSION['panier'][$id_utilisateur]);
        define('PRODUCT_COUNT', $cart_count);
    }
    ?>
     <a class="btn float-end" href="../admin.php"><i
                    class="fa-solid fa-screwdriver-wrench"></i> Backoffice</a>
    <a class="btn  custom-link ms-auto float-end"  href="panier.php"> <i class="fa-solid fa-cart-shopping"></i> Panier (<?php echo  PRODUCT_COUNT ; ?>)</a>
  </div>
</nav>
