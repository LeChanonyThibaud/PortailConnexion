<?php
require "dbconnect.php";
$pdo = connect();
// include_once('cookieconnect.php');
session_start();
if(!isset($_SESSION['id']) AND isset($_COOKIE['email'],$_COOKIE['password']) AND !empty($_COOKIE['password'])){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    //on fera un message
}
    //Connexion au site
$req = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
$req->execute($_COOKIE['email'],$_COOKIE['password']);

// fetch Récupère la ligne suivante d'un jeu de résultats PDO 
while($req = $req->fetch()){
    // si le mot de passe donné dans le formulaire
    //correspond au mot de passe de l'utilisateur en bdd

    if(password_verify($_POST['password'], $req['mdp'])){
        $_SESSION['connect']= 1;
        $_SESSION['email']= $req['email'];
        // header("Location:success.php");
        echo "Vous êtes connecté";
    
    }
   else{
       echo "oups";
   }

   
}
}



?>