<?php
//    Controller principal
    require_once $_SESSION['ROOT_PATH'] . 'application/php/utils.php';
    sessionStart();
    //    Activation chargement automatique des classes
    require_once $_SESSION['ROOT_PATH'] . 'application/php/classes_autoload.php';
    // récupérations des données à renvoyer à la vue en fonction du template choisi
    switch ($template) {
        // page pour le contenu d'un article
        case 'recipes':
            if ($_GET['page'] === 'recipes' && array_key_exists('id', $_GET) && !empty($_GET['id'])) {
                require_once 'application/php/recipes.php';
            }
            break;
        
        case 'add_recipe':
            if ($_GET['page'] === 'add_recipe' && isset($_SESSION['connected'])) {
                require_once 'application/php/add_recipe.php';
            }
            break;
        
        case 'edit_recipes':
            if ($_GET['page'] === 'edit_recipes' && isset($_SESSION['connected'])) {
                require_once 'application/php/edit_recipes.php';
            }
            break;
        
        case 'edit_single_recipe':
            if ($_GET['page'] === 'edit_single_recipe' && isset($_SESSION['connected'])) {
                require_once 'application/php/edit_single_recipe.php';
            }
            break;
        
        case 'login_admin':
            require_once 'application/php/login_admin.php';
            break;
        
        case 'search':
            require_once 'application/php/search.php';
            break;
        
        case 'home':
            require_once 'index.php';
            break;
        
        default :
            echo "Erreur : ce template n'existe pas";
            break;
    }