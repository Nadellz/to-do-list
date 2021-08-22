<?php

include('conn.php');



if(isset($_POST['email_new']) && isset($_POST['username_new']) && isset($_POST['password_new'])){
    //stocker les informations dans des variables.
    $email_new=htmlspecialchars($_POST['email_new']);
    $username_new=htmlspecialchars($_POST['username_new']);
    $password_new=htmlspecialchars($_POST['password_new']);

    $_SESSION['formulaire_inscription']=array($email_new,$username_new,$password_new);

    //traiter les apostrophes.
    $email_new=str_replace("'","\'", $email_new);
    $username_new=str_replace("'","\'", $username_new);
    $password_new=str_replace("'","\'", $password_new);

    
    


    echo "email_new : ".$email_new; 
    echo"<br>";
    echo "username_new : ".$username_new;
    echo"<br>";
    echo "password_new : ".$password_new;
    echo"<br>";

    //variable de verification :
        $validate=true;
        $validate_username=true;
        $validate_email=true;
        $validate_password=true;
        $validate_count=true;


    //verification de l'email :
        if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$email_new)){
            $validate_email=false;
        }
    //verification du username :
        if(strlen($username_new)<5){
            $validate_username=false;
        }
    //verification du mot de passe :
        if(strlen($password_new)<4){
            $validate_password=false;
        }

    //verifier si l'email et le username sont uniques : voir base de données

    $request="SELECT count(*) user WHERE EXISTS (SELECT user_name from user where user_name='".$username_new."')";
    $execution = mysqli_query($db,$request);
    $count_username = mysqli_fetch_array($execution);

    echo "count of username : ".$count_username[0];
    echo"<br>";
        
    $request="SELECT count(*) user WHERE EXISTS (SELECT user_email from user where user_email='".$email_new."')";
    $execution = mysqli_query($db,$request);
    $count_email = mysqli_fetch_array($execution);

    echo "count of email : ".$count_email[0];
    echo"<br>";


        if(!($count_email[0]==0 && $count_username[0]==0)){
            $validate_count=false;
        }


        $validate=$validate_email&&$validate_username&&$validate_password&&$validate_count;


        echo "validate email: ".$validate_email;
        echo"<br>";
        echo "validate username: ".$validate_username;
        echo"<br>";
        echo "validate password: ".$validate_password;
        echo"<br>";
        echo "validate count: ".$validate_count;
        echo"<br>";
        echo "validate : ".$validate;
        echo"<br>";


    if($validate==true){

        echo "inscription";
        echo"<br>";

        //inscription
        $request = "INSERT INTO user (user_name, user_email, user_password)
        VALUES ('".$username_new."','".$email_new."','".$password_new."')";
        $execution = mysqli_query($db,$request);
        

        //nouvelle session :
        session_start();
        $_SESSION['user_name'] = $username_new;
        $_SESSION['inscription']=1;

        //redirection.
        header('Location: edit.php');

        
    }else{
        //message d'erreur
        echo "pas d'inscription";
        echo"<br>";

        if(!($count_username[0]==0)){
            //cas username_new existe déja dans la bdd
            $_SESSION['inscription_username']=(-1);
            

        }
        if(!($count_email[0]==0)){
            //cas email_new existe déja dans la bdd
            $_SESSION['inscription_email']=(-2);

        }
        if(!$validate_email){
            //cas email_new invalide
            $_SESSION['inscription_email']=(-3);

        }
        if(!$validate_username){
            //cas username_new invalide
            $_SESSION['inscription_username']=(-4);

        }
        if(!$validate_password){
            //cas password_new invalide
            $_SESSION['inscription_password']=(-5);

        }

        
        $_SESSION['inscription']=(-1);
        
        
        

        //redirection
        header('Location: sign_up.php');
        

    }



}else{
    //redirection a la  page d'accueil.
    header('Location: index.php');
}




?>