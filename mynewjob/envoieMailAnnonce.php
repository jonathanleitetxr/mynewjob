<?php

session_start();

require("Sqlconnect.php");

//Barre de navigation pour les candidats/interimaire
require("menu2.php");

?>


<html>
    <head>
        <title>Mynewjob</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet">
    </head>
    <body>
        
    </body>
</html>  



<?php
    //Envoie de mail pas fini
    if(isset($_POST['annonce'])){
       
        $entete  = 'MIME-Version: 1.0' . "\r\n";
        $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $entete .= 'From: ' . $_POST['email'] . "\r\n";

        $message = '<h1>Message envoyé de BoomEmploie</h1>
            <h2>Entreprise : </h2>
        <b>Nom :</b>' . $_POST['nomEntreprise'] . '<br>
        <b>Siren : </b>' . $_POST['siren'] . '<br>
        <b>Code APE : </b>' . $_POST['ape'] . '<br>
        <b>Adresse : </b>' . $_POST['adresseEntreprise'] . '<br>
            <h2>Interlocuteur</h2>
        <b>Nom : </b>' . $_POST['nom'] . '<br>
        <b>Prenom : </b>' . $_POST['prenom'] . '<br>
        <b>Email : </b>' . $_POST['email'] . '<br>
        <b>Telephone : </b>' . $_POST['nom'] . '<br>
        <b>Annonce : </b>' . $_POST['annonce'] . '</p>';

        $retour = mail('xwjxw16@gmail.com', 'Envoi depuis page recrutementInterim', $message, $entete);

        if($retour) {
            echo '<p>Votre message a bien été envoyé.</p>';
        }else{
            echo '<p>Erreur.</p>';
        }
    }
    ?>