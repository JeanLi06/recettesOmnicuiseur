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
        
        case 'add-recipe':
            if ($_GET['page'] === 'add-recipe' && isset($_SESSION['connected'])) {
                require_once 'application/php/add_recipe.php';
            }
            break;
        
        case 'edit-recipes':
            if ($_GET['page'] === 'edit-recipes' && isset($_SESSION['connected'])) {
                require_once 'application/php/edit_recipes.php';
            }
            break;
        
        case 'edit-single-recipe':
            if ($_GET['page'] === 'edit-single-recipe' && isset($_SESSION['connected'])) {
                require_once 'application/php/edit_single_recipe.php';
            }
            break;
        
        case 'login-admin':
            require_once 'application/php/login_admin.php';
            break;
        
        case 'search':
            require_once 'application/php/search.php';
            break;
        
        case 'home':
        case 'index' :
            require_once 'index.php';
            break;
        
        case '404':
            echo "Erreur : $template cette page n'existe pas";
            break;
    }