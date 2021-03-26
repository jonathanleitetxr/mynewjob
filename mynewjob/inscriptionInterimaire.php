<?php

//Connexion à la base de donnée
require("Sqlconnect.php");

//Barre de navigation des inscriptions
require("menu2.php");

session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mynewjob</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Style.css"/>
    </head>
    <body style="background-color: #74367c;">
        
        <h1 style="text-align: center; margin-bottom: 2%">Inscription Intérimaire</h1>
        
        <div class="inscription" style="text-align: center;">
            <form method="POST">
                <label class="titre-recrutement"> Nom</label>
                    <div>
                        <input type="text" class="text-recrutement" name="nom"/>
                    </div><br>

                <label class="titre-recrutement"> Prenom</label>
                    <div>
                        <input type="text" class="text-recrutement" name="prenom"/> 
                    </div><br>

                <label class="titre-recrutement"> Numéro de téléphone</label>
                    <div>
                        <input type="text" class="text-recrutement" name="tel" pattern="^0[0-9]([0-9]{2}){4}$" title="Veuillez saisir un numéro de téléphone valide comme 0784785968 sans espace" maxlength="20"/>
                    </div><br>

                <label class="titre-recrutement"> Adresse e-mail</label>
                    <div>
                        <input type="email" class="text-recrutement"  name="email" title="Veuillez saisir une adresse éléctronique valide comme exemple@gmail.com "/>
                    </div><br>

                <label class="titre-recrutement"> Mot de passe</label>
                    <div>
                        <input type="password" class="text-recrutement" name="mdp" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Le mot de passe doit comporter au moins 8 caractères, une majuscule, une minuscule et un chiffre "/>
                    </div><br>

                    
                    
                    
                    
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
   
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $tel = htmlspecialchars($_POST['tel']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']);
        
        
            //Si les cases sont remplies
            if($nom !== '' && $prenom !== '' && $tel !== '' && $email !== '' && $mdp !== '')
            {
                $reqmail = $connexion->prepare("SELECT * FROM interimaire WHERE email = ?");
                $reqmail->execute(array($email));
                $mailexist = $reqmail->rowCount();
                //Si l'email entré est différent des emails de la base de donnée, alors on rajoute les données
                if ($mailexist==0 )
                {
                    $sql = $connexion->prepare("INSERT INTO interimaire (nom, prenom, telephone, email, mdp) VALUES(?, ?, ?, ?, ?)");
                    $sql->execute(array($nom, $prenom, $tel, $email, $mdp));
                    echo "Vous êtes maintenant inscrit, Félicitation !";   
                    
                    //Création d'un dossier pour l'interimaire 
                    $sql2 = 'SELECT * FROM interimaire WHERE email = "'.$email.'";';
                    $requser = $connexion->query($sql2);
                    while ($interimaireID = $requser->fetch()){
                        $_SESSION['idInterimaire'] = $interimaireID['idInterimaire'];
                    }
                    //créer le dossier dans le dossier "files" avec l'id, le nom et le prénom
                    mkdir('/Users/Logic Interim 5/Desktop/files/'.$_SESSION['idInterimaire'].'_'.$nom.'_'.$prenom,0777,TRUE);
                    
                    
                    
                } else {
                    echo "Cette adresse mail ou cette identifiant est déjà utilisée";
                }
            
            } else {
                echo "Tous les champs doivent être complétés";
            }
               
            
            

            
        }
    
?>