<!-- La barre de navigation du menu pour les inscriptions et quand on est connecté -->
        
<link rel="stylesheet" href="Style.css"/>
<!--Bootstrap css-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        
    <?php
    
        if (isset($_SESSION['email'])) { ?>
            
        <nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background: #8ec048;">
            

            <img src="https://www.logic-interim.fr/wp-content/themes/logicinterim/images/logo_logicinterim.png" width=100 ">

        <div>
            <form method="POST">   
                <ul class="navbar-nav my-3">
                    <li class="nav-item active ">
                       <input type="submit" class="btn bouton" name="deco" style="margin-left: 100px" value="Déconnexion interimaire">
                       <?php 
                            if (isset($_POST['deco'])) {
                                $_SESSION = array();
                                session_destroy();
                                header('Location: inscription_connexion.php');
                            }      
                       ?>
                    </li> 
                    <li style="margin-left: 20%; white-space: nowrap;"><b>
                        <?php  
                            echo 'Connexion : '.$_SESSION['nom'].' '.$_SESSION['prenom'].''; 
                        ?>     
                    </b></li>
                   
    
                </ul>
            </form>
        </div>
    </nav>
            
       
    <?php  
        }elseif (isset($_SESSION['nomEnt'])) { ?>
            
        <nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background: #5dff00;">
            

            <img src="https://www.logic-interim.fr/wp-content/themes/logicinterim/images/logo_logicinterim.png" width=100 ">

        <div>
            <form method="POST">   
                <ul class="navbar-nav my-3">
                   <li class="nav-item active ">
                       <input type="submit" class="btn bouton" name="deco2" style="margin-left: 100px" value="Déconnexion Entreprise">
                       <?php 
                            if (isset($_POST['deco2'])) {
                                $_SESSION = array();
                                session_destroy();
                                header('Location: inscription_connexion.php');
                            }      
                       ?>
                   </li>
                   <li style="margin-left: 20%; white-space: nowrap;"><b>
                        <?php  
                            echo 'Connexion : '.$_SESSION['nomEnt'].''; 
                        ?>     
                    </b></li>
    
                </ul>
            </form>
        </div>
    </nav>
         
        
    <?php
        }else{
    ?>
        <nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background: #5dff00;">

            <a href="index.php" class="navbar-brand" style="margin-bottom: -10px">
                <img src="https://www.logic-interim.fr/wp-content/themes/logicinterim/images/logo_logicinterim.png" width=100 ">
            </a>

        </nav>
    
    <?php 
        }
    ?>
        
        
        
        
        
        
        
<!--Bootstrap-->        
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>