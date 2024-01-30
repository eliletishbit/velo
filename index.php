<?php if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include('method.php');
// instruction sur button deconnecter
if (isset($_POST['deconnecter'])) {
  session_destroy();
  header('location:index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/bootstrap.css">
  <link rel="stylesheet" href="style/style.css">
  <title>VeLoc</title>
</head>

<body>
  <!-- ---------------------------------- debut barre de naviagtion -------------------------------------------->
  <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">VeLoc</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav me-auto">
          <?php // verfier si l'user est connecté et afficher le bouton deconnecter
          if (!empty($_SESSION['user']['iduser'])) {
          ?>
            <!-- affichage du bouton deconnecter -->
            <li class="nav-item">
              <form method="post">
                <button type="submit" class="btn text-white btn-md px-4 gap-3" name="deconnecter">Se deconnecter (<?= $_SESSION['user']['nameuser'] ?>)</button>
              </form>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- -----------------------------------------fin barre de navigation ----------------------------------------------------->

  <!-- ----------------------------------------La banniere ------------------------------------------------------------- -->
  <div class="container  px-4 py-1 my-5" style="background-color: #1111;">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="img/img1.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Plateforme de location de vélo !</h1>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique unde expedita deleniti labore modi dolore, deserunt aspernatur, voluptas sit temporibus culpa illo fugit rem commodi inventore quod perferendis cum ea.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <!-- Le bouton pour voir les vélo disponible -->
          <form action="" method="post">
            <button type="submit" class="btn btn-primary btn-lg px-4 me-md-2" name="disponible">Vélo disponible</button>
          </form>
          <!-- le bouton pour voir les vélo en location -->
          <form action="" method="post">
            <button type="submit" class="btn btn-outline-secondary btn-lg px-4" name="location">Vélo en location</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- --------------------------------------------Fin banniere ---------------------------------------------------------------------->
  <?php
  // --------------------------------------------------- Affichage des velos disponible --------------------------------------------------
  if (isset($_POST['disponible'])) {
    // On verifie si user est connecter ? on affiche les vélos dispo ; on lance la page de connection.
    if (empty($_SESSION['user']['iduser'])) {
      header('location:connexion.php');
    } else {
  ?>
      <!-- debut bannere -->
      <div class="px-4 py-1 my-5 text-center container bg-primary">
        <h1 class="display-5 fw-bold text-white"> Les Vélo disponible</h1>
        <div class="col-lg-10 mx-auto">
          <div>
            <p class="lead mb-6 col-lg-12 bg-light text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam qui optio numquam iusto illo facere esse minus praesentium. Molestiae numquam animi assumenda eos repellendus</p>
          </div>
        </div>
      </div>
      <!-- fin bannere -->
      <!-- Affichage proprement dite-->
      <div class="album py-1 bg-body-tertiary">
        <div class="container">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            // Recuperation de tout les velos via la metho getVeloDisponible()
            $allVelos = getVeloDisponible();
            //on parcour la liste pour afficher les velos
            foreach ($allVelos as $allVelo) {
            ?>
              <div class="col">
                <div class="card shadow-sm">
                  <!-- image velo -->
                  <img src="img/images/<?= $allVelo['imageVelo']; ?>" alt="" class="bd-placeholder-img card-img-top" width="100%" height="400">
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title">$<?= $allVelo['prixLocation']; ?><small class="text-body-secondary fw-light">/jour</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                      <!-- Caracterique -->
                      <li>Modèle : <?= $allVelo['modeleVelo']; ?> </li>
                      <li>Marque : <?= $allVelo['marqueVelo']; ?></li>
                      <li>Type : <?= $allVelo['typeVelo']; ?></li>
                      <li>Couleur : <?= $allVelo['couleurVelo']; ?></li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">
                      <!-- Bouton louer velo -->
                      <div class="btn-group">
                        <form action="location.php" method="post">
                          <!-- recuperation id velo && envoi de Id velo sur la page location -->
                          <input type="hidden" name="idVelo" value="<?= $allVelo['idVelo']; ?>" required>
                          <button type="submit" class="btn btn-sm btn-primary" name="location">Louer</button>
                        </form>
                      </div>
                      <small class="text-body-secondary">Dispo</small>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
  <?php
    }
  }
  ?>
  <!-- -----------------------------------------------------Fin affichage velo disponible ------------------------------------------------- -->

  <!-- ---------------------------------------------------- debut Affichage des velo en location------------------------------------------- -->
  <?php
  if (isset($_POST['location'])) {
    // On verifie si user est connecter ? on affiche les vélos dispo ; on lance la page de connection.
    if (empty($_SESSION['user']['iduser'])) {
      header('location:connexion.php');
    } else {
  ?>
      <!-- bannere -->
      <div class="px-4 py-5 my-5 text-center container" style="background-color: #8a05f0;">
        <h1 class="display-5 fw-bold" style="color: #FFFFFF;">Les vélos loués</h1>
        <div class="col-lg-10 mx-auto">
          <div>
            <p class="lead mb-6 col-lg-12" style="color: #7801d2; background: #dbb2fa;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam qui optio numquam iusto illo facere esse minus praesentium. Molestiae numquam animi assumenda eos repellendus</p>
          </div>
        </div>
      </div>
      <!-- fin bannere -->
      <!-- Affichage proprement dite-->
      <div class="album py-1 bg-body-tertiary">
        <div class="container">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            // Recuperation de tout les velos en location via la metho getVeloInLocation()
            $allVelos = getVeloInLocation();
            //on parcour la liste pour afficher les velos
            foreach ($allVelos as $allVelo) {
            ?>
              <div class="col">
                <div class="card shadow-sm">
                  <!-- image velo -->
                  <img src="img/images/<?= $allVelo['imageVelo']; ?>" alt="" class="bd-placeholder-img card-img-top" width="100%" height="400">
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title">$<?= $allVelo['prixLocation']; ?><small class="text-body-secondary fw-light">/jour</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                      <!-- Caracterique -->
                      <li>Modèle : <?= $allVelo['modeleVelo']; ?> </li>
                      <li>Marque : <?= $allVelo['marqueVelo']; ?></li>
                      <li>Type : <?= $allVelo['typeVelo']; ?></li>
                      <li>Couleur : <?= $allVelo['couleurVelo']; ?></li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">
                      <small class="text-body-secondary">Loué</small>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <!-- ----------------------------------------------- Fin affichage velo loués--------------------------------- -->
  <?php
    }
  }
  ?>
  <?php include_once('footer.php') ?>
  <script src="style/bootstrap.js"></script>
</body>

</html>