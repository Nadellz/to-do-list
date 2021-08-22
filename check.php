<?php
include("conn.php");

echo $_GET['checked']; echo "<br>";

$id=$_GET['id'];
$id=intval($id,10);

echo "id: ".$id; echo "<br>";


if($_GET['checked']==1){

    //l'element est checked, on met a 1
   

    if(!mysqli_query($db,"UPDATE line SET checked='1' WHERE id='".$id."'")){
        echo mysqli_error($db);
    }

}elseif($_GET['checked']==0){

    //l'element est déchecked, on met a 0

    if(!mysqli_query($db,"UPDATE line SET checked='0' WHERE id='".$id."'")){
        echo mysqli_error($db);
    }


}

header("Location: edit.php");



?>