<?php
//    Controller principal
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once $_SESSION['ROOT_PATH'] . 'application/php/utils.php';
    //    Activation chargement automatique des classes
    require_once $_SESSION['ROOT_PATH'] . 'application/php/classes_autoload.php';
    // récupérations des données à renvoyer à la vue en fonction du template choisi
    switch ($template) {
        case 'recettes':
            if ($_GET['page'] === 'recettes' && array_key_exists('id', $_GET) && !empty($_GET['id'])) {
                require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/recipesController.php';
            }
            break;
        
        case 'ajouter-recette':
            if ($_GET['page'] === 'ajouter-recette' && isset($_SESSION['connected'])) {
                require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/addRecipeController.php';
            }
            break;
        
        case 'editer-recettes':
            if ($_GET['page'] === 'editer-recettes' && isset($_SESSION['connected'])) {
                require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/editRecipesController.php';
            }
            break;
        
        case 'editer-recette-seule':
            if ($_GET['page'] === 'editer-recette-seule' && isset($_SESSION['connected'])) {
                require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/editSingleRecipeController.php';
            }
            break;
        
        case 'administrateur':
            require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/loginAdminController.php';
            break;
        
        case 'rechercher':
            require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/searchController.php';
            break;
        
        case '404':
            echo "Erreur : cette page n'existe pas";
            break;
    }