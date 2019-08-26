<?php
    if (session_status() === PHP_SESSION_NONE) session_start();

//On stocke la recette consultée courante, afin d'y revenir en cas de navigation sur une autre page.
//et on l'initialise à la dernière créée (index 0 car classement par date décroissante, dans la query SQL
//pour créer la table des id disponibles : $tableIDs)
    if (!isset($_SESSION['indexCurrentRecipe'])) $_SESSION['indexCurrentRecipe'] = 0;
    include_once 'application\controller\list_id_recipes.php';
    
//On récupère les infos d'une recette donnée par son ID
    if (array_key_exists('page', $_GET) && !empty($_GET['page']) && $_GET['page'] === 'recipes') {
        if (!isset($id_recette)) $id_recette = 0; //id recette par défaut, si non définie
        $recette_from_id = RecipeModel::RecipeFromId($tableIDs[$_SESSION['indexCurrentRecipe']]);
        //navigation entre les recettes
                if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'first':
                    $_SESSION['indexCurrentRecipe'] = 0;
                    header('Location: index.php?page=recipes');
                    exit();
                    break;
                
                case 'previous':
                    $_SESSION['indexCurrentRecipe'] = $_SESSION['indexCurrentRecipe'] - 1;
                    if ($_SESSION['indexCurrentRecipe'] < 0) {
                        $_SESSION['indexCurrentRecipe'] = 0;
                    }
                    header('Location: index.php?page=recipes');
                    exit();
                    break;
                
                case 'next':
                    $_SESSION['indexCurrentRecipe'] = $_SESSION['indexCurrentRecipe'] + 1;
                    if ($_SESSION['indexCurrentRecipe'] > count($tableIDs) - 1) {
                        $_SESSION['indexCurrentRecipe'] = count($tableIDs) - 1;
                    }
                    header('Location: index.php?page=recipes');
                    exit();
                    break;
                
                case 'last':
                    $_SESSION['indexCurrentRecipe'] = count($tableIDs) - 1;
                    header('Location: index.php?page=recipes');
                    exit();
                    break;
            }
        }
    }



