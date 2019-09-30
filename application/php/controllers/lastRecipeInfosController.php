<?php
//    Récupère les infos de la dernière recette créée
    require_once $_SESSION['ROOT_PATH'] . 'application/model/RecipeModel.class.php';
    $last_recipe = RecipeModel::lastRecipeInfos();
    