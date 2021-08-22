<?php


include('conn.php');

// stocker les données :

$username = htmlspecialchars($_POST['my_username']);
$password = htmlspecialchars($_POST['my_password']);

echo "username : ".$username;
echo "<br>";
echo "password : ".$password;

//voir si l'utilisateur existe déja dans la base de données.

//requete  sql :

$requete="SELECT * from user where user_name='".$username."' AND user_password='".$password."'";
$exec_requete = mysqli_query($db,$requete);
$reponse      = mysqli_fetch_array($exec_requete);




if($reponse!==NULL && $reponse!==FALSE){
    //redirection 
    echo"trouvé";
    $_SESSION['user_name']=$reponse['user_name'];
    header('Location: edit.php');

}else{

    //redirection + message d'erreur 
    echo"pas trouvé";
    $_SESSION['connexion_failed']=1;
    header('Location: sign_in.php');

}







?>