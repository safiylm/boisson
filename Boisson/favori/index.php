<!DOCTYPE html>
<link rel="icon" href="../data/favicon.ico" sizes="16x16" type="image/png">
<?php
session_start();
include("../navigateur/index.php");
// Connexion à la base de données
require "../data/config.php";


if (!isset($_SESSION['favori']))
    $_SESSION['favori'] = array();
    
    //  SUPPRIMER UNE RECETTE DANS LES FAVOVIS 
if (!empty($_POST['titreRecette'])) {

    $req = $bdd->prepare('DELETE FROM favori WHERE login =? and recette = ?');
    $req->execute(array($_SESSION['user']['login'], $_POST['titreRecette']));
    
    for( $i=0; $i< sizeof($_SESSION['favori']) ; $i++){
        if($_SESSION['favori'][$i]=== $_POST['titreRecette']){
            array_splice($_SESSION['favori'], $i, 1);
        }
    }
    
    header('Location: index.php');
    exit();
}


?>
<h1> Mes recettes préférés </h1>
<div class="ensembleRecette">

    <?php
    $reponse = $bdd->prepare('SELECT *  FROM favori WHERE login =? ');
    $reponse->execute(array($_SESSION['user']['login']));
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"> </th>
                <th scope="col"> </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($_SESSION['user']['login'])) {
                while ($donnees = $reponse->fetch()) {
            ?>

                    <tr>
                        <th scope="row">
                            <a href="../recette/index.php?titre=<?php echo $donnees['recette']; ?>"><?php echo $donnees['recette']; ?> </a>
                        </th>
                        <td>
                            <form method="post" action='#'>
                                <input type='hidden' name="titreRecette" value="<?php echo $donnees['recette']; ?>">
                                <input type="submit" value="Supprimer des favoris">
                            </form>
                        </td>
                    </tr>
                <?php
                }
            } else { 
                for( $i=0; $i< sizeof($_SESSION['favori']) ; $i++){
                ?>
                <tr>
                    <th scope="row">
                        <a href="../recette/index.php?titre=<?php echo $_SESSION['favori'][$i]; ?>"><?php echo $_SESSION['favori'][$i]; ?> </a>
                    </th>
                    <td>
                        <form method="post" action='#'>
                            <input type='hidden' name="titreRecette" value="<?php echo $_SESSION['favori'][$i]; ?>">
                            <input type="submit" value="Supprimer des favoris">
                        </form>
                    </td>
                </tr>

            <?php } }

            $reponse->closeCursor();
            ?>
        </tbody>
    </table>
</div> <!-- fin ensembleRecette -->


<style>
    h1 {
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
</style>