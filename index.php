<?php
$currentRecipe = 1;
include 'application/bdd_connection.php';
include 'pages/header.php';
include 'pages/viewRecipe.php';
//interrogation pour voir la dernière recette
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
    $resultSet->closeCursor();//fermeture

    // génération d'une constante HOME, qui contient l'url absolue vers la racine du site
    define("HOME", 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

    //on choisit quelle page afficher avec le DISPATCHER
    require_once "php/dispatcher.php";

    // 2. On récupère les données à afficher et on reçoit les formulaires, c'est le CONTROLLEUR
    //require_once "php\controller.php";

    // chargement de la vue
    $template = 'index';
    include 'pages/layout.phtml';
