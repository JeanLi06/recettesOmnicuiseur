<?php

//Récupère la liste des ID des recettes, dans le tableau $tableIDs trié par date décroissante
    if (array_key_exists('page', $_GET) && !empty($_GET['page']) && $_GET['page'] === 'recipes' && !isset($tableIDs)) {
        require_once 'application/model/RecipeModel.class.php';
        $tableIDs = RecipeModel::listOfIDs();
    }
