<?php

// start session + connect to database
include('conn.php');

if(isset($_SESSION['user_name'])){


?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit - Daily to-do list</title>
        <link rel = "icon" href="images/logo_todo_list.png" type="image/x-icon">
        

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">        
        <link id="style1" rel="stylesheet" href="css/style2.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <?php
            include("navbar_connected.php");
        ?>


    </head>
    <body>


    
    <div class="d-flex justify-content-end">
        <button type="button" class="m-3 btn btn-primary inline" data-toggle="modal" data-target="#modal_formulaire_to_do">
            Add to-do
        </button>
    </div>

    <?php 
    
    
    if(isset($_SESSION['add_to_do']) && $_SESSION['add_to_do']==(1)){

        ?>
            <div class="container alert alert-success" role="alert">
                Your to-do has been added, Make it happen now.
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>

        <?php

        $_SESSION['add_to_do']=0;

    }elseif(isset($_SESSION['add_to_do']) && $_SESSION['add_to_do']==(-1)){
        ?>
        <div class="container alert alert-danger" role="alert">
            Something happened, please check your internet connection.
            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
        <?php
        $_SESSION['add_to_do']=0;
    }
    ?>

    
    
       

<!-- Modal add project-->
<div class="modal fade" id="modal_formulaire_to_do" tabindex="-1" aria-labelledby="modal_formulaire_to_do" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_formulaire_to_do">New to-do (project)</h5>
        <button type="button" class="close" id="close_button_x" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <form method="POST" action="editSql.php" id="add_form" class="p-3" enctype="multipart/form-data">

                    <label>Title :</label>
                    <div class="form-group">
                        <input class="form-control" type="text" name="titre_to_do_new" placeholder="to-do title" required>
                    </div>

                    <!--<label>Description :</label>
                    <div class="form-group">
                        <textarea class="form-control" type="text" name="description_to_do_new" placeholder="description" required></textarea>
                    </div>-->

                    <label>Order of priority :</label>
                    <div class="form-group">
                        <input class="form-control" type="number" name="ordre_to_do_new" placeholder="order" required>
                    </div>

                    
                    <!--<label>Add an attachement (optional) :</label>-->
                    <div class="custom-file mb-3" style="display:none;">
                        <input type="file" class="custom-file-input" id="customFile" name="image_to_do_new">
                        <label class="custom-file-label" id="file_label" for="customFile">Choose file</label>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" name="add_to_do" class="btn btn-primary">Add</button>
                    </div>
            </form>

      </div>
      <div class="modal-footer">
        <button id="close_button" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
        

        
        <?php 

        //afficher tous les tables to-do list




        $requete="SELECT * FROM to_do_table where user_name='".$_SESSION['user_name']."' ";
       
        $to_do_table_list = $bdd->query($requete);
        $to_do_table=$to_do_table_list->fetchAll();


        if($to_do_table=='' || $to_do_table==FALSE || $to_do_table==NULL){
            ?>
            <div class="alert alert-warning container-sm" role="alert">
                You don't have any to-do's, Click "Add to-do" on the top right to add a to-do to your list.
            </div>
            <?php
        }


        echo '<main class="container mb-5 mt-3">';
        echo '<div class="row d-flex justify-content-center">';

        $ordre = array_column($to_do_table, 'ordre');
        array_multisort($ordre, SORT_DESC, $to_do_table);
        
        $count=1;
            for($i=0;$i<sizeof($to_do_table);++$i){ 
                ?>

                <div class="col col-lg-auto">
                    <div class="card mb-3" data-toggle="tooltip" data-placement="top" title="<?php echo "ordre of priority: ".$to_do_table[$i]['ordre'];?>" >
                        <div class="card-header"> <span class="barring"><?php echo "to do n°".$count.""; ?></span>

                            
                            <button  class="btn" data-toggle="modal" data-target="#modal_formulaire_to_do_line<?php echo $count; ?>" style="margin-left:5%; padding:0;" ><img title="add line" src="https://img.icons8.com/ios-glyphs/30/4a90e2/add--v1.png"/></i></button>                                                    
                            
                            <!--Modal add to_do line-->
                                <div class="modal fade" id="modal_formulaire_to_do_line<?php echo $count; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add line</h5>
                                            <button type="button" id="close_button_x2" class="close " data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="editSql.php?id=<?php echo $to_do_table[$i]['to_do_id']; ?>" method="POST" class="p-1 form_add_line">

                                                <label>Content :</label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="line_new" placeholder="write here" required>
                                                </div>

                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" name="add_to_do_line" class="btn btn-primary">Add line</button>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="modal-footer p-1">
                                            <button type="button" id="close_button2" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                        <!--end : modal to_do line -->





                            <form action="editSql.php?id=<?php echo $to_do_table[$i]['to_do_id']; ?>" method="POST" style="display:inline; margin:0; padding:0;">
                                <button type="submit"  name="supprimer_to_do_line" class="btn" style="margin:0; padding:0;"><img style=" height:26px; width:26px;" title="delete selected lines" src="images/delete_selected.png"/></i></button>
                                <button type="submit"  name="supprimer_to_do" class="btn" style="margin:0; padding:0;"><img title="delete project" src="images/delete.png"/></i></button>
                            
                                
                            
                            </form>

                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $to_do_table[$i]['title']; ?></h5>
                            <div class="card-text">
                                <p><?php //echo $to_do_table[$i]['description']; ?></p>
                                <?php 
                                $requete = "SELECT * FROM line where to_do_id='".$to_do_table[$i]['to_do_id']."'";
                                $lines = $bdd->query($requete);
                                $lines=$lines->fetchAll();
                                

                                for($j=0;$j<sizeof($lines);++$j){

                                    if($lines[$j]['content']!==NULL){
                                        echo "<span>";
                                        if($lines[$j]['checked']==1){
                                            
                                            echo '<input class="to_do" type="checkbox" onclick="checkIt(this,'.$lines[$j]['id'].')" checked>';
                                            
                                        }else{

                                            echo '<input class="to_do" type="checkbox" onclick="checkIt(this,'.$lines[$j]['id'].')">';
                                        
                                        }
                                        echo '<label class="to_do_content" style="display:inline;" value="test"> '.$lines[$j]['content'].'</label>';
                                        echo "</span>";
                                        echo "<br>";
                                    }

                                }
                                    
                                ?>

                                    

                                
                                   
                                
                                
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            
                $count++;
                
            }

            
            

            echo "</div>";
            echo "</main>";
    
        
        
        ?>

       <script type="text/javascript">

               

                /* DEBUT : AFFICHER LE NOM DU FICHIER UPLOADED */ 

            var image = document.querySelector('#customFile');
                image.addEventListener('change', function(){
                    var valeur = image.value;
                    ////console.log(valeur);
                    //console.log(valeur.split("\\").pop());
                    valeur_new = valeur.split("\\").pop();
                    document.querySelector('#file_label').innerText=valeur_new;
                    
                });

                /* FIN : AFFICHER LE NOM DU FICHIER UPLOADED */


                /* DEBUT : VIDER LE FORMULAIRE APRES LE CLOSE */


                /*DEBUT Close :*/
                    var close = document.querySelector('#close_button');
                    
                        close.addEventListener('click',function(){
                            
                            var inputs = document.querySelectorAll('#add_form input');
                                
                                for(var i=0; i<inputs.length;i++){
                                    inputs[i].value="";
                                }
                            
                            document.querySelector('#add_form textarea').value="";
                            document.querySelector('#file_label').innerText="Choose file";

                        });



                var close2 = document.querySelector('#close_button2');
                    close2.addEventListener('click',function(){
                        
                        var input = document.querySelector('.form_add_line input');
                                input.value="";

                    });

                    /*FIN Close :*/

                    /*DEBUT : Close x*/
                var close_x = document.querySelector('#close_button_x');
                    close_x.addEventListener('click',function(){
                        
                        var inputs = document.querySelectorAll('#add_form input');
                            
                            for(var i=0; i<inputs.length;i++){
                                inputs[i].value="";
                            }
                        
                        document.querySelector('#add_form textarea').value="";
                        document.querySelector('#file_label').innerText="Choose file";

                    });

                    var close_x2 = document.querySelector('#close_button_x2');
                    close_x2.addEventListener('click',function(){
                        
                        var input = document.querySelector('.form_add_line input');
                                input.value="";
                            

                    });

                    /*FIN : Close x*/

                
                
                /* FIN : VIDER LE FORMULAIRE APRES LE CLOSE */
            
       </script>
                                    <script type="text/javascript">

                                        function checkIt(element,id){

                                                //console.log(element);
                                                //console.log("checked with id: "+id);
                                                if(element.checked==true){
                                                    //console.log("checked: true.");
                                                    
                                                    
                                                    
                                                    window.location.replace("check.php?checked=1&id="+id); 
                                                    //window.setTimeout('alert("Message goes here");window.close();', 5000);
                                                    
                                                }else{
                                                    //console.log("checked: false.");
                                                    window.location.replace("check.php?checked=0&id="+id); 
                                                    //window.setTimeout('alert("Message goes here");window.close();', 5000);
                                                }
                                        }    

                                        var checks = document.querySelectorAll('.to_do');

                                        for(var i=0;i<checks.length;i++){
                                        var check = checks[i];
                                        if(check.checked==true){

                                            var label = check.nextElementSibling;
                                            var labelText = label.innerText;

                                            label.textContent='';
                                            var s = document.createElement('s');
                                            label.appendChild(s);
                                            s.textContent=labelText;

                                        }

                                        }

                                    </script>





    
                        

                                    






        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
             

        
        
    </body>
    </html>

<?php



        }else{
            //redirection a la  page d'accueil.
            header('Location: index.php');
        }
?>