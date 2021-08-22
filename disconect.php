<?php

include('conn.php');

session_unset();
session_destroy();

//redirection a la  page d'accueil.
header('Location: index.php');


?>