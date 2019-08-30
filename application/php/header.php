<?php

//comptage du nombre de recettes dans la base
    require_once 'application/model/RecipeModel.class.php';
    $recipes_quantity = RecipeModel::count();
