<?php

session_start();

require("Sqlconnect.php");

//Barre de navigation pour les candidats/interimaire
require("menu.php");

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Mynewjob</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet">
    </head>
   <body>
       
       
        <div class="connexionInterimaire">
            <h1>Connexion interimaire</h1><br>
            <form method="POST">
                 <label class="titre-recrutement"> email</label>
                     <div>
                         <input type="email" class="text-recrutement" name="email" required />
                     </div><br>

                     <label class="titre-recrutement"> mot de passe</label>
                     <div>
                         <input type="password" class="text-recrutement" name="mdp" required/> 
                     </div><br>

                 <input type="submit" id="boutton" name="btn-connect" value="Connexion">
                 <p>Vous n'avez pas encore de compte interimaire? Alors <a href="inscriptionInterimaire.php">Inscrivez-vous ici</a></p>
            

<?php
//Si on appuie sur le bouton connexion
if(isset($_POST['btn-connect']))
  {
    //On récupère l'email et le mot de passe
    $emailconnect = htmlspecialchars($_POST['email']);
    $mdpconnect = sha1($_POST['mdp']);
    //Si il y a un email et un mdp
    if(isset($emailconnect) AND isset($mdpconnect))
    {
        
      $requser = $connexion->prepare("SELECT * FROM interimaire WHERE email = ? AND mdp = ?");
      $requser->execute(array($emailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      //Si la base de donnée trouve les informations rentrées 
      if($userexist == 1)
      {
        $userinfo = $requser->fetch();
            $_SESSION['email'] = $userinfo['email'];
            $_SESSION['mdp'] = $userinfo['mdp'];
            $_SESSION['idInterimaire'] = $userinfo['idInterimaire'];
            $_SESSION['nom'] = $userinfo['nom'];
            $_SESSION['prenom'] = $userinfo['prenom'];

        echo "Vous êtes connecté";
        header("Location: interimaireConnect.php");

      }
      //Si la base de donnée ne trouve pas les informations rentrées 
      else
      {
        echo "Mauvais mail ou mauvais mot de passe";
      }
    }
  }
?>

            </form>
        </div>
       
   
       
       
        <div class="connexionEntreprise">
            <h1>Connexion Entreprise</h1><br>
            <form method="POST">
                <label class="titre-recrutement"> email</label>
                    <div>
                        <input type="email" class="text-recrutement" name="email" required />
                    </div><br>

                    <label class="titre-recrutement"> mot de passe</label>
                    <div>
                        <input type="password" class="text-recrutement" name="mdp" required/> 
                    </div><br>
                    
                    <input type="submit" id="boutton" type="" name="btn-connect2" value="Connexion">
                <p>Vous n'avez pas encore de compte entreprise? Alors <a href="inscriptionEntreprise.php">Inscrivez-vous ici</a></p>
            

<?php
//Si on appuie sur le bouton connexion
if(isset($_POST['btn-connect2']))
  {
    //On récupère l'email et le mot de passe
    $emailconnect = htmlspecialchars($_POST['email']);
    $mdpconnect = sha1($_POST['mdp']);
    //Si il y a un email et un mdp
    if(isset($emailconnect) AND isset($mdpconnect))
    {
      $requser = $connexion->prepare("SELECT * FROM entreprise WHERE emailEnt = ? AND mdpEnt = ?");
      $requser->execute(array($emailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      //Si la base de donnée trouve les informations rentrées 
      if($userexist == 1)
      {
        $userinfo = $requser->fetch();
        $_SESSION['siren'] = $userinfo['siren'];
        $_SESSION['nomEnt'] = $userinfo['nomEnt'];
        $_SESSION['ape'] = $userinfo['ape'];
        $_SESSION['adresseEnt'] = $userinfo['adresseEnt'];        
        $_SESSION['telephoneEnt'] = $userinfo['telephoneEnt'];
        $_SESSION['emailEnt'] = $userinfo['emailEnt'];
        $_SESSION['mdpEnt'] = $userinfo['mdpEnt'];
        echo "Vous êtes connecté";
        header("Location: entrepriseConnect.php");

      }
      //Si la base de donnée ne trouve pas les informations rentrées 
      else
      {
        echo "Mauvais mail ou mauvais mot de passe";
        
      }
    }
  }
  
?>

            </form>
        </div>
       
    </body>
</html>

