<?php

// Method de connection à la bd mysql via PDO
function dbConnect()
{
    $DB_DNS = 'mysql:host=localhost;dbname=velo';
    $DB_USER = 'root';
    $DB_PASS = '';
    try {
        $database = new PDO($DB_DNS, $DB_USER, $DB_PASS);
    } catch (PDOException $th) {
        echo "Erreur " . $th->getMessage();
    }
    return $database;
}

// recupere tout les velos
function getAllVelo()
{
    $PDO = dbConnect();
    $sql = "SELECT * FROM velos ORDER BY dateAjout Desc";
    $req = $PDO->query($sql);

    $velos = $req->fetchAll();
    return $velos;
}

// recupere les velos disponible
function getVeloDisponible()
{
    $PDO = dbConnect();
    $sql = "SELECT * FROM velos WHERE inLocation = 0 ORDER BY dateAjout Desc";
    $req = $PDO->query($sql);

    $velos = $req->fetchAll();
    return $velos;
}

// recupere les velos en location
function getVeloInLocation()
{
    $PDO = dbConnect();
    $sql = "SELECT * FROM velos WHERE inLocation = 1 ORDER BY dateAjout Desc ";
    $req = $PDO->query($sql);

    $velos = $req->fetchAll();
    return $velos;
}

// rucupere un velo à base de son Id
function getVelo($idVelo)
{
    $PDO = dbConnect();
    $sql = "SELECT * FROM velos WHERE idVelo = '$idVelo' ";
    $req = $PDO->query($sql);

    $velo = $req->fetch();
    return $velo;
}

// supprimer un produit
function deleteVelo($idVelo)
{
    $PDO = dbConnect();
    $sql = "DELETE FROM velos WHERE idVelo = '$idVelo' ";
    $req = $PDO->query($sql);
}

// modifier le statut du velos
function setVeloStatus($idVelo)
{
    $PDO = dbConnect();
    $sql = "UPDATE velos SET inLocation = 1 WHERE idVelo = '$idVelo' ";
    $req = $PDO->query($sql);
}

// set date fin location
function setDateFinLocation($dateDebutLocation, $duree)
{
    $date = "+ " . $duree . " days";
    $dateFinLocation = strtotime($date, strtotime($dateDebutLocation));
    // on formate la date
    $dateFinLocation = date('Y-m-d H:i:s', $dateFinLocation);

    return $dateFinLocation;
}
