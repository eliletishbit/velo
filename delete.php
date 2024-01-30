<?php
include('method.php');
// appel à la methode deleteVelo() pour supprimer le velo
if (isset($_POST['delete'])) {
    $idvelo = $_POST['idVelo'];
    deleteVelo($idvelo);
}

header('location:admin.php');