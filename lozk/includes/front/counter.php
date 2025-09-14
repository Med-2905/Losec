

<div >
    <?php
    $id_utilisateur = $_SESSION['utili']['id'];
    $qnt = $_SESSION['panier'][$id_utilisateur][$id_produit] ?? 0 ;
    //$button = $qnt == 0 ? 'Ajouter' : 'Modifier' ; 
    if ($qnt == 0) {
        $color = 'btn-primary';
        $button = '<i class="fa fa-light fa-cart-plus"></i>';
    } else {
        $button = '<i class="fa-solid fa-pencil"></i>';
    }
    
    ?>
    <form method="post" class="counter d-flex" action="ajouter_panier.php">

        <button onclick="return false;" class="btn btn-primary mx-2 counter-moins">-</button>
        <input type="hidden" name="id" value="<?php echo  $id_produit ?>" >
        <input class="form-control" type="number" name="qnt" id="qnt" value="<?php echo  $qnt ?>" min="0" max="99">
        <button onclick="return false;" class="btn btn-primary mx-2 counter-plus">+</button>
        <button class="btn btn-success btn-sm" type="submit"  name="ajouter" > <?= $button ?> </button>
        <?php 
            if($qnt != 0){
                ?>
                <button formaction="supprime_panier.php" class="btn btn-sm btn-danger mx-1 " type="submit"
                        name="supprimer">
                    <i class="fa-solid fa-trash"></i>
                </button>
                <?php
            }
        ?>
    </form>
 </div>
