<?php session_start();
//Démarre une nouvelle session ou reprend une session existante

if(!isset($_SESSION['User'])){

    //$_SESSION est une superglobale, c'est une variable interne à PHP
    //toujours disponible quelquesoit le contexte, globale ou locale
    //$_SESSION prend comme toutes les super globales la forme d'un tableau associatif

    exit;
}



      
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Netflix sans BDD</title>
</head>
<body>

    

<!--include inclut et éxecute le fichier spécifié en argument-->
        <section>
            <div id="login-body">
                <?php if(isset($_SESSION['connect'])){?>
                    <h1>Bonjour</h1>
                 
                <!--Si je suis connecté, il m'affiche le contenu de ma session-->
                Vous êtes connecté "<?= $_SESSION['User']?>"<a href="logout.php"><strong style = 'color:red'>Déconnexion</strong></a>
                <?php }else{ ?>
                    <h1>s'identifier</h1>
            <?php } ?>
            </div>
        </section>

</body>
</html>