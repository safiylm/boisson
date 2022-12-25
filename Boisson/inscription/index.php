<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="icon" href="../data/favicon.ico" sizes="16x16" type="image/png">
<body>
    <?php
    session_start();
    include("../navigateur/index.php");
    // Connexion à la base de données
    require "../data/config.php";
    ?>

    <?php

    $sexe = "";

    if (!empty($_POST['femme'])) {
        $sexe = "femme";
    }
    if (!empty($_POST['homme'])) {
        $sexe = "homme";
    }

    if (!empty($_POST['login'])) {
        $datenaissance = date('Y-m-d', strtotime($_POST['datenaissance']));
        // Insertion du message à l'aide d'une requête préparée
        $req = $bdd->prepare('INSERT INTO utilisateur (login, password, nom, prenom, sexe, email, datenaissance,  adresse, telephone ) VALUES(?,?,?,?,?,?,?,?,?)');
        $req->execute(array(
            $_POST['login'], $_POST['password'],  $_POST['nom'], $_POST['prenom'],
            $sexe, $_POST['email'], $datenaissance,  $_POST['adresse'],  $_POST['telephone']
        ));
        $_SESSION['favori'] = array();
        $_SESSION['user']['login'] = $_POST['login'];
        $_SESSION['user']['password'] = $_POST['password'];
        $_SESSION['user']['nom'] = $data['nom'];
        $_SESSION['user']['prenom'] = $data['prenom'];
        $_SESSION['user']['sexe'] = $data['sexe'];
        $_SESSION['user']['email'] = $data['email'];
        $_SESSION['user']['datenaissance'] = $data['datenaissance'];
        $_SESSION['user']['adresse'] = $data['adresse'];
        $_SESSION['user']['telephone'] = $data['telephone'];
        
        //go to user data page 
        header('Location: ../index.php');
        exit();
    }

    ?>


    <div class="container">
        <h2>Inscription</h2>
        <form action="#" method="post">

            <input type="text" class="form-control" name="nom" placeholder="nom" /><br />

            <input type="text" class="form-control" name="prenom" placeholder="prenom" /><br />

            <input type="text" class="form-control" name="login" placeholder="login" required /><br />

            <input type="email" class="form-control" name="email" placeholder="email" /><br />

            <input type="password" class="form-control" name="password" placeholder="password" required /><br />

            <input type="radio" value="femme" name="femme"> Femme </input>
            <input type="radio" value="homme" name="homme"> Homme </input>
            <br /><br />

            <input type="date" class="form-control" name="datenaissance" placeholder="date de naissance" /><br />

            <input type="text" class="form-control" name="adresse" placeholder="adresse, code postal et ville" /><br />

            <input type="tel" class="form-control" name="telephone" placeholder="numéro de téléphone" /><br />


            <input type="submit" class="btnsubmit" value="S'inscrire" />

        </form>

    </div>

</body>

</html>


<style>
    .form-control {
        max-width: 400px;
    }

    .container {
        margin-top: 60px;
        margin-left: auto;
        margin-right: auto;
        max-width: 500px;
    }
</style>