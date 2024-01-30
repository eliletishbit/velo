<?php session_start();
include('method.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" href="style/style.css">
    <title>S'inscrire - veloc</title>
</head>
<body>
     <?php include_once('navbar.php')?>
 <br>
 <!-- -----------------------Formulaire d'inscription ------------------- -->
<div class="container-fluid col-xl-10 col-xxl-10 px-4 py-5 " style="background: #dbb2fa" >
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">Inscrivez vous !</h1>
        <p class="col-lg-10 fs-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae veritatis laudantium repellendus natus numquam animi quos aperiam, possimus recusandae sunt? Aliquam nihil ! </p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form action="" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput"  name="nameUsers">
            <label for="floatingInput">Nom et Prenoms</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput"  name="mailUsers">
            <label for="floatingInput">Email </label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword"  name="mdpUsers">
            <label for="floatingPassword">Mot de passe</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit" name="inscrire"> S'inscrire</button>
          <hr class="my-4">
          <small class="text-muted">En cliquant sur le bouton s'inscrire, vous acceptez nos condtions d'utilisation.</small>
        </form>
      </div>
    </div>
  </div>
<!-- ---------------------Fin formulaire---------------------------- -->
    <?php 
        if (isset($_POST['inscrire'])) {
          // recuperation des données
            $nameUsers = $_POST['nameUsers'];
            $mailUsers = $_POST['mailUsers'];
            $mdpUsers = $_POST['mdpUsers'];

            if (!empty($nameUsers) && !empty($mailUsers) && !empty($mdpUsers)) {
                // connexion à la bd
                $PDO = dbConnect();
                // insertion des données en bd
                $sql = 'INSERT INTO user(`userName`, `userMail`, `userMdp`) VALUES(:nameUsers, :mailUsers, :mdpUsers)';
                $requete = $PDO->prepare($sql);

                $requete->bindValue(":nameUsers", $nameUsers);
                $requete->bindValue(":mailUsers", $mailUsers);
                $requete->bindValue(":mdpUsers", $mdpUsers);

                $requete->execute();

                header('location:index.php');    
            }
        }   
    
    ?>
    <?php include_once('footer.php')?>
    <script src="style/bootstrap.js"></script>
</body>
</html>