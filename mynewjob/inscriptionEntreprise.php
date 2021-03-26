<?php 

require 'Sqlconnect.php';

require("menu2.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mynewjob</title>
        <meta charset="UTF-8">
    </head>
    
    <!-- Champ a remplir -->
    <body style="background-color: #74367c;">
        
        <h1 style="text-align: center; margin-bottom: 2%">Inscription Entreprise</h1>
        
        <div class="recrutement" style="text-align: center;">
            <form method="POST">
                <label class="titre-recrutement"> Siren</label>
                    <div>
                        <input type="text" class="text-recrutement" name="siren" pattern="([0-9]){9}" title="Veulliez saisir un numéro SIREN valide comme 362521879 sans espace" minlength="9" maxlength="20" />
                    </div><br>

                <label class="titre-recrutement"> Nom </label>
                    <div>
                        <input type="text" class="text-recrutement" name="nomEnt"/> 
                    </div><br>

                <label class="titre-recrutement"> Code APE </label>
                    <div>
                        <input type="text" class="text-recrutement" name="ape" pattern="([0-9][-. ]?){4}[A-z]$" title="Veuillez saisir un code APE valide comme 9999Z ou 9999z" minlength="5" maxlength="10" />
                    </div><br>

                <label class="titre-recrutement"> Adresse</label>
                    <div>
                        <input type="text" class="text-recrutement" name="adresseEnt"/>
                    </div><br>

                <label class="titre-recrutement">Numéro de téléphone</label>
                    <div>
                        <input type="text" class="text-recrutement" name="telEnt" pattern="^0[0-9]([0-9]{2}){4}$" title="Veuillez saisir un numéro de téléphone valide comme 0784785968 sans espace" maxlength="20"/>
                    </div><br>
                    
                <label class="titre-recrutement">Adresse e-mail</label>
                    <div>
                        <input type="email" class="text-recrutement"  name="emailEnt" title="Veuillez saisir une adresse éléctronique valide comme exemple@gmail.com "/>
                    </div><br>
                    
                <label class="titre-recrutement">Mot de passe</label>
                    <div>
                        <input type="password" class="text-recrutement" name="mdpEnt" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Le mot de passe doit comporter au moins 8 caractères, une majuscule, une minuscule et un chiffre "/>
                    </div>

                <input type="submit" id="boutton" name="btn-connect" value="Inscription">
                
                <input type="submit" id="boutton" value="Retour" name="retour" style="width: 110px;">
                    <?php 
                        if (isset($_POST['retour'])){
                            header('Location: inscription_connexion.php'); 
                        }    
                    ?>
               
            
            </form>
        </div>    
    </body>
</html>
    
             
    <?php
        //Si on appuie sur le boutton Inscription
        if (isset($_POST['btn-connect'])){

        //Récupérer les données
        $siren = htmlspecialchars($_POST['siren']);
        $nomEnt = htmlspecialchars($_POST['nomEnt']);
        $ape = htmlspecialchars($_POST['ape']);
        $adresseEnt = htmlspecialchars($_POST['adresseEnt']);
        $telEnt = htmlspecialchars($_POST['telEnt']);
        $emailEnt = htmlspecialchars($_POST['emailEnt']);
        $mdpEnt = sha1($_POST['mdpEnt']);
        
        
            //Si toutes les données sont remplis
            if($siren !== '' && $nomEnt !== '' && $ape !== '' && $adresseEnt !== '' && $telEnt !== '' && $emailEnt !== '' && $mdpEnt !== '')
            {
                $reqmail = $connexion->prepare("SELECT * FROM entreprise WHERE emailEnt = ?");
                $reqmail->execute(array($emailEnt));
                $mailexist = $reqmail->rowCount();
                //Si l'email entré est différent des emails de la base de donnée, alors on rajoute les données
                if ($mailexist==0 )
                {
                    $sql = $connexion->prepare("INSERT INTO entreprise (siren, nomEnt, ape, adresseEnt, telephoneEnt, emailEnt, mdpEnt) VALUES(?, ?, ?, ?, ?, ?, ?)");
                    $sql->execute(array($siren, $nomEnt, $ape, $adresseEnt, $telEnt, $emailEnt, $mdpEnt));
                    echo "Vous êtes maintenant inscrit, Félicitation !";   
                }
                else {
                    echo "Cette adresse mail ou cette identifiant est déjà utilisée";
                }
            }
        else{
            echo "Tous les champs doivent être complétés";
            }
        }
        
    
    ?>


