<?php
if (session_status() === PHP_SESSION_NONE) session_start();

//    On génère la liste des recettes
    $query = "
        SELECT
            id,
            name,
            photo,
            DATE_FORMAT(creation_date, '%d-%m-%Y à %Hh%i') as creation_date_formatted
        FROM recette
        ORDER BY creation_date DESC
    ";
    $result_set = $pdo->prepare($query);
    $result_set->execute();
    $list_recipes = $result_set->fetchAll();

//    Traitement de la commande transmise depuis edit_recipes.phtml
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        
        switch ($_GET['action']) {
//            Effacement de la recette
            case 'delete_recipe':
                if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
                    $sql = 'DELETE FROM `recette`
                            WHERE `id` = ?';
                    execute($sql, [(int)$_GET['id']]);
//                TODO Il faut aussi effacer l'image correspondante dans le répertoire img
                    unlink('img/test.jpg');
//                    Si la session pointe sur la recette effacée, on la remet à l'index 0
                    if ($_GET['id'] === $_SESSION['indexCurrentRecipe']) $_SESSION['indexCurrentRecipe'] = 0;
                    $_SESSION['flash_confirm_message'] = "Effacement de la recette effectué";
                    header('Location: index.php?page=edit_recipes');
                    exit();
                }
                break;
    
                case 'edit_single_recipe':
                    header('Location: index.php?page=edit_single_recipe&id='.$_GET['id']);
                    exit();
        }
    }

