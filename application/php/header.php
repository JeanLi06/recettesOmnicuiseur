<?php
//comptage du nombre de recettes dans la base
    require_once $_SESSION['ROOT_PATH'] . 'application/model/RecipeModel.class.php';
    $recipes_quantity = RecipeModel::count();
