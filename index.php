<?php
    if (session_status() === PHP_SESSION_NONE) session_start();

//    Cacher les erreurs (précaution utile pour la mise en ligne)
//    error_reporting(0);

// génération d'une constante HOME, qui contient l'url absolue vers la racine du site
    $_SESSION['HOME'] = 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    
    // Save the project root directory.
    $_SESSION['ROOT_PATH'] = __DIR__ . '/';
    
    // Connection à la base avec pdo
    include_once $_SESSION['ROOT_PATH'] . 'application/bdd_connection.php';
    
    // Chargement des différents éléments de la page
    require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/headerController.php';
    require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/recipesController.php';
    require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/lastRecipeInfosController.php';
    
    // On choisit quelle page afficher avec le DISPATCHER
    require_once $_SESSION['ROOT_PATH'] . 'application/php/dispatcher.php';
    
    // On récupère les données à afficher et on reçoit les formulaires, c'est le CONTROLLEUR
    require_once $_SESSION['ROOT_PATH'] . 'application/php/controller.php';
    
    // chargement de la vue
    include $_SESSION['ROOT_PATH'] . 'application/view/layout.phtml';
    


