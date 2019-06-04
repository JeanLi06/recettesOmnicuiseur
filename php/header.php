<?php
if ($debug) echo ' Header ';
//comptage du nombre de recettes dans la base
$query = 'SELECT COUNT(*) as qty FROM recette';
$resultQuantity = $pdo->query($query);
$quantityArray = $resultQuantity->fetch();
$recipeQuantity = htmlentities($quantityArray['qty']); //nombre de recettes deans la base
//echo $recipeQuantity;
