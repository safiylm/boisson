<!DOCTYPE html>
<link rel="icon" href="../data/favicon.ico" sizes="16x16" type="image/png">

<?php
session_start();
include("../navigateur/index.php");
// Connexion à la base de données
require "../data/config.php";
include '../Projet/Donnees.inc.php';



if(empty($_GET['nom'])){
    $ing= 'Aliment'; 
   
}else{
    $ing= $_GET['nom'];
   /* $tab = explode(';', $url);
    $tab[0]="Aliment";
    $nb =sizeof($tab);
    $ing=$tab[$nb-1]; */
;}
?>

<div class="main">

<h3>Hiérarchique</h3>
<?php echo "<a href='#'>".$ing."</a>"; ?>

<h3>Liste des recettes </h3>

<?php /*
for($i=0; $i<300; $i++){
    foreach($Recettes[$i][$ingredients]as $item){
        if($item == $ing){
            echo $Recettes[$i]['titre'];
        }
    }
}*/?>


</br></br></br>
<h3>Liste des sous-ingrédients </h3>
<?php 
foreach($Hierarchie[$ing]['sous-categorie'] as $item){
   
   echo "<a href='index.php?nom=".$item."'>".$item."</a><br>";
}?>
</br></br></br>

<h3>Liste des sur-ingrédients</h3>
<?php

foreach($Hierarchie[$ing]['super-categorie'] as $item){
    
     echo "<a href='index.php?nom=".$item."'>".$item."</a><br>";
}
?>
</div>

<?php




?>

<style>
    .main{
        text-align:center;
        border: 2px solid black;
        max-width: 600px;
        padding: 50px;
        margin-top: 60px;
        margin-left: auto;
        margin-right: auto;
    }
    h3{
        margin:40px;
    }
    </style>