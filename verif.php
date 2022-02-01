
<?php session_start();
//On va vérifier si notre formulaire est soumis
if(isset($_POST["Submit"])){

    //Définir un tableau associatif avec des utilisateurs ayant un email
    //et un mdp définis
$logins = array("test@test.fr"=>"test","bidule@bidule.fr"=>"bidule","truc@truc.fr"=> "truc");
//J'assigne le username et le mdp soumis dans le formulaire à une variable pour les vérifier ensuite
            
$username = isset($_POST['Email'])? $_POST['Email'] : '';
//Si mon champ email est rempli, j'assigne son contenu à la variable $username sinon $username est vide

$password = isset($_POST['Password'])? $_POST['Password'] : '';
//On va vérifier si le username et le password donné dans le formulaire existent dans mon tableau d'utilisateurs fictifs

//Je vérifie d'abord si mon email existe dans le tableau logins et ensuite si le password corespond à l'email

if(isset($logins[$username]) && $logins[$username] == $password){
$_SESSION['User']= $username;
header('location:success.php');
exit;
}else{
//     //Si la vérification a échoué alors on set un message d'erreur
    $message = "<span style='color:red'>Identifiants invalides</span>";
    }
}
?>