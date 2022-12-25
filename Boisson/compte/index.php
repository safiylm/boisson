<!DOCTYPE html>
<link rel="icon" href="../data/favicon.ico" sizes="16x16" type="image/png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script><?php
session_start();
include("../navigateur/index.php");
// Connexion à la base de données
require "../data/config.php";
?>

<?php 
  $req2 = $bdd->prepare('Select * from utilisateur  WHERE login = ?');
  $req2->execute(array( $_SESSION['user']['login']));
  $data = $req2->fetch();
  $row = $req2->rowCount();

  if($row>0){
      $_SESSION['user']['login'] = $data['login'];
      $_SESSION['user']['password'] = $data['password'];
      $_SESSION['user']['nom'] =$data['nom'];
      $_SESSION['user']['prenom'] = $data['prenom'];
      $_SESSION['user']['sexe'] = $data['sexe'];
      $_SESSION['user']['email'] = $data['email'];
      $_SESSION['user']['datenaissance'] = $data['datenaissance'];
      $_SESSION['user']['adresse'] = $data['adresse'];
      $_SESSION['user']['telephone'] = $data['telephone'];
  }

    if (!empty($_POST['login']) && !empty($_POST['email']) ) {
        $datenaissance = date('Y-m-d', strtotime($_POST['datenaissance']));
        $req = $bdd->prepare('UPDATE utilisateur SET nom = ?, prenom=?, email=?, datenaissance=?, adresse=?, telephone=? WHERE login = ?');
        $req->execute(array($_POST['nom'],
        $_POST['prenom'],$_POST['email'], $datenaissance, 
      $_POST['adresse'],$_POST['telephone'],
        $_SESSION['user']['login']));
        
      
        //go to user data page 
        header('Location: index.php');
        exit();
        }



?>

<div class="container">
<h2 id="titreData"> Données personelles</h2>
<h2 id="titreDataUpdate">Modifier ses données personelles</h2>
<form action="#" method="post">

    <input type="text" class="form-control" name="nom" value="<?php echo $_SESSION['user']['nom']; ?>" /><br />

    <input type="text" class="form-control" name="prenom" value="<?php echo $_SESSION['user']['prenom']; ?>" /><br />

    <input type="text" class="form-control" name="login" value="<?php echo $_SESSION['user']['login']; ?>" required /><br />

    <input type="text" class="form-control" name="email" value="<?php echo $_SESSION['user']['email']; ?>" /><br />

    <input type="password" class="form-control" name="password" value="<?php echo $_SESSION['user']['password']; ?>" required /><br />

    <input type="date" class="form-control" name="datenaissance" value="<?php echo $_SESSION['user']['datenaissance']; ?>" /><br />

    <input type="text" class="form-control" name="adresse" value="<?php echo $_SESSION['user']['adresse']; ?>" /><br />

    <input type="tel" class="form-control" name="telephone" value="<?php echo $_SESSION['user']['telephone']; ?>" /><br />

    <input type="submit" id="EnregistrerUpdate" value="Enregistrer les modifications" class="btn btn-primary"/>
</form>
<button id="modifier" value="Modifier" class="btn btn-primary"> Modifier </button>

</div>

<script>
 $("input").prop('disabled', true);
 $("#recherche").prop('disabled', false);

    $("#EnregistrerUpdate").hide();
    $("#titreDataUpdate").hide();
    
    $("#modifier").click(()=>{
        $("input").prop('disabled', false);
        $("#EnregistrerUpdate").show();
        $("#titreDataUpdate").show();
        $("#modifier").hide();
        $("#titreData").hide();
    })
</script>


<style>
h2{
    margin-bottom: 30px;
}

.container{
    margin-top:150px;
    margin-left: auto;
    margin-right: auto;
    max-width : 500px;
}
</style>