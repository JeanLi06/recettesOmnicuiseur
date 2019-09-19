<?php
//    Cacher les erreurs (précaution utile pour la mise en ligne)
//    TODO Activer sur hébergeur
//    error_reporting(0);
    require_once 'application/php/utils.php';
    sessionStart();
//    unset($_SESSION['HOME']);
// génération d'une constante HOME, qui contient l'url absolue vers la racine du site
//    define('HTTP_ROOT', 'localhost' === $_SERVER['HTTP_HOST'] ? '/monsite1/' : '/');
        $_SESSION['HOME'] = 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    
    // Save the project root directory.
        $_SESSION['ROOT_PATH'] = __DIR__ . '/';
//    define('ROOT_PATH', realpath(__DIR__) . '/');

//    Activation chargement automatique des classes
//    require_once 'application/php/classes_autoload.php';
    
    // Connection à la base avec pdo
    include_once 'application\bdd_connection.php';
    
//    TODO mettre que des /
    // Chargement des différents éléments de la page
    require_once 'application\php\header.php';
    require_once 'application\php\recipes.php';
    require_once 'application\controller\last_recipe_infos.php';
    
    // On choisit quelle page afficher avec le DISPATCHER
    require_once "application\php\dispatcher.php";
    
    // On récupère les données à afficher et on reçoit les formulaires, c'est le CONTROLLEUR
    require_once "application/controller/controller.php";
    
    // chargement de la vue
    include 'application\view\layout.phtml';
    


