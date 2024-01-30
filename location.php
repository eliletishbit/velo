<?php session_start();
include('method.php')
?>
<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style/bootstrap.css">
   <link rel="stylesheet" href="style/style.css">
   <title>Location - veloc</title>
</head>

<body>
   <?php include_once('navbar.php') ?>
   <br>

   <?php

   if (isset($_POST['location'])) {
      $idVelo = $_POST['idVelo'];

      // ------------- Formulaire de choix du delai location-----------
   ?> <div class="container-fluid col-xl-10 col-xxl-10 px-5 py-1 bg-secondary">
         <div class="row align-items- g-lg-5 py-5">
            <div class="col-lg-6 text-center text-lg-start">
               <?php
               // -----------Recuperation du velos via la metho getVelo()-----------------
               $Velo = getVelo($idVelo);
               ?>
               <div class="card shadow-sm">
                  <!-- image velo -->
                  <img src="img/images/<?= $Velo['imageVelo']; ?>" alt="" class="bd-placeholder-img card-img-top" width="100%" height="400">
                  <div class="card-body">
                     <h1 class="card-title pricing-card-title">$<?= $Velo['prixLocation']; ?><small class="text-body-secondary fw-light">/jour</small></h1>
                     <ul class="list-unstyled mt-3 mb-4">
                        <!-- Caracterique -->
                        <li>Modèle : <?= $Velo['modeleVelo']; ?> </li>
                        <li>Marque : <?= $Velo['marqueVelo']; ?></li>
                        <li>Type : <?= $Velo['typeVelo']; ?></li>
                        <li>Couleur : <?= $Velo['couleurVelo']; ?></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-5 mx-auto col-lg-6">
               <form action="" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
                  <div class="form-floating mb-3">
                     <select class="form-control" name="duree" required>
                        <option value="1"> 1 jour ($<?= $Velo['prixLocation']; ?>)</option>
                        <option value="2"> 2 jours ($<?= $Velo['prixLocation'] * 2; ?>)</option>
                        <option value="3"> 3 jours ($<?= $Velo['prixLocation'] * 3; ?>)</option>
                        <option value="4"> 4 jours ($<?= $Velo['prixLocation'] * 4; ?>)</option>
                        <option value="5"> 5 jours ($<?= $Velo['prixLocation'] * 5; ?>)</option>
                        <option value="6"> 6 jours ($<?= $Velo['prixLocation'] * 6; ?>)</option>
                        <option value="7"> 7 jours ($<?= $Velo['prixLocation'] * 7; ?>)</option>
                     </select>
                     <label for="floatingInput">Durée de location</label>
                  </div>
                  <div class="form-floating mb-3">
                     <input class="form-control" type="datetime-local" name="dateDebut" required>
                     <label for="floatingInput">Date de debut</label>
                  </div>
                  <div>
                     <input type="hidden" name="idvelo" value="<?= $idVelo ?>">
                  </div>
                  <button class="w-100 btn btn-lg btn-primary" type="submit" name="louer">Louer le vélo</button>
               </form>
            </div>
         </div>
      </div>
      </div>
   <?php
   }
   if (isset($_POST['louer'])) {
      $idvelo = $_POST['idvelo'];
      $userId = $_SESSION['user']['iduser'];
      $duree = $_POST['duree'];
      $dateDebutLocation = $_POST['dateDebut'];
      // recuperation de la date de fin 
      $dateFinLocation = setDateFinLocation($dateDebutLocation, $duree);
      // connexion à la bd
      $PDO = dbConnect();
      // insertion
      $sql = 'INSERT INTO location(`idVelo`, `userId`, `dateDebut`, `dateFin`) VALUES(:idVelo, :userId, :dateDebutLocation, :dateFinLocation)';
      $requete = $PDO->prepare($sql);

      $requete->bindValue(":idVelo", $idvelo);
      $requete->bindValue(":userId", $userId);
      $requete->bindValue(":dateDebutLocation", $dateDebutLocation);
      $requete->bindValue(":dateFinLocation", $dateFinLocation);

      $requete->execute();
      // changement du statut du velo
      setVeloStatus($idvelo);
      header('location:index.php');
   } else {
      echo 'un erreur produute';
   }
   // ------------- Fin formulaire -------------------------//

   ?>
   <?php include_once('footer.php') ?>
   <script src="style/bootstrap.js"></script>
</body>

</html>