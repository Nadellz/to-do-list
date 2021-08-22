<?php

include('conn.php');

echo "username: ".$_SESSION['user_name']; echo "<br>";
 
if(isset($_POST['add_to_do'])){
    echo "add clicked."; echo "<br>";
}else{
    echo "add not clicked."; echo "<br>";
}



if(isset($_SESSION['user_name']) && isset($_POST['add_to_do']) && isset($_POST['titre_to_do_new']) && isset($_POST['ordre_to_do_new']) ){

//1.stocker les informations
$username=$_SESSION['user_name'];
$titre_to_do_new=htmlspecialchars($_POST['titre_to_do_new']);
//$description_to_do_new=htmlspecialchars($_POST['description_to_do_new']);
$ordre_to_do_new=htmlspecialchars($_POST['ordre_to_do_new']);
//$image_to_do_new=$_FILES['image_to_do_new'];

echo "titre_do_new: ".$titre_to_do_new; echo "<br>";
//echo "description_do_new: ".$description_to_do_new; echo "<br>";
echo "ordre_do_new: ".$ordre_to_do_new; echo "<br>";
//echo "image_do_new: "; print_r($image_to_do_new); echo "<br>";

//2.traiter le cas de l'apostrophe
$username=str_replace("'","\'",$username);
$titre_to_do_new=str_replace("'","\'",$titre_to_do_new);
//$description_to_do_new=str_replace("'","\'",$description_to_do_new);
$ordre_to_do_new=str_replace("'","\'",$ordre_to_do_new);

echo "<br>";
echo "data BEFORE inserted: "; echo "<br>";
    echo "username: ".$username; echo "<br>";
    echo "title: ".$titre_to_do_new; echo "<br>";
    //echo "description: ".$description_to_do_new; echo "<br>";
    echo "ordre: ".$ordre_to_do_new; echo "<br>";
    echo "<br>";

//3.faire les verifications du fichier : pas pour le moment.


//4.introduire les donnees

if(!mysqli_query($db,"INSERT INTO to_do_table SET user_name='".$username."', title='".$titre_to_do_new."', description='none', ordre='".$ordre_to_do_new."'")){
    echo "une erreur est survenu"; echo "<br>";
    $_SESSION['add_to_do']=(-1);
    header('Location: edit.php');
}else{
    /*echo "<br>";
    echo "data inserted: ";
    echo "username: ".$username; echo "<br>";
    echo "title: ".$titre_to_do_new; echo "<br>";
    echo "description: ".$description_to_do_new; echo "<br>";
    echo "ordre: ".$ordre_to_do_new; echo "<br>";
    echo "<br>";*/
    $_SESSION['add_to_do']=(1);
    header('Location: edit.php');
}




}elseif(isset($_SESSION['user_name']) && isset($_POST['supprimer_to_do'])){
    
        echo "supprimer"; echo "<br>";
        echo "id=".$_GET['id'];
        $to_do_id=$_GET['id'];

        mysqli_query($db,"DELETE FROM to_do_table WHERE to_do_id='".$to_do_id."'");
        header("Location: edit.php");

}elseif(isset($_SESSION['user_name']) && isset($_POST['add_to_do_line']) && isset($_POST['line_new'])){


    //1.stocker les informations 
    $content= htmlspecialchars($_POST['line_new']);
    $username=$_SESSION['user_name'];

    //2.traiter le cas de l'apostrophe
    $content=str_replace("'","\'",$content);
    $username=str_replace("'","\'",$username);



    echo "Add line"; echo "<br>";
    echo "to_do_id:".$_GET['id']; echo"<br>";
    echo "user_name: ".$username;  echo"<br>";
    echo "content: ".$content; echo"<br>";
    $to_do_id=$_GET['id']; 


   

    if(!mysqli_query($db,"INSERT INTO line SET user_name='".$username."', to_do_id='".$to_do_id."', content='".$content."', checked='0'")){
        echo mysqli_error($db);
    }
    
    
    header("Location: edit.php");

}elseif(isset($_SESSION['user_name']) && isset($_POST['supprimer_to_do_line'])){

        echo "supprimer line"; echo "<br>";
        echo "id=".$_GET['id'];
        $to_do_id=$_GET['id'];

        mysqli_query($db,"DELETE FROM line WHERE to_do_id='".$to_do_id."' AND checked='1'");
        header("Location: edit.php");


}else{
    //redirection
    header('Location: index.php');
}



?>