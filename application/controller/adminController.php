<?php

/****************************************************************
 *                   Suppression d'une recette
 ****************************************************************/

if (array_key_exists('id', $_GET) && ctype_digit($_GET['id']) && array_key_exists('action', $_GET)) {
    $action = $_GET['action'];
    // filtrage de l'id
    $id = (int)$_GET['id'];
    switch ($action) {
        case 'delete_recipe':
            // requête de suppression de l'article contenant l'id spécifié dans la query string
            die();
            $sql = "DELETE FROM `recette`
                    WHERE `id` = ?";
            // suppression dans la base de données
            execute($sql, [$id]);
            break;
        case 'showRecipe':
            //Affichage de la recette d'après son ID
            $sql = "SELECT * FROM 'recette'
                    WHERE 'id' = ?";
            break;
    }
}
