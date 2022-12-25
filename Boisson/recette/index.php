<!DOCTYPE html>
<link rel="icon" href="../data/favicon.ico" sizes="16x16" type="image/png">

<body>
    <?php

    session_start();

    include("../navigateur/index.php");
    // Connexion à la base de données
    require "../data/config.php";
    include '../data/nom_image.php';

   
    ?>


    <?php
    $Recettes = array();
    include '../Projet/Donnees.inc.php';

    /// AJOUTER UNE RECETTE DANS LES FAVORIS 
    if (!empty($_POST['titreRecette'])) {
        if (!isset($_SESSION['favori']))
        $_SESSION['favori'] = array();

        $doublon = false;
        foreach($_SESSION['favori'] as $item){
            if($item== htmlspecialchars($_POST['titreRecette']) )
                $doublon=true;
        }
        if($doublon == false){

            array_push($_SESSION['favori'] , htmlspecialchars($_POST['titreRecette']) );
            header('Location: ../favori/index.php');
            exit();
        } 
        if($doublon){

            header('Location: ../favori/index.php');
            exit();
        } 

        $reponse = $bdd->prepare('SELECT *  FROM favori WHERE login =? and recette =? ');
        $reponse->execute(array($_SESSION['user']['login'], $_POST['titreRecette']));
        if ($reponse->rowCount() < 1) { //pour eviter qu'il enregistre 2 fois la meme recette 

            $req = $bdd->prepare('INSERT INTO favori (login, recette  ) VALUES(?,?)');
            $req->execute(array($_SESSION['user']['login'], $_POST['titreRecette']));
        }
        header('Location: ../favori/index.php');
        exit();
    }


    for ($i = 0; $i < sizeof($Recettes) ; $i++) {
        if ($_GET['titre'] === $Recettes[$i]['titre']) {

            echo "<h1>" . $Recettes[$i]['titre'] . '</h1><br><br>';
    ?>

            <form class="formAddFav" method="post" action='#'>
                <input type='hidden' name="titreRecette" value="<?php echo  $Recettes[$i]['titre']; ?>">
                <input type="submit" class="btn btn-primary" value="ajouter dans les favoris" id="btnaddfav">
            </form>



          
            <?php
       
       $url = '../Projet/Photos/' . name_image($Recettes[$i]['titre']) . ".jpg";
       if (is_file($url)) { ?>

               <img src='<?php echo $url; ?>' style="width:auto; height:100%; max-height:500px; display: block;
    margin-left: auto;
    margin-right: auto ; "><br>
       <?php } else { ?>
               <img src='../Projet/Photos/image.png' style="width:400px; height:400px; display: block;
    margin-left: auto;
    margin-right: auto ;"><br>
               
       <?php  }
       ?>





    <?php
            echo "<h3>Ingrédients : </h3>";
            $ingredient = $Recettes[$i]['ingredients'];
            $ing = preg_split("/[|]+/", $ingredient);
            echo '<ul class="list-group">';
            foreach ($ing as $item) {
                echo "<li class='list-group-item'>" . $item . "</li>";
            }
            echo '</ul>';
            echo "<h3>Préparation </h3>";
            echo "<p class='text-center'>" . $Recettes[$i]['preparation'] . '</p>';

            $tabitem = $Recettes[$i]['index'];
            
            echo "<h3> Liste des ingrédients : </h3>";
            echo '<ul class="list-group">';
            foreach ($tabitem as $item) {
                echo "<li class='list-group-item'>"  . $item . "</li>";
            }
            echo '</ul>';
        }
    }

    ?>

    <style>
        h1, h3 {
            font-size: 30px;
            text-align: center;
            margin-top: 50px;
        }

        .ensembleRecette {
            padding: 50px;
            max-width: 1000px;
            margin-top: 60px;
            margin-left: auto;
            margin-right: auto;
        }

        .text-center {
            padding: 20px;
        }

        .list-group {
            margin-top: 60px;
            margin-bottom: 40px;

            margin-left: auto;
            margin-right: auto;
            max-width: 600px;
        }

        .formAddFav {
            display: block;
            text-align: center;
        }
    </style>