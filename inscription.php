
<?php 
session_start();
// Nécessaire pour se connecter à la base de données
require "dbconnect.php";
$pdo = connect();
//L'instruction include_once inclut et évalue le fichier spécifié durant l'exécution du script. 
//Le comportement est similaire à include, mais la différence est que si le code a déjà été inclus,
//il ne le sera pas une seconde fois, et include_once retourne true.
//Comme son nom l'indique, le fichier sera inclut une seule fois.
include_once('cookieconnect.php');


// Les 3 champs doivent être renseignés pour faire une inscription d'utilisateur
if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['validationPassword'])){

   
   // Si les champs du formulaire ne sont pas vides alors ont peut traiter la demande

	//Variables
        //Cette fonction htmlspecialchars est utilisé pour coder l'entrée d'utilisateur sur un site Web 
    //afin que les utilisateurs ne peuvent pas insérer des codes HTML nuisibles dans une page web.
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    //Nous voulons juste hacher notre mot de passe en utiliant l'algorithme par défaut.
    //Actuellement, il s'agit de BCRYPT, ce qui produira un résultat sous forme de chaîne de
    //caractères d'une longueur de 60 caractères.
    $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $validationpassword = htmlspecialchars($_POST['validationPassword']);
    // var_dump($pass_hash);
    // htmlspecialchars est une fonction PHP qui permet de convertir les caractères spéciaux en entités html

	// htmlspecialchars(); convert special html symbols to special chars...

	// les filtres sont utilisés pour valider les données

	// Cela nous permet de nous prémunir des failles XSS, que vous verrez en formation diplomante

//Adresse Email invalide
//On vérifie que le format donné dans les champs email correspond à un format email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header('location:inscription.php?error=1&message=Mauvais format email.');
    exit();
}

	// Vérification de la concordance des deux mots de passe

if($password != $validationpassword){
//on fera un message d'erreur et on redirige vers l'inscription
header('location:inscription.php?error=1&message=Vos mots de passe ne sont pass identique.');
exit();
}
$req = $pdo->prepare("SELECT COUNT(*) AS nbMail FROM utilisateur WHERE email = ?");
$req->execute(array($email));

while($email_verification = $req->fetch()){
    if($email_verification['nbMail'] !=0){
        header('location:inscription.php?error=1&message=Votre adresse email est déjà utilisée');
        exit();
    }
}
//ENVOI EN BDD
//prépare la requête
$req = $pdo->prepare("INSERT INTO utilisateur(email,mdp) VALUES(?,?)");
//Execute la requête
$req->execute(array($email,$pass_hash));

// Une requête préparée nous permet de nous prémunir des failles SQL
header("Location:portail.php?success=1");
exit();
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
</head>
<body>
    
<div id="container">
            <!-- zone de connexion -->
            
            <form  action="inscription.php" method="POST">
                 <div class="bloc">  
                    <div class="connexion">
                            <img class="logoCdiscount"
                                src="/PortailConnexion/css/img/CDISCOUNT.PNG"
                                alt="Logo Cdiscount">
                         

                            <h3>Inscription</h3>
                            <?php 
                                if(isset($_GET['error'])){
                                if(isset($_GET['message'])){
                                    echo '<div class="alert error">'.htmlspecialchars($_GET['message']).'</div>';
                                }
                            }else if(isset($_GET['success'])){
                                echo '<div class="alert success">Vous êtes désormais inscrit.<a href="portail.php">Connectez-Vous</a></div>';
                            }
                            ?>
                            
                            <input type="email" placeholder="E-mail" name="email" required>

                            <input type="password" placeholder="Mot de passe" name="password" required>
                           
                            <input type="password" placeholder="Validation du mot de passe" name="validationPassword" required>


                            <input class="buttonInscription" type="submit" name="Submit" id='submit' value="S'inscrire" >
                        </div>
                        <div class="connexion">
                            <h3>Déjà client?</h3>
                            <a class="buttonConnexion" name="connexion" id='connexion'href="portail.php" >Connexion</a>
                    </div>
                </div>  
            </form>
     
        </div>

</body>
</html>