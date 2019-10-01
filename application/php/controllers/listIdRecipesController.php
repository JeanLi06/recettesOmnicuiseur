<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
//Récupère la liste des ID des recettes, dans le tableau $tableIDs, triée par date décroissante
    if (array_key_exists('page', $_GET) && !empty($_GET['page']) && $_GET['page'] === 'recettes' && !isset($tableIDs)) {
        require_once $_SESSION['ROOT_PATH'] . 'application/model/RecipeModel.class.php';
        $tableIDs = RecipeModel::listOfIDs();
    }
