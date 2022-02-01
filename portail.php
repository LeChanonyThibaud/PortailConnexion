
<?php 
session_start();
require "dbconnect.php";
$pdo = connect();
// include_once('cookieconnect.php');

// Si les champs du formulaire ne sont pas vides alors 
//on peut traiter la demande de connexion
if(!empty($_POST['email']) && !empty($_POST['password'])){
    
	//Variables
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
 
    //Filtre une variable avec un filtre spécifique
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        //on fera un message
    }
    	//Connexion au site
    $req = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $req->execute(array($email));

    
    // fetch Récupère la ligne suivante d'un jeu de résultats PDO 
    while($user = $req->fetch()){
        // si le mot de passe donné dans le formulaire
        //correspond au mot de passe de l'utilisateur en bdd
    
        if(password_verify($_POST['password'], $user['mdp'])){
           
            $_SESSION['email']= $user['email'];
            $_SESSION['password']= $user['mdp'];

            
            $_SESSION['connect']= 1;
            if(isset($_POST['remember'])){
                //Envoie un cookie
                setcookie('email', $email, time()+365*24*3600,null, null, false, true);
            }
            
            // header("Location:success.php");
            echo "Vous êtes connecté";
        
        }
       else{
           echo "oups";
       }
    
       
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
    
    <script type="text/javascript" src="/tarteaucitron/tarteaucitron.js"></script>


</head>
<body>
    
<div id="container">
            <!-- zone de connexion -->
            
            <form  action="portail.php" method="POST">
                 <div class="bloc">  
                    <div class="connexion">
                            <img class="logoCdiscount"
                                src="/PortailConnexion/css/img/CDISCOUNT.PNG"
                                alt="Logo Cdiscount">
                          
                                <?php if(isset($_SESSION['connect'])) {    
                                    //  var_dump($_SESSION['req']);
                                   // header("Location:success.php");
                                
                                ?>

                                <h1>Bonjour !</h1>


                             
                                <small><a href="logout.php">Déconnexion</a></small>


                                <?php } else{ ?>

                                  <h1>S'identifier</h1>
                                <?php } ?>

                            <h3>Déjà client?</h3>
                            
                            <input type="email" placeholder="E-mail" name="email" required>

                            <input type="password" placeholder="Mot de passe" name="password" required>
                            <!-- Ceci est la case à cocher et nous allons chercher pour notre cookie "remembermeu" si on le trouve alors on va cocher la case avec "checked"-->
                            <input type="checkbox" id="rememberme" name="remember" value="1" >
                            <label for="rememberme">Se souvenir de moi</label>

                            <input class="buttonConnexion" type="submit" name="Submit" id='submit' value='Se connecter' >
                        </div>
                        <div class="inscription">
                            <h3>Nouveau client?</h3>
                            <a class="buttonInscription" name="Inscription" id='inscription'href="inscription.php" >Créer un compte</a>
                    </div>
                </div>  
            </form>
     
        </div>
   
</body>
</html>