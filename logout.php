
<?php 
session_start();//initialise la session
//supprime les cookies
setcookie('email','',time()-3600);
setcookie('password','',time()-3600);
$_SESSION = array();
session_unset();//desactive la session

header("Location: portail.php")
?>