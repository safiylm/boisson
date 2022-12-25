<!DOCTYPE html>
<link rel="icon" href="../data/favicon.ico" sizes="16x16" type="image/png">


<?php
session_start();
include("../navigateur/index.php");
require "../data/config.php";
// Connexion à la base de données
//require "config.php";
include '../data/nom_image.php';
$Recettes = array();
include '../Projet/Donnees.inc.php';

?>



<?php $recette= $_POST["inputSearch"];
for ($i = 0; $i < sizeof($Recettes) ; $i++) {
        if ($recette === $Recettes[$i]['titre']) {
            $url = '../Projet/Photos/' . name_image($Recettes[$i]['titre']) . ".jpg";
            echo '<div class="col">';
            if (is_file($url)) { ?>

                <a class='atitre' href="../recette/index.php?titre=<?php echo $recette; ?>">
                    <img src='<?php echo $url; ?>' ><br>
                 <p>  <?php echo $recette; ?></p></a><br>
            <?php } else { ?>
                <a class='atitre' href="../recette/index.php?titre=<?php echo $recette; ?>">
                    <img src='../Projet/Photos/image.png' ><br>
                   <p> <?php echo $recette; ?></p></a><br>
            <?php  }
            
   
        }
    }
            ?>

<script src="call.js"></script>

<script>
    if(document.getElementById("recherche").value!=="")
    showHint(document.getElementById("recherche").value)
</script>



<style>
    h1 {
        font-size: 40px;
        text-align: center;
        margin: 50px;

    }

    img{
        width : auto;
        height: 400px;
    }
 
    .col{
        max-width : 400px;
    }
    .atitre p {
     
        text-align:center;
        margin: 5px auto;
        font-size: 20px;
        font-family: 'Work Sans', sans-serif;
        text-decoration: none;
        padding: 25px;
        text-transform: uppercase;
        color: #858585;
        font-weight: lighter;
       
    }
</style>