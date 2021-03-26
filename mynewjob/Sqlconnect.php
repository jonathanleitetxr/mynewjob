<?php

// Connection au serveur
try {

    
    $dns = 'mysql:host=localhost:3307;dbname=mynewjob';
    $utilisateur = 'root';
    $motDePasse = '';
    $connexion = new PDO( $dns, $utilisateur, $motDePasse );
    $connexion->query("SET NAMES utf8");
} catch ( Exception $e ) {
    echo "Connexion à MySQL impossible : ", $e->getMessage();
    die();
}



    ?>

