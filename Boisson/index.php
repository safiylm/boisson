<!DOCTYPE html>
<link rel="icon" href="data/favicon.ico" sizes="16x16" type="image/png">
<!-- CSS only -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<?php
session_start();
// Connexion à la base de données
require "data/config.php";
include 'data/nom_image.php';
$Recettes = array();
include 'Projet/Donnees.inc.php';

if(!isset($_SESSION['favori']))
$_SESSION['favori']= array();

?>


<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">

        <a href="index.php" class="navbar-brand"> Boisson</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                <?php if (!empty($_SESSION['user']['login'])) { ?>
                    <li class="nav-item">
                        <a href="compte/index.php" class="nav-link active" aria-current="page"><?php echo $_SESSION['user']['login']; ?> </a>
                    </li>

                <?php }  ?>

                <li class="nav-item">
                    <a href="favori/" class="nav-link " aria-current="page">Mes recettes préférées </a>
                </li>
                <li class="nav-item">
                    <a href="hierarchie ingredients/" class="nav-link " aria-current="page">Hierarchie des Recettes </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Compte
                    </a>
                    <ul class="dropdown-menu">
                    <?php if (empty($_SESSION['user']['login'])) { ?>
                        <li><a class="dropdown-item" href="connexion/">Connexion</a></li>
                        <li><a class="dropdown-item" href="inscription/">Inscription</a></li>
                    <?php }else{  ?>
                        <li><a class="dropdown-item" href="deconnexion/"> Deconnexion</a></li>
                    <?php } ?>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" action="recherche/" method="post">
                <input name="inputSearch" list='proposals' class="form-control me-2" type="search" onkeyup="showHint(this.value)" placeholder="Search" aria-label="Search" style="max-width: 100%;">
                <datalist id="proposals"></datalist>

                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

        </div>

    </div>
</nav>

<img src='Projet/Photos/Boisson.png' class="img-fluid">

<h1> Découvrez toutes nos boissons </h1>


<div class="container px-4 text-center">
    <div class="row gx-5">
        <?php
        for ($i = 0; $i < sizeof($Recettes); $i++) {
            $url = 'Projet/Photos/' . name_image($Recettes[$i]['titre']) . ".jpg";
            echo '<div class="col">';
            if (is_file($url)) { ?>

                <a class='atitre' href="recette/index.php?titre=<?php echo $Recettes[$i]['titre']; ?>">
                    <img src='<?php echo $url; ?>' style="width:250px; height:250px;"><br>
                   <p> <?php echo $Recettes[$i]['titre']; ?></p></a><br>
            <?php } else { ?>
                <a class='atitre' href="recette/index.php?titre=<?php echo $Recettes[$i]['titre']; ?>">
                    <img src='Projet/Photos/image.png' style="width:250px; height:250px;"><br>
                   <p> <?php echo $Recettes[$i]['titre']; ?></p></a><br>
            <?php  }
            ?>



    </div>

<?php }
?>
</div>
</div>


<!-- 
<div class="ensembleRecette">

<?php
$reponse = $bdd->query('SELECT *  FROM utilisateur ');

while ($donnees = $reponse->fetch()) {
    echo  htmlspecialchars($donnees['login']) . '<br> ';
    echo  htmlspecialchars($donnees['nom']) . '<br> ';
}

$reponse->closeCursor();
?>

</div> fin ensembleRecette -->

<script >
    
function showHint(str) {
    if (str.length == 0) {
      document.getElementById("proposals").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("proposals").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "recherche/proposals.php?q=" + str, true);
      xmlhttp.send();
    }
  }

</script> 

<style>
    h1 {
        font-size: 40px;
        text-align: center;
        margin: 50px;

    }

    .img-fluid {
        width: 100%;
    }

    .atitre img {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .atitre {
        font-size: 20px;
        font-family: 'Work Sans', sans-serif;
        text-decoration: none;
        padding: 25px;
        text-transform: uppercase;
        color: #858585;
        font-weight: lighter;
        -webkit-transition: .5s;
        transition: .5s;
    }
</style>