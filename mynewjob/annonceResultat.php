<?php 
session_start();

include 'sqlConnect.php';
include("Menu.php"); 

?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Mynewjob</title>
        <link rel="stylesheet" href="StyleAnnonce.css"/>
    </head>
    <body>
        
        <form method="post">
            <input type="submit" id="boutton" value="Retour" name="retour" style="width: 110px; margin-left: 45%">
            <?php
            if (isset($_POST['retour'])) { //si on clique sur retour :
                header('Location: Index.php');
            }
            ?>
        </form>  
        
        <div id="li_content">
	
        <?php
            
            // si le metier est rentré mais pas la zone alors on afficher tous les métiers séléctionnés 
            if (isset($_POST['metier']) and empty($_POST['zone'])){
                $sql = ('SELECT * FROM annonce A, metier M, ville V, zone Z where A.idMetier = M.idMetier AND A.idVille = V.idVille AND V.idZone = Z.idZone AND nomMetier = "'.$_POST['metier'].'" ');
                echo 'Metier séléctionné : ' .$_POST['metier'].'<br>';
                echo 'Zone séléctionné : aucune <br>';
            }elseif (isset($_POST['zone']) and empty($_POST['metier'])){
                $sql = ('SELECT * FROM annonce A, metier M, ville V, zone Z where A.idMetier = M.idMetier AND A.idVille = V.idVille AND V.idZone = Z.idZone AND nomZone = "'.$_POST["zone"].'"');
                echo 'Metier séléctionné : aucun <br>';
                echo 'Zone séléctionné : '.$_POST['zone'].'<br>';
                
            }elseif (isset($_POST['zone']) and isset($_POST['metier'])) {   
                $sql = ('SELECT * FROM annonce A, metier M, ville V, zone Z where A.idMetier = M.idMetier AND A.idVille = V.idVille AND V.idZone = Z.idZone AND nomZone = "'.$_POST["zone"].'" AND nomMetier = "'.$_POST['metier'].'" ');
                echo 'Metier séléctionné : '.$_POST['metier'].'<br>';
                echo 'Zone séléctionné : '.$_POST['zone'].'<br>';
            }
            
            

                //permet de récupérer toutes les informations nécéssaires dans les annonces et de les publier

                $req = $connexion->query($sql);

                while($annonceData = $req->fetch()){
                    echo '<a href="inscription_connexion.php">';
                    echo '<div class="li_offre">';
                    echo '<div class="li_offre_image" style="background-image:url(image/'.$annonceData['imgMetier'].');"></div>';
                    echo '<img src="logo/'.$annonceData['logoMetier'].'" class="li_offre_picto" width="35" height="25"/><br> ';
                    echo '<h2 class="li_offre_titre">'.$annonceData['nomMetier'].'</h2>';
                    echo '<div class="li_offre_soustitre">Agence de '.$annonceData['nomVille'].'</div>';
                    echo '<div class="li_offre_texte">
			Contrat : '.$annonceData['contrat'].'<br/>
			Lieu : '.$annonceData['nomVille'].' '.$annonceData['codePostal'].'<br />
                        Démarrage : '.$annonceData['demarrage'].'<br/>
                        </div>';
                    echo '<div class="li_bouton vert">Voir l\'annonce</div>';
                    echo '</div>';      
                    echo '</a>';
                }
            
        ?>
        </div>
        
 
      
        
    </body>
</html>

