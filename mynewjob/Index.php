<?php 
session_start();

include 'sqlConnect.php';

?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Mynewjob</title>
        <link rel="stylesheet" href="StyleAnnonce.css"/>
        <?php include("Menu.php"); ?> <!-- Mettre la bare de navigation -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- importer des codes jquery pour fonction java -->   
        <style>
            h2{margin-bottom: 3%;}
        </style>
    </head>
    <body>
         
        <div class="presentationIndex">
            <h2>mynewjob</h2> 
            <p style="width: 100%; text-align: center; margin-bottom: 2%;" >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla lacinia sem metus, eu tincidunt enim semper et. Aenean suscipit, purus vitae vulputate sagittis, ex purus lacinia quam, eget mollis felis nulla quis odio. Duis tincidunt urna ac enim interdum porttitor. Nunc ultrices rhoncus eros ut feugiat. Phasellus dapibus turpis at massa tristique mollis. Proin ut sodales dolor. Nulla facilisi. Etiam ut tincidunt mauris. Proin ultricies tincidunt efficitur. Suspendisse finibus eros massa. Mauris porta est nec volutpat molestie. Nam nec libero eu sapien mattis laoreet. In a odio et felis vehicula porta in nec ligula. Mauris semper ligula vel dolor rutrum placerat. Praesent varius gravida hendrerit. Aliquam in elit vitae massa suscipit porta.</p>
        </div>  
        
        
        <div class="offreIndex" id="offre">
            <?php include 'exempleOffres.php'; ?>
        </div> 
<!--code dans exempleOffre.php-->
                <script type="text/javascript">
                    var auto_refresh = setInterval(
                    function ()
                    {
                    $('#offre').load('exempleOffres.php');
                    }, 10000); // rafraichit toutes les 10 secondes


                </script> 

        
        <div class="moduleRecherche" >
            
            <h2>Module de recherche</h2>
            
            <form method="POST" action="annonceResultat.php">
                
                <label for="zone" class="titre-recrutement">Chercher dans une zone:</label><br>
                <input list="zone" id="zoneInput" class="text-recrutement" name="zone" autocomplete="off" style="margin-bottom: 3%" oninput="isCharSet()">
                
                <!-- datalist possède les informations des zones (ex: zone orléans) -->
                <datalist id="zone" class="text-recrutement">
                    
                <?php 
                //récupère tous les nomZone dans la table zone, la parcours puis affiche les valeurs
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

                <!-- Permet d'activer le bouton "chercher" seulement si la valeur entré est égale au nomZone ou/et nomMetier de la base de donnée -->
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
    </body>
</html>
            

            
       

