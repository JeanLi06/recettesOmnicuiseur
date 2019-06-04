<?php

if ($debug) echo ' Controller ';
// récupérations des données à renvoyer à la vue en fonction du template choisi
switch ($template) {
    // page pour le contenu d'un article
    case "recipe":
        require_once "HOME/pages/viewRecipe.php";
        break;

//        case "recipe":
//        require_once "../pages/viewRecipe.php";
//        break;

    // page d'accueil (page par défaut);
//    default:
//        require_once "";
//        break;
}