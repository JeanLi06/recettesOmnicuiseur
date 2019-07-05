<?php

//comptage du nombre de recettes dans la base
$query = 'SELECT COUNT(*) as qty FROM recette';
$resultQuantity = $pdo->query($query);
$quantityArray = $resultQuantity->fetch();
$recipeQuantity = htmlspecialchars($quantityArray['qty']); //nombre de recettes deans la base
