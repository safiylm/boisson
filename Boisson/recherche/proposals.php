<?php

$Recettes = array();
include '../Projet/Donnees.inc.php';
include '../data/nom_image.php';

foreach ($Recettes as $item) {
  $tab[] = $item['titre'];
}

$q = htmlspecialchars($_GET['q']);

$hint = "";

if ($q !== "") {
  $q = strtolower($q);
  $len = strlen($q);
  foreach ($tab as $name) {
    if (stristr($q, substr($name, 0, $len))) {
        $hint .=  " <option>" . $name ." </option>";
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
