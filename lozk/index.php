<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Ajouter utilisateur</title>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
      <h4>Ajouter un utilisateur</h4>
      <?php 
      if(isset($_POST['ajouter'])){
        $login = $_POST['email'];
        $password = $_POST['password'];
        if(!empty($login) && !empty($password)){
          require 'includes/connection.php';
          $date = date(format:'Y-m-d');
          $stmt = $pdo->prepare('INSERT INTO utili VALUES (NULL,?,?,?)');
          $stmt->execute([$login,$password,$date]);

          echo "<div class='alert alert-success' role='alert'>";
          
          header(('location: connexion.php'));
        }else {
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
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Admin" required >
    <div id="emailHelp" class="form-text">Donner le nom et prénom </div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="********" name="password">
  </div>
  
  <button type="submit" class="btn btn-primary" name="ajouter">Submit</button>
</form>
</div>
</body>
</html>