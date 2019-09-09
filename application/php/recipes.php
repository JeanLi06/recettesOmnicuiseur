<?php
//    Cette page affiche une recette, et permet de naviguer parmi celles existantes
//    TODO Fleche pour remonter en haut (qui apparait)
//    if (session_status() === PHP_SESSION_NONE) session_start();

//On stocke la recette consultée courante, afin d'y revenir en cas de navigation sur une autre page.
//et on l'initialise à la dernière créée (index 0 car classement par date décroissante, dans la query SQL
//pour créer la table des id disponibles : $tableIDs)
    if (!isset($_SESSION['indexCurrentRecipe'])) $_SESSION['indexCurrentRecipe'] = 0;
    include_once 'application\controller\list_id_recipes.php';

//On récupère les infos d'une recette donnée par son ID
    if (array_key_exists('page', $_GET) && !empty($_GET['page']) && $_GET['page'] === 'recipes') {
        if (!isset($id_recette)) $id_recette = 0; //id recette par défaut, si non définie
        $recette_from_id = RecipeModel::findFromId($tableIDs[$_SESSION['indexCurrentRecipe']][0]);
        //On gère le choix de l'utilisateur pour la navigation entre les recettes
        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'first':
                    $_SESSION['indexCurrentRecipe'] = 0;
                    break;
                case 'previous':
                    $_SESSION['indexCurrentRecipe'] = $_SESSION['indexCurrentRecipe'] - 1;
                    if ($_SESSION['indexCurrentRecipe'] < 0) {
                        $_SESSION['indexCurrentRecipe'] = 0;
                    }
                    break;
                case 'next':
                    $_SESSION['indexCurrentRecipe'] = $_SESSION['indexCurrentRecipe'] + 1;
                    if ($_SESSION['indexCurrentRecipe'] > count($tableIDs) - 1) {
                        $_SESSION['indexCurrentRecipe'] = count($tableIDs) - 1;
                    }
                    break;
                case 'last':
                    $_SESSION['indexCurrentRecipe'] = count($tableIDs) - 1;
                    break;
            }
//          On recharge la page avec la nouvelle recette choisie
            redirect('recipes');
        }
    }



