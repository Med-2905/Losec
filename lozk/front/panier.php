      <?php 
      session_start();
      require_once "../includes/connection.php";
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
    <title>Panier</title>
</head>
<body>
    <?php include '../includes/nav_front.php';?>
    <div class="container py-2">
        <?php 
            $id_utilisateur = $_SESSION['utili']['id'];
            $panier = $_SESSION['panier'][$id_utilisateur];
                    if(!empty($panier)){
                            $id_produits = array_keys($panier);
                            $id_produits = implode(',', array_map('intval', $id_produits));
                            $produits =  $pdo->query("SELECT * FROM produit WHERE id IN ($id_produits) ")->fetchAll(PDO::FETCH_ASSOC);
                    }  
                        if(isset($_POST['vider'])){
                        $_SESSION['panier'][$id_utilisateur] = [];
                        header('location: panier.php');
                        }

                        if(isset($_POST['valider'])){
                           
                            $sql = 'INSERT INTO ligne_cmd(id_produit , id_cmd, prix , quantite ,  total) VALUES';
                            $total = 0 ;
                            $prix_produit = [];
                            foreach($produits as $produit){
                                $id_produit = $produit['id'];
                                $qnt = $panier[$id_produit];
                                $prix = $produit['prix'];
                                $total += $prix * $qnt ;
                                $prix_produit[$id_produit] = [  
                                    'id' => $id_produit,
                                    'prix' => $prix,
                                    'total' => $qnt*$prix,
                                    'qnt' => $qnt
                                ];
                            }
                            
                            $sql_stmt_cmd = $pdo->prepare("INSERT INTO commands (id_client, total) VALUES (?,?)");
                            $sql_stmt_cmd->execute([$id_utilisateur, $total]);
                            $id_cmd = $pdo->lastInsertId();
                            $args = [] ;
                            
                            foreach($prix_produit as $produit)
                            {
                                $id = $produit['id'];
                                $sql .= "(:id_produit$id, :id_cmd$id, :prix$id, :qnt$id, :total$id),";
                            }
                            $sql = substr($sql,0,-1);
                            $sql_stmt = $pdo->prepare($sql);
                            foreach($prix_produit as $produit ){
                                $id = $produit['id'];
                                $sql_stmt->bindParam(':id_produit'.$id,$produit['id']);
                                $sql_stmt->bindParam(':id_cmd'.$id, $id_cmd);              // Add this line
                                $sql_stmt->bindParam(':prix'.$id,$produit['prix']);
                                $sql_stmt->bindParam(':qnt'.$id,$produit['qnt']);          // Changed from :quantite
                                $sql_stmt->bindParam(':total'.$id,$produit['total']);


                            }
                            
                            $inserted = $sql_stmt->execute();
                             if ($inserted) {

                                $_SESSION['panier'][$id_utilisateur] = [];
                                header('location: panier.php?success=true&total=' . $total);
                            } else {
                                ?>
                                <div class="alert alert-error" role="alert">
                                    Erreur (contactez l'administrateur).
                                </div>
                                <?php
                            }
                        }
                        ?>
          <h4>Panier (<?php echo  PRODUCT_COUNT ; ?>)</h4>
    <div class="container">
      <div class="row">
        <?php 
        
        
       
       
        
        if(empty($panier)){
            ?>
            <div class="alert alert-warning" role="alert">
                <p class='text-center'>Votre panier est vide pour l'instant</p>
            </div>
            <?php
        }else{
            
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Prix</th>
                        <th scope=col>Total</th>
                    </tr>
                </thead>
            <?php
            $total = 0 ;

            foreach($produits as $produit){
                $id_produit = $produit['id'];
                $total_produit = $produit['prix'] * $panier[$id_produit];

                $total += $total_produit;
                ?>
                <tr >
                    
                        <td><?php echo $produit['id']?> </td>
                        <td><img width="80" src="../upload/produit/<?php echo $produit['image'] ?>" alt=""></td>
                        <td><?php echo $produit['libelle']?></td>
                        <td><?php include '../includes/front/counter.php';?></td>
                        <td><?php echo $produit['prix']?> MAD</td>
                        <td><?php echo $total_produit?> MAD</td>
                    
                </tr>
                <?php
            }
            ?>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-end" ><strong>Total : </strong></th>
                    <th ><?php echo $total    ?> MAD</th>
                </tr>
                <tr>
                    <td colspan="6" class="text-end">
                        
                        <form method="post">
                            <input type="submit" class="btn btn-success" name="valider" value="Valide la commande"> 
                            <input onclick="return confirm('voulez vous vraiment vider le panier')" type="submit" class="btn btn-danger"  name="vider" value="Vider le panier" > 
                        </form>
                    </td>
                </tr>
            </tfoot>
            </table>
            <?php
        }
        ?>
        
      </div>
    </div>
</div>
 <script src="../assets/js/produit/counter.js"></script>
    
</body>
</html>