

<?php // Création de la base de données

function query($link,$requete)
{
    $resultat=mysqli_query($link,$requete) or die("$requete : ".mysqli_error($link));
    return($resultat);
}


$mysqli=mysqli_connect('localhost', 'root', 'root') or die("Erreur de connexion");
$base="boisson";
$Sql="
		DROP DATABASE IF EXISTS $base;
		CREATE DATABASE $base;
		USE $base;
        CREATE TABLE utilisateur (
            id INT AUTO_INCREMENT primary key NOT NULL,
            login  VARCHAR(100)  NOT NULL, 
            password  VARCHAR(100)  NOT NULL,  
            nom VARCHAR(100) NULL, prenom VARCHAR(100) NULL, 
            sexe  VARCHAR(100) NULL, email VARCHAR(100) NOT NULL,
            datenaissance DATE NULL,  adresse  VARCHAR(300) NULL , 
            telephone INTEGER NULL
        );	
        CREATE TABLE favori ( 
            id INT AUTO_INCREMENT primary key NOT NULL,
             login  VARCHAR(100) NOT NULL, 
             recette VARCHAR(100) NOT NULL
         );	
		";

echo "Base de données installée avec succès. Si 'Query est vide' est affiché, c'est que tout s'est bien passé.";

echo "<br>";
foreach(explode(';',$Sql) as $Requete) query($mysqli,$Requete);

mysqli_close($mysqli);

?>