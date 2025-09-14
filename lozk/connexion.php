<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    
    <title>Connexion</title>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
<div class="container">
    <?php 
    if(isset($_POST['connexion'])){
        $login = $_POST['login'];
        $password  = $_POST['pwd'];

        if(!empty($login) && !empty($password)){
            require_once 'includes/connection.php';
            $stmt = $pdo->prepare('SELECT * FROM utili 
                                            WHERE login = ?
                                            AND password = ? ');
            $stmt->execute([$login, $password]);
            if($stmt->rowCount()>=1){
                $_SESSION['utili'] = $stmt->fetch();
                header('location: admin.php');
            }else {
                ?>
          <div class="alert alert-danger" role="alert">
            <strong>Attention!</strong> Login ou password inccorect.
  
          </div>
          <?php 
            }
        }else {
            ?>
          <div class="alert alert-danger" role="alert">
            <strong>Attention!</strong> Veuillez remplir tous les champs.
  
          </div>
          <?php 
        }
    }
    
    
    
    ?>
    <h4>Connexion</h4>
<form method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="login" aria-describedby="emailHelp" placeholder="Admin"  required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="********" name="pwd">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember me</label>
  </div>
  <button type="submit" class="btn btn-primary" value="connexion" name="connexion">Connexion</button>
</form>
</div>
</body>
</html>