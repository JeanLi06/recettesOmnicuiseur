<?php


// récupérations des données à renvoyer à la vue en fonction du template choisi
switch ($template) {
    // page pour le contenu d'un article
    case "recipes":
        require_once 'application/php/recipes.php';
        break;

    case "admin":
//        list($scriptPath) = get_included_files();
//        echo 'The script being executed is ' . $scriptPath;
        require_once 'application/php/admin.php';
        echo '****** admin ******';
        break;

    case "home":
//        require_once '../php/admin.php';
        echo '****** home ******';
        break;

    default :
        echo "Erreur : template n'existe pas";
}