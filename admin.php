<?php session_start();
if (isset($_POST['deconnecter'])) {
    session_destroy();
    header('location:admin.php');
}
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
    <title>admin-veloc</title>
</head>

<body>
    <?php include_once('navbar.php');

    if (empty($_SESSION['admin']['userName'])) {

    ?>
        <!-- Debut formualire connexion admin -->
        <div class="container">
            <h1>Login </h1>
            <form action="#" method="post">
                <div>
                    <label for="userName"> Username : </label>
                    <input type="text" name="userName" required> <br><br>
                </div>
                <div>
                    <label for="mdpAdmin">PassWord : </label>
                    <input type="password" name="mdpAdmin" required><br><br>
                </div>
                <div>
                    <button class="btn btn-primary " type="submit" name="login">Se connecter</button>
                </div>
            </form><br>
        </div>
        <!-- fin formualire de connexion -->
        <?php


        if (isset($_POST['login'])) {
            //on recupère les données saisie
            $userName = $_POST['userName'];
            $mdpAdmin = $_POST['mdpAdmin'];

            //Declaration des informations de connexion à espace admin
            $adminUserName = "root";
            $adminMdp = "root@@";

            //verification des informations saisies pas l'admin
            if ($userName == $adminUserName && $mdpAdmin == $adminMdp) {
                //enregistrement des infos admin en SESSION
                $_SESSION['admin'] = [
                    'userName' => $userName,
                ];
                header('location:admin.php');
            } else {
                echo "Username or Password incorrecte";
            }
        }
        ?>

    <?php

    } else {
        //Sinon (!empty($_SESSION['admin']['userName]))
    ?>
        <?php
        // verfier si admin est connecté et afficher le bouton deconnecter
        if (!empty($_SESSION['admin']['userName'])) {
        ?>
            <!-- affichage du bouton deconnecter -->
            <li class="nav-item">
                <form method="post">
                    <button type="submit" class="btn btn-danger btn-md px-4 gap-3" name="deconnecter">Se deconnecter</button>
                </form>
            </li>
            <!-- fin affichage bouton deconnecter -->
        <?php
        }
        ?>
        <!-- Banniere  -->
        <div class="px-4 py-4 my-5 text-center container" style="background-color: #8a05f0;">
            <h1 class="display-5 fw-bold" style="color: white;"> Espace admin ! </h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4" style="color:#dbb2fa;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis facere repellat et debitis quibusdam, voluptas sapiente!</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <!-- bouton ajouter velo -->
                    <form action="#" method="post">
                        <button type="submit" class="btn  btn-lg px-4 gap-3" name="ajouter" style="background-color: white; color:#8a05f0;">Ajouter un vélo</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- fin banniere -->
        <?php
        //Instruction si le button ajouter est appuyer
        if (isset($_POST['ajouter'])) {
        ?>
            <!-- Formulaire d'ajout velo -->
            <div class="container-fluid col-xl-10 col-xxl-10 px-4 py-5 " style="background: #dbb2fa">
                <div class="col-md-10 mx-auto col-lg-8">
                    <form action="" method="post" enctype="multipart/form-data" class="p-4 p-md-5 border rounded-3 bg-light">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="modeleVelo" required>
                            <label for="floatingInput">Modèle</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="marqueVelo" required>
                            <label for="floatingInput">Marque</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="typeVelo" required>
                            <label for="floatingInput">Type</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="couleurVelo" required>
                            <label for="floatingInput">Couleur</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" name="prixLocation" required>
                            <label for="floatingInput">Prix</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="floatingInput" name="imageVelo" required>
                            <label for="floatingInput">Image</label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit" name="sauvegarder"> Sauvegarder </button>
                    </form>
                </div>
            </div>
            </div>
            <!-- Fin formulaire ajout velo [les attributs : idVelo et inLocation de seront pas recuperer par formulaire]-->
        <?php
        }


        $PDO = dbConnect();

        if (isset($_POST['sauvegarder'])) {

            //recuperation des donnees saisie 
            $modeleVelo = $_POST['modeleVelo'];
            $marqueVelo = $_POST['marqueVelo'];
            $typeVelo = $_POST['typeVelo'];
            $couleurVelo = $_POST['couleurVelo'];
            $prixLocation = $_POST['prixLocation'];

            //traitement image_velo
            //On verifie si le telechargement est effectuer sans erreur
            if ($_FILES['imageVelo']['error'] == 0) {

                // recuperation nom image
                $image_name = $_FILES['imageVelo']['name'];

                //recuperation emplacement temporaire
                $image_tmpname = $_FILES['imageVelo']['tmp_name'];

                // recuperation de l'heure
                $time = time();

                //on renomme l'image (time + name)
                $nouveau_nom_image = $time . $image_name;

                //on change l'emplacement de l'image
                $move_image = move_uploaded_file($image_tmpname, "img/images/" . $nouveau_nom_image);
                //fin traitement image

                $imageVelo = $nouveau_nom_image;
                $inLocation = 0;

                echo $inLocation;

                //requete d'insertion en bd
                $sql = 'INSERT INTO velos(`modeleVelo`, `marqueVelo`, `typeVelo`, `couleurVelo`, `prixLocation`, `imageVelo`, `inLocation`) VALUES(:modeleVelo, :marqueVelo, :typeVelo,  :couleurVelo, :prixLocation, :imageVelo, :inLocation)';
                $requete = $PDO->prepare($sql);

                //injection des données
                $requete->bindValue(":modeleVelo", $modeleVelo);
                $requete->bindValue(":marqueVelo", $marqueVelo);
                $requete->bindValue(":typeVelo", $typeVelo);
                $requete->bindValue(":couleurVelo", $couleurVelo);
                $requete->bindValue(":prixLocation", $prixLocation);
                $requete->bindValue(":imageVelo", $imageVelo);
                $requete->bindValue(":inLocation", $inLocation);

                //execution de la requete
                $requete->execute();

                header('location:admin.php');
            }
        }
        ?>
        <!-- Affichage de tout les velos -->
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    // Recuperation de tout les velos via la metho getAllVelo
                    $allVelos = getAllVelo();
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
                                        <!-- Bouton delete velo -->
                                        <div class="btn-group">
                                            <form action="delete.php" method="post">
                                                <!-- recuperation id velo && envoi de Id velo sur la page delete -->
                                                <input type="hidden" name="idVelo" value="<?= $allVelo['idVelo']; ?>" required>
                                                <button type="submit" class="btn btn-sm btn-danger" name="delete">Supprimer</button>
                                            </form>
                                        </div>
                                        <small class="text-body-secondary"> <?php if ($allVelo['inLocation'] == 1) {
                                                                                echo "En location";
                                                                            } else {
                                                                                echo "Dispo";
                                                                            } ?> </small>
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
        <!-- Fin affichage velo pour admin -->
    <?php
    }
    include_once('footer.php') ?>
    <script src="style/bootstrap.js"></script>
</body>

</html>