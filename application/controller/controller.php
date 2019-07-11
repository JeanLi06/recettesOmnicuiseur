<?php
// récupérations des données à renvoyer à la vue en fonction du template choisi
switch ($template) {
    // page pour le contenu d'un article
    case 'recipes':
        if ($_GET['page'] === 'recipes' && array_key_exists('id', $_GET) && !empty($_GET['id'])) {
//            require_once 'application/php/recipes.php';
            require_once 'application/php/recipes.php';
        }
        break;
    
    case 'add_recipe':
        if ($_GET['page'] === 'add_recipe' ) {
            require_once 'application/php/add_recipe.php';
        }
        break;
    
    case 'edit_recipes':
        if ($_GET['page'] === 'edit_recipes' ) {
            require_once 'application/php/edit_recipes.php';
        }
        break;
    
    case 'edit_single_recipe':
        if ($_GET['page'] === 'edit_single_recipe') {
            require_once 'application/php/edit_single_recipe.php';
        }
        break;

    case 'admin':
        require_once 'application/php/login_admin.php';
        echo '****** admin ******';
        break;

    case 'home':
//        TODO reparer le home
//        require_once '../php/home.php';
        break;

    default :
        echo "Erreur : ce template n'existe pas";
}