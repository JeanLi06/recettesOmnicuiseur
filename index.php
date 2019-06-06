<?php

//activer le debuggage (ou pas)
$debug = false;

// génération d'une constante HOME, qui contient l'url absolue vers la racine du site
define('HOME', 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

//recette par défaut pour la page recipes
$currentRecipe = 1;

require_once 'application/bdd_connection.php';
include 'application\php\header.php';
include 'application\php\recipes.php';

//interrogation pour voir la dernière recette : A DEPLACER DANS MODELE
$query = '
        SELECT
            id,
            name,
            photo
        FROM recette
        ORDER BY creation_date DESC
    ';
$resultSet = $pdo->query($query);
$recettes = $resultSet->fetch();
//$resultSet->closeCursor();//fermeture


//on choisit quelle page afficher avec le DISPATCHER
    require_once "application\php\dispatcher.php";

    // 2. On récupère les données à afficher et on reçoit les formulaires, c'est le CONTROLLEUR
    require_once "application\controller\controller.php";

    // chargement de la vue
//    $template = 'home';
    include 'application\view\layout.phtml';

//TODO URL Rewriting avec .htaccess - 20mn mettre en place MVC



