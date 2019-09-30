<?php
//    Controller principal
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once $_SESSION['ROOT_PATH'] . 'application/php/utils.php';
//    sessionStart();
    //    Activation chargement automatique des classes
    require_once $_SESSION['ROOT_PATH'] . 'application/php/classes_autoload.php';
    // récupérations des données à renvoyer à la vue en fonction du template choisi
    switch ($template) {
        // page pour le contenu d'un article
        case 'recipes':
            if ($_GET['page'] === 'recipes' && array_key_exists('id', $_GET) && !empty($_GET['id'])) {
                require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/recipesController.php';
            }
            break;
        
        case 'add-recipe':
            if ($_GET['page'] === 'add-recipe' && isset($_SESSION['connected'])) {
                require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/addRecipeController.php';
            }
            break;
        
        case 'edit-recipes':
            if ($_GET['page'] === 'edit-recipes' && isset($_SESSION['connected'])) {
                require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/editRecipesController.php';
            }
            break;
        
        case 'edit-single-recipe':
            if ($_GET['page'] === 'edit-single-recipe' && isset($_SESSION['connected'])) {
                require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/editSingleRecipeController.php';
            }
            break;
        
        case 'login-admin':
            require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/loginAdminController.php';
            break;
        
        case 'search':
            require_once $_SESSION['ROOT_PATH'] . 'application/php/controllers/searchController.php';
            break;
        
        case 'home':
        case 'index' :
            require_once 'index.php';
            break;
        
        case '404':
            echo "Erreur : $template cette page n'existe pas";
            break;
    }