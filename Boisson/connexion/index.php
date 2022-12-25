<!DOCTYPE html>
<link rel="icon" href="../data/favicon.ico" sizes="16x16" type="image/png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<body>

    <?php
    session_start();
   
    include("../navigateur/index.php");
       // Connexion à la base de données
    require "../data/config.php";
    ?>

    <?php

    if (!empty($_POST['login']) && !empty($_POST['password'])) {

        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT *  FROM utilisateur WHERE login = ? and password=?');
        $check->execute(array($login, $password));
        $data = $check->fetch();
        $row = $check->rowCount();


        if ($row > 0) // alors il a réussi à se connecter 
        {
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
        } else {
            echo "ressayer";
        }
    }

    ?>


    <div class="container">
        <h2>Connexion</h2>
        <form action="#" method="post">
            <input type="text" class="form-control" name="login" placeholder="login" required /><br />
            <input type="password" class="form-control" name="password" placeholder="password" required /><br />
            <input type="submit" class="btnsubmit" value="Se connecter" />
        </form>

    </div>

</body>

</html>

<style>
.form-control{
    max-width : 400px;
}
.container{
    margin-top:150px;
    margin-left: auto;
  margin-right: auto;
  max-width : 500px;
}
</style>