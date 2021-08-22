<?php 
// start session + connect to database

include('conn.php');


/*$requete="SELECT * FROM user WHERE user_id=1";
$exec_requete = mysqli_query($db,$requete);
$reponse      = mysqli_fetch_array($exec_requete);

echo $reponse['user_name'];*/

if(!isset($_SESSION['user_name'])){

?>
<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Authentification - Daily to-do list</title>
        <link rel = "icon" href="images/logo_todo_list.png" type="image/x-icon">



        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link id="style1" rel="stylesheet" href="css/style2.css">
        

       
    </head>
    

    <body>

        

                



        <!--Gestion d'erreurs-->
                <?php 
                
                include('navbar_guest.php');
                
                if(isset($_SESSION['connexion_failed']) && $_SESSION['connexion_failed']==1){
                    ?>

                    <div class="container-fluid d-flex justify-content-start">

                            <div class="container-fluid alert alert-danger inline mt-1" role="alert">
                                check your username and password and connect again.
                            </div>
                        
                    </div>

                    <?php
                    $_SESSION['connexion_failed']=0;
                } ?>

        

        <center class="my-4">
            <div>
                <label class="m-4">
                    <h1>Welcome to your <i>Daily to-do list!</i></h1>
                </label>
    
            </div>
            <div class="container" style="width:350px;">
                <Form action="sign_inSql.php" method="post">
                    <div class="form-group">
                        <label>Username : </label>
                        <input  name="my_username" type="Username" class="form-control" placeholder="Username" autofocus>
                    </div>

                    <div class="form-group ">
                        <label>Password : </label>
                        <input  name="my_password" type="password" class="form-control" placeholder="Password" >
                    </div>

                    <button type="submit" name="connexion" class="btn btn-primary">Connect</button>
                </Form>
            
            </div>
        </center>



        
</body>
    </html>

<?php

            }else{
                //redirection :
                header('Location: index.php');
            }

?>