<?php
//Initialisation de la session
session_start();

//RĂ©initialisation des variables de la session
$_SESSION = array();

// Destruction de la session
session_destroy();

//Direction vers la page d'accueil
header("location: ../index.php");
exit;
?>