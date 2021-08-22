<?php

// start session + connect to database

if (!isset($_SESSION)) {session_start();}


//database : 

// connexion à la base de données
$db_username = 'CIjqreHWD4';
$db_password = 'hgy4v16SjY';
$db_name     = 'CIjqreHWD4';
$db_host     = 'remotemysql.com';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
       or die('could not connect to database');


       try
       {
         $bdd = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', $db_username, $db_password);
       }
       catch(Exception $e)
       {
               die('could not connect to database');
       }




?>