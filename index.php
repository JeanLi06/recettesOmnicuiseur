<?php
//TODO verifier XSS sur <?=

//on efface les données de a session précédente
    $_SESSION = array();

// génération d'une constante HOME, qui contient l'url absolue vers la racine du site
//    TODO à utiliser ?
    define('HOME', 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
    
    // Save the project root directory as a global constant.
    define('ROOT_PATH', __DIR__);

//    Activation chargement automatique des classes
    require_once 'application/php/classes_autoload.php';
    
    // Connection à la base avec pdo
    include_once 'application\bdd_connection.php';

//    Chargement différents éléments de la page
    include_once 'application\php\header.php';
    include_once 'application\php\recipes.php';
    include_once 'application\controller\last_recipe_infos.php';

//on choisit quelle page afficher avec le DISPATCHER
    require_once "application\php\dispatcher.php";
    
    // On récupère les données à afficher et on reçoit les formulaires, c'est le CONTROLLEUR
    require_once "application\controller\controller.php";
    
    // chargement de la vue
    include 'application\view\layout.phtml';
    


