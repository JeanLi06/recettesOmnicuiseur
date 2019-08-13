<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once('application/bdd_connection.php');
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
//                Il faut aussi effacer l'image correspondante dans le répertoire img
//                    TODO Voir si on ne peut pas faire plus simple...
//                    On récupère la liste des ID des différentes recettes
                    $id_list = array_column($list_recipes, 'id');
//                    Et on cherche l'index qui correspond à l'ID que l'on veut
                    $found_index = array_search($_GET['id'], $id_list);
//                    on peut alors récupérer le nom de la photo
                    $photo_to_delete = ($list_recipes[$found_index]['photo']);
                    unlink('img/' . $photo_to_delete);
//                    On efface l'index stocké en session
                    $_SESSION['indexCurrentRecipe'] = 0;
                    $_SESSION['flash_confirm_message'] = "Effacement de la recette effectué";
                    header('Location: index.php?page=edit_recipes');
                    exit();
                }
                break;
            //            Edition de la recette
            case 'edit_single_recipe':
                header('Location: index.php?page=edit_single_recipe&id=' . $_GET['id']);
                exit();
        }
    }

