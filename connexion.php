<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <title>Connexion </title>
</head>

<body>
  <!-- -------------Formulaire de connexion------------------ -->
  <div class="container-fluid col-xl-10 col-xxl-10 px-4 py-5 " style="background: #dbb2fa">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">Connectez vous</h1>
        <p class="col-lg-10 fs-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium id fugiat reiciendis sunt vel minima ducimus porro dignissimos natus suscipit alias aperiam animi aspernatur neque sequi, harum voluptate ipsam consequuntur!</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form action="" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="mailUsers" required>
            <label for="floatingInput">Email </label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="mdpUsers" required>
            <label for="floatingPassword">Password</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Se souvenir de moi
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit" name="connecter"> Se connecter</button>
          <hr class="my-4">
          <a href="inscritption.php" class="w-100 btn btn-lg " style="color: #7801d2; background: #dbb2fa;"> S'inscrire </a>
          <hr class="my-4">
          <small class="text-muted">En cliquant sur le bouton se connecter, vous acceptez nos condtions d'utilisation.</small>
        </form>
      </div>
    </div>
  </div>
  <!-- ---------fin formulaire --------------------- -->
  <?php
  include('method.php');
  //connexion à la base de données
  $PDO = dbConnect();

  if (isset($_POST['connecter'])) {
    $mailUsers = $_POST['mailUsers'];
    $mdpUsers = $_POST['mdpUsers'];

    if (!empty($mailUsers) && !empty($mdpUsers)) {
      //selection des informations sur l'user dont le mail et le mot de passe correspondent
      $sql = "SELECT * FROM `user` WHERE  userMail ='$mailUsers' AND   userMdp = '$mdpUsers'";
      $requete = $PDO->query($sql);
      $res = $requete;
      $user = $res->fetch();
      //Si les informations sont recupérés, on les enregistres en session
      if (!empty($user)) {
        $_SESSION['user'] = [
          'iduser' => $user['userId'],
          'mailuser' => $user['userMail'],
          'nameuser' => $user['userName'],
        ];
      }else{
        echo "Erreur de mail ou de mot de passe";
      }
      header('location:index.php');
    }
  }

  ?>
  <script src="style/bootstrap.js"></script>
</body>

</html>