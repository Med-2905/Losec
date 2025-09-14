<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Liste des commands</title>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
   <h2><i class="fa-solid fa-inbox"></i> Liste des commands</h2>
         
  <table class="table table-striped table-hover">
    
    <tr>
      <th>ID</th>
      <th>Opérateur</th>
      <th>Total</th>
      <th>Date</th>
      <th>Operation</th>
    </tr>
    <tbody>
      <?php 
        require_once "includes/connection.php";

        $commands = $pdo->query('SELECT commands.*,utili.login as "login" FROM commands INNER JOIN utili ON commands.id_client = utili.id ORDER BY commands.date_creation DESC' )->fetchAll(PDO::FETCH_ASSOC);

        foreach($commands as $cmd){
          ?>
          <tr>
            <td><?php echo $cmd['id'];?></td>
            <td><?php echo $cmd['login'];?></td>
            <td><?php echo $cmd['total'];?> MAD</td>
            
            <td><?php echo date_format(date_create($cmd['date_creation']),'Y-m-d');?></td>
            <td><a class="btn btn-primary btn-sm" href="commande.php?id=<?php echo $cmd['id'] ?>">Afficher détails</a></td>
            
          </tr>
            
          
          <?php
        }
      ?>

    </tbody>
</table>
</div>
</body>
</html>