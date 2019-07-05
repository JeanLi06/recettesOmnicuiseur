<?php

//    On génère la liste des recettes
    $query = '
        SELECT
            id,
            name,
            photo,
            creation_date
        FROM recette
        ORDER BY creation_date DESC
    ';
    $result_set = $pdo->prepare($query);
    $result_set->execute();
    $list_recipes = $result_set->fetchAll();

//    Traitement de la commande depuis edit_recipes.phtml
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        
        switch ($_GET['action']) {
            
            case 'deleteRecipe':
                if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
                    $sql = 'DELETE FROM `recette`
                            WHERE `id` = ?';
                    execute($sql, [(int)$_GET['id']]);
//                TODO Il faut aussi effacer l'image correspondante dans le répertoire img
                    unlink('img/test.jpg');
//                    Si la session pointe sur la recette effacée, on la remet à l'index 0
                    if ($_GET['id'] === $_SESSION['indexCurrentRecipe']) $_SESSION['indexCurrentRecipe'] = 0;
                    header('Location: index.php?page=edit_recipes');
                }
                break;
    
                case 'edit_single_recipe':
                    header('Location: index.php?page=edit_single_recipe&id='.$_GET['id']);
        }
    }

