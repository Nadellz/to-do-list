<?php

include('conn.php');

if(!isset($_SESSION['user_name'])){

?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Sign up - Daily to-do list</title>
        <link rel = "icon" href="images/logo_todo_list.png" type="image/x-icon">



        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link id="style1" rel="stylesheet" href="css/style2.css">
        


       
    </head>





    <body>


        <?php
            include("navbar_guest.php");
        ?>

        <main class="container d-flex justify-content-center">

                    
                        <form method="post" action="sign_upSql.php" id="sign_up_form" class="container-sm p-5" >

                        
                                <label class="">
                                    <h3>Welcome to your <i>Daily to-do list!</i></h3>
                                </label>

                        
                                <div>
                                    
                                    <div class="input-group mb-2">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><img style="width: 16px; height: 16px;" src="images/open-iconic-master/svg/person.svg" alt="icon user" class="align-self-center"></div>
                                        </div>

                                        <input type="text" name="username_new" class="form-control" value="<?php if(isset($_SESSION['formulaire_inscription'][1])){echo "".htmlspecialchars($_SESSION['formulaire_inscription'][1]);} ?>"placeholder="Username">
                                    
                                    </div>

                                    <?php 
                                    if(isset($_SESSION['inscription_username']) && $_SESSION['inscription_username']==(-1)){
                                    ?>

                                        <div class="d-flex justify-content-start text-danger">
                                            <div class="message_alerte" style="overflow:auto;">
                                            This username is already taken.
                                            </div>
                                        </div>
                                    <?php
                                        $_SESSION['inscription_username']=0;
                                    }elseif(isset($_SESSION['inscription_username']) && $_SESSION['inscription_username']==(-4)){
                                    ?>

                                        <div class="d-flex justify-content-start text-danger">
                                            <div class="message_alerte" style="overflow:auto;">
                                            The username should contain at least 5 characters.
                                            </div>
                                        </div>
                                    <?php
                                        $_SESSION['inscription_username']=0;
                                    }
                                    ?>


                                    
                                    
                                    

                                </div>

                                <br>
                                <div>                                    

                                    <div class="input-group mb-2">
                                        
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><img style="width: 16px; height: 16px;" src="images/open-iconic-master/svg/inbox.svg" alt="icon email" class="align-self-center"></div>
                                        </div>

                                        <input type="email" name="email_new" class="form-control" value="<?php if(isset($_SESSION['formulaire_inscription'][0])){echo "".htmlspecialchars($_SESSION['formulaire_inscription'][0]);} ?>" placeholder="E-mail">
                                    
                                        
                                    </div>






                                    <?php 
                                    if(isset($_SESSION['inscription_email']) && $_SESSION['inscription_email']==(-2)){
                                    ?>

                                        <div class="d-flex justify-content-start text-danger">
                                            <div class="message_alerte" style="overflow:auto;">
                                            This email is already taken.
                                            </div>
                                        </div>
                                    <?php
                                        $_SESSION['inscription_email']=0;
                                    }elseif(isset($_SESSION['inscription_email']) && $_SESSION['inscription_email']==(-3)){
                                    ?>

                                        <div class="d-flex justify-content-start text-danger">
                                            <div class="message_alerte" style="overflow:auto;">
                                            This email is invalid.
                                            </div>
                                        </div>
                                    <?php
                                        $_SESSION['inscription_email']=0;
                                    }
                                    ?>
                                    


                                </div>
                                
                                <br>
                                <div>
                                    
                                    <div class="input-group mb-2">
                                        
                                        <div class="input-group-prepend">
                                            <div class="input-group-text password_icon"><img style="width: 16px; height: 16px;" src="images/open-iconic-master/svg/eye.svg" alt="icon password" class="align-self-center">
                                            </div>

                                        </div>

                                        <input id="password" type="password" name="password_new" class="form-control" placeholder="Password">
                                    
                                    </div>



                                    <?php 
                                    if(isset($_SESSION['inscription_password']) && $_SESSION['inscription_password']==(-5)){
                                    ?>

                                        <div class="d-flex justify-content-start text-danger">
                                            <div class="message_alerte" style="overflow:auto;">
                                            The password must contain at least 4 characters.
                                            </div>
                                        </div>
                                    <?php
                                        $_SESSION['inscription_password']=0;
                                    }
                                    ?>

                                    

                                </div>

                                <br>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary" type="submit">Sign up</button>
                                </div>
                            
                        </form>
                    
                    
            </main>

           



        <?php 
        if(isset($_SESSION['formulaire_inscription']))
        {
            unset($_SESSION['formulaire_inscription']);
        }

        ?>


        <script type="text/javascript">
            document.querySelector('.password_icon').addEventListener('click',function(){
                var password = document.querySelector('#password');

                if(password.type=="password"){
                    password.type="text";
                    //console.log(password.type);
                }else{
                    password.type="password";
                    //console.log(password.type);
                }

            });
        </script>

        
    </body>
    </html>


    <?php

}else{
    //redirection a la  page d'accueil.
    header('Location: index.php');
}

    ?>