<?php
//    Récupère les infos de la dernière recette créée
    require_once 'application/model/RecipeModel.class.php';
    $last_recipe = RecipeModel::lastRecipeInfos();
    