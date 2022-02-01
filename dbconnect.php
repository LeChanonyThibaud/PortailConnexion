<?php
function connect(){
  //déclaration des constantes pour l'utilisateur et son mot de passe
  define("DBUSER","root");
  define("DBPASS","");
  //connexion à la base de données ( à travers l'instanciation de la classe PDO)
  $pdo = new PDO("mysql:host=localhost;dbname=cdiscount;charset=utf8", DBUSER,DBPASS);
  return $pdo;
}

?>