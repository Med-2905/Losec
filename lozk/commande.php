<?php
   require_once "includes/connection.php";
  $id_cmd = $_GET['id'];
  $stmt = $pdo->prepare('SELECT commands.*,utili.login as "login" FROM commands 
    INNER JOIN utili ON commands.id_client = utili.id 
    where commands.id = ?
    ORDER BY commands.date_creation DESC' );
  $stmt->execute([$id_cmd]);
  $commande = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Commande | Numéro <?= $commande['id']?> </title>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
   <h2><i class="fa-solid fa-table-list"></i> Détails commandes</h2>
         
  <table class="table table-striped table-hover">
    
    <tr>
      <!---<th>ID</th>--->
      <th>Client</th>
      <th>Total</th>
      <th>Date</th>
      <th>Operations</th>
    </tr>
    <tbody>
      <?php 
        $sql_stmt_cmd_ligne = $pdo->prepare('SELECT ligne_cmd.*,produit.libelle , produit.image
                                                              FROM ligne_cmd
                                                              INNER JOIN produit ON ligne_cmd.id_produit = produit.id
                                                              WHERE id_cmd = ?');
        $sql_stmt_cmd_ligne->execute([$id_cmd]);
        $lignes_cmd = $sql_stmt_cmd_ligne->fetchAll(PDO::FETCH_OBJ);

        
          ?>
          <tr>
            <!---<td><?php echo $commande['id'];?></td>--->
            <td><?php echo $commande['login'];?></td>
            <td><?php echo $commande['total'];?> MAD</td>
            <td><?php echo date_format(date_create($commande['date_creation']),'Y-m-d');?></td>
           <td>
                <?php if ($commande['valide'] == 0) : ?>
                    <a class="btn btn-success btn-sm" href="valide_cmd.php?id=<?= $commande['id']?>&etat=1">Valider la commande</a>
                <?php else: ?>
                    <a class="btn btn-danger btn-sm" href="valide_cmd.php?id=<?= $commande['id']?>&etat=0">Annuler la commande</a>
                <?php endif; ?>
            </td>
            
            
          </tr>
            
          
          <?php
        
      ?>

    </tbody>
</table>
<hr>
<h2>Produits : </h2>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <!---<th>ID</th>--->
            <th>Produit</th>
            <th>Image</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        </thead>
        

        <tbody>
        <?php  foreach ($lignes_cmd as $lignes_commande) : ?>
          
            <tr>
                <!---<td><?php echo $lignes_commande->id ?></td>--->
                <td><?php echo $lignes_commande->libelle ?></td>
                <td><img class="img-fluid" width="90" src="upload/produit/<?php echo $lignes_commande->image ?>" alt=""></td>
                <td><?php echo $lignes_commande->prix ?> MAD</td>
                <td>x <?php echo $lignes_commande->quantite ?></td>
                <td><?php echo $lignes_commande->total ?> MAD</td>
                
            </tr>
            
        <?php endforeach; ?>
        <td><a class="btn btn-primary  btn-sm float-right" href="commands.php">Liste des commandes</a></td>
        </tbody>
    </table>
</div>
</body>
</html>