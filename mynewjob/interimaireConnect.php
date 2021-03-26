<?php

session_start();

require ('sqlconnect.php');
require ('menu2.php');

//on récupère toutes les données d'annonce ainsi que celle des clés étrangères
$sql = ('SELECT * '
        . 'FROM interimaire I, travailler T, metier M, ville V, civilite C, transport TR, permis P, tempstravail TE, momenttravail MO, deplacementtravail D '
        . 'WHERE I.idInterimaire = T.idInterimaire '
        . 'AND T.idMetier = M.idMetier '
        . 'AND I.idVille = V.idVille '
        . 'AND i.idCivilite = C.idCivilite '
        . 'AND I.idTransport = TR.idTransport '
        . 'AND I.idPermis = P.idPermis '
        . 'AND I.idTempsTravail = TE.idTempsTravail '
        . 'AND I.idMomentTravail = MO.idMomentTravail '
        . 'AND I.idDeplacementTravail = D.idDeplacementTravail '
        . 'AND email = "'.$_SESSION['email'].'" '
        . 'AND mdp = "'.$_SESSION['mdp'].'"');

//on met ces données dans des variables de session
$requser = $connexion->query($sql);
$x = 0;
while($interiminfo = $requser->fetch()){
    $_SESSION['telephone'] = $interiminfo['telephone'];
    $_SESSION['adresse'] = $interiminfo['adresse'];
    $_SESSION['dateDeNaissance'] = $interiminfo['dateDeNaissance'];
    $_SESSION['nomCivilite'] = $interiminfo['nomCivilite'];
    $_SESSION['codePostal'] = $interiminfo['codePostal'];
    $_SESSION['nomVille'] = $interiminfo['nomVille'];
    $_SESSION['maxKm'] = $interiminfo['maxKm'];
    $_SESSION['nomTransport'] = $interiminfo['nomTransport'];
    $_SESSION['nomTempsTravail'] = $interiminfo['nomTempsTravail'];
    $_SESSION['nomMomentTravail'] = $interiminfo['nomMomentTravail'];
    $_SESSION['nomDeplacementTravail'] = $interiminfo['nomDeplacementTravail'];
    
    $_SESSION['nomMetier'][$x] = $interiminfo['nomMetier'];
    $x++; // permet d'afficher tous les métiers d'un interimaire (table travailler)
    
}
//si on appuie sur enregistrer 
if (isset($_POST['enregistrer'])){
    //et qu'il y a un fichier :
    if (isset($_FILES)){
        $file_name = $_FILES['fichier']['name']; // met le nom du fichier dans une variable
        $file_tmp_name = $_FILES['fichier']['tmp_name']; // nom temporaire du fichier sotcké dans le serveur
        $file_dest = 'C:/Users/Logic Interim 5/Desktop/files/'.$_SESSION['idInterimaire'].'_'.$_SESSION['nom'].'_'.$_SESSION['prenom'].'/'.$file_name; //nom du dossier de l'utilisateur stocker dans une variable
        
        if(file_exists($file_dest)){ // si le fichier que l'on rentre existe :
            echo "Le fichier existe deja ou vous n'avez pas mit de fichier."; 
            
            // sinon on déplace le fichier téléchargé et on inscrit ce fichier dans la base de donnée
        } elseif(move_uploaded_file($file_tmp_name ,$file_dest)){
            $req = $connexion->prepare('INSERT INTO document(name, file_url, idInterimaire) VALUES (?,?,?)');
            $req->execute(array($file_name, $file_dest, $_SESSION['idInterimaire']));
            header('Location: interimaireConnect.php');
        } 
            
    }
}
// si on appui sur supprimé
if (isset($_POST['supprimer'])){
    
    $id = $_REQUEST['id']; //on reprend la valeur du select id c'est a dire idFichier
    
    $sql2 = 'SELECT * FROM document WHERE idFichier = "'.$id.'";';
    $requser = $connexion->query($sql2);
    while ($fichierID = $requser->fetch()){
        $_SESSION['name'] = $fichierID['name'];
    }
    
    $sql = ('DELETE FROM document WHERE idFichier ='.$id.'');
    $req = $connexion->exec($sql);
    
    //on supprime le fichier séléctionné du dossier de l'utilisateur
    unlink('C:/Users/Logic Interim 5/Desktop/files/'.$_SESSION['idInterimaire'].'_'.$_SESSION['nom'].'_'.$_SESSION['prenom'].'/'.$_SESSION['name'].'');
    header('Location: interimaireConnect.php');
}
            
                

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mynewjob</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    
    <body>
        <div class="informationInterimaire">
        
     
            
            <div class="informationSéparation">
                <p><b>Civilité: </b><?php echo $_SESSION['nomCivilite'] ?></p>
                <p><b>Nom: </b><?php echo $_SESSION['nom'] ?></p>
                <p><b>Prenom: </b><?php echo $_SESSION['prenom'] ?></b></p>
                <p><b>Date de Naissance: </b><?php echo $_SESSION['dateDeNaissance'] ?></p>
                <p><b>Telephone: </b><?php echo '+33'.$_SESSION['telephone'] ?></p>
                
            </div>
            
            <div class="informationSéparation2">        
                <p><b>Metier:</b>
                    <?php for($i=0 ; $i<=1 ; $i++){
                        echo $_SESSION['nomMetier'][$i].' ' ;
                    }?> 
                </p>
                <p><b>Distance max: </b><?php echo $_SESSION['maxKm'].' Km' ?></p>
                <p><b>Moyen de transport: </b><?php echo $_SESSION['nomTransport'] ?></p>
                <p><b>email: </b><?php echo $_SESSION['email'] ?></p>
                <p><b>Lieu: </b><?php echo $_SESSION['codePostal'].' '.$_SESSION['nomVille'] ?></p>
                
            </div>
            
            <div class="informationSéparation3">
                <p><b>horaire:</b><br><?php echo $_SESSION['nomTempsTravail'].'<br>'.$_SESSION['nomMomentTravail'].'<br>'.$_SESSION['nomDeplacementTravail'] ?></p>

                
            </div>
            
            <div class="moduleRecherche" style="width: 100% ; margin-top: 5%; border-top: 20px solid white;">
            
                <h2 style="margin-bottom: 3%; margin-top: 3%">Module de recherche</h2>

                <form method="POST" action="annonceResultatInterimaire.php">

                    <label for="zone" class="titre-recrutement">Chercher dans une zone:</label><br>
                    <input list="zone" id="zoneInput" class="text-recrutement" name="zone" autocomplete="off" style="margin-bottom: 3%" oninput="isCharSet()">

                    <datalist id="zone" class="text-recrutement">

                    <?php 
                        $req = $connexion->query('SELECT nomZone FROM zone;');
                        while ($donnee = $req->fetch()){

                        echo '<option value="'.$donnee['nomZone'].'"></option>';

                        }


                    ?>
                    </datalist><br>


                    <label for="metier" class="titre-recrutement">Chercher un métier:</label><br>
                    <input type="text" id="metierInput" list="metier" class="text-recrutement" name="metier" autocomplete="off" oninput="isCharSet()">

                    <datalist id="metier">

                    <?php 
                        $req = $connexion->query('SELECT nomMetier FROM metier;');
                        while ($donnee = $req->fetch()){

                        echo '<option value="'.$donnee['nomMetier'].'"></option>';

                        }


                    ?>

                    </datalist><br>

                    <input type="submit" value="Chercher" name="chercher" id="boutton" title="Veuillez saisir une information valide" disabled>

                    <script type="text/javascript">

                        let btn = document.getElementById('boutton');                   

                        // ajout d'une fonction appelee des que l'input change
                        function isCharSet() {
                            //récupération de la liste des zones
                            zones = [];
                            for (child of document.getElementById("zone").children) { 
                                zones.push(child.value);
                            }
                            // récupération de la liste des jobs
                            jobs = [];
                            for (job of document.getElementById("metier").children) {
                              jobs.push(job.value);
                            }

                            if (zones.includes(document.getElementById("zoneInput").value) || jobs.includes(document.getElementById("metierInput").value) ) {
                                btn.disabled = false;
                                console.log("Correspondance entre l'entrée utilisateur et les options ! Le bouton s'active !");
                            }
                            else {
                                console.log("L'entrée utilisateur est invalide, le bouton ne s'active pas.");
                                btn.disabled = true;
                            }
                        } 

                    </script>   
                </form>
            </div>
        </div>
        
        <div class="fichierInterimaire" >
            <h1 style="margin-top: 3%;">Envoyé vos fichiers</h1>
            <form method="POST" enctype="multipart/form-data">

                <input type="file" name="fichier" ><br>
              
                <input type="submit" id="bouttonConnecté" style="font-weight: bold;" name="enregistrer" value="Enregistrer">

            <?php 
            $requ = $connexion->query('SELECT name, file_url FROM document where idInterimaire = '.$_SESSION['idInterimaire'].'');

            //Si $requ trouve des valeur dans la base de donnée du compte interimaire, alors on affiche :
            if(true == $requ->fetchAll()){

                ?>

                <h1 style="margin-top: 10%;">Fichiers enregistrés</h1>

                <?php
                $req = $connexion->query('SELECT name, file_url FROM document where idInterimaire = '.$_SESSION['idInterimaire'].'');
                echo '---------------------------------------------------- <br>';

                while($data = $req->fetch()){
                    echo $data['name'].'<br>';
                    echo '---------------------------------------------------- <br>';
                }
                ?>


                <h1 style="margin-top: 10%;">Supprimer un fichier</h1>
                <select name="id"> <!--  id prendra la valeur de value <option> dans le php en haut de la page-->

                    <?php


                    $req =('SELECT * FROM document where idInterimaire = '.$_SESSION['idInterimaire'].''); 
                    $resultat = $connexion->query($req);

                    while ($ligne = $resultat->fetch(PDO::FETCH_OBJ)){   
                        echo '<option selected value='.$ligne->idFichier.'>'.$ligne->name.'</option>';
                    }   

                    ?>    

                </select><br>

                <input type="submit" name="supprimer" id="bouttonConnecté" style="color: red; font-weight: bold;" value="Supprimer">

            <?php

            } 

            ?>
            </form>
        </div>
    </body>
</html>


