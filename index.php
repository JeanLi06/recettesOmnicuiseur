<?php
//TODO verifier XSS sur <?=
//activer le debuggage (ou pas)
$debug = false;

//echo md5("cake_chocolat_ducasse" . time());
//die();

//on efface la session précédente
    $_SESSION = array();

// génération d'une constante HOME, qui contient l'url absolue vers la racine du site
define('HOME', 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

// Connection à pdo
include_once 'application\bdd_connection.php';
include 'application\php\header.php';
include 'application\php\recipes.php';

//TODO interrogation pour voir la dernière recette : A DEPLACER DANS UN MODELE
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

    // On récupère les données à afficher et on reçoit les formulaires, c'est le CONTROLLEUR
    require_once "application\controller\controller.php";

    // chargement de la vue
    include 'application\view\layout.phtml';

//TODO URL Rewriting avec .htaccess - 20mn mettre en place MVC



