<?php 

include 'sqlConnect.php'; 

?>


    
    <h2>Offre Emploie Exemple</h2>

    <div class="li_animation">
        
        <?php
        // si le metier est rentré mais pas la zone alors on afficher tous les métiers séléctionnés 

        $req = $connexion->query('SELECT * FROM annonce A, metier M, ville V where A.idMetier = M.idMetier AND A.idVille = V.idVille order by rand() limit 4');

        while($annonceData = $req->fetch()){
            echo '<a href="inscription_connexion.php">';
            echo '<div class="li_offre" style="width: 30%; margin-left: 10%">';
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