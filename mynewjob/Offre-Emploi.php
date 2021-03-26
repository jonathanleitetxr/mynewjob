<?php 

include("menu.php"); 

include("sqlConnect.php");

?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Mynewjob</title>
        <link rel="stylesheet" href="StyleAnnonce.css"/>
    </head>
    <body>          
        <div id="li_content">
       
        
        <?php
        
            //permet de récupérer le nombre d'annonce et de l'afficher
        
            $req2 = $connexion->query('SELECT count(*) from annonce')->fetchColumn();
                
            echo '<h2 style="text-align: center"> Il y a actuellement <b>'.$req2.'</b> annonces</h2>';
               
            // Il y a plusieurs code qui affichent des annonces mais ils ne sont pas exactement pareil (ex: le lien de la balise  <a>)
            //permet de récupérer toutes les informations nécéssaires dans les annonces et de les publier
            $req = $connexion->query('SELECT * FROM annonce A, metier M, ville V where A.idMetier = M.idMetier AND A.idVille = V.idVille');

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

