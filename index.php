<?php 
// start session + connect to database

include('conn.php');


?>
<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Home page - Daily to-do list</title>
        <link rel = "icon" href="images/logo_todo_list.png" type="image/x-icon">



        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link id="style1" rel="stylesheet" href="css/style2.css">
        

       
    </head>
    

    <body>

        <?php 
            if(!isset($_SESSION['user_name'])){
                include("navbar_guest.php");
            }else{
            include("navbar_connected.php");
            }
            
        ?>       
        

        <center class="m-5">
            <div>
                <label class="m-4">
                    <h1>Welcome to your <i>Daily to-do list!</i></h1>
                </label>

                <p>
                    Sign up right now !
                </p>

                <?php
                /*
                $requete="SELECT * FROM user";
                $user_list = $bdd->query($requete);
                $user=$user_list->fetch();

                while( $user!=='' && $user!==FALSE && $user!==NULL ){ 

                    echo "user_name: ".$user['user_name'];
                    echo "<br>";

                    echo "user_email: ".$user['user_email'];
                    echo "<br>";

                    echo "user_password: ".$user['user_password'];
                    echo "<br>";
                    echo "<br>";

                    $user=$user_list->fetch();
            }*/

                ?>
    
            </div>
        </center>


       

    


        
</body>
    </html>