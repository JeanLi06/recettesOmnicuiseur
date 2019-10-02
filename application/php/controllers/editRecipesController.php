<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
// Cette page permet la gestion d'une liste de recettes : édition ou suppression
// Génère un tableau contenant une liste des recettes existantes, avec l'ID le nom, le nom de la photo et la date de création
    $list_recipes = RecipeModel::listAll();

//    Traitement de la commande transmise depuis Editer
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        switch ($_GET['action']) {
//          Effacement de la recette
            case 'delete_recipe':
                if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
                    RecipeModel::delete($_GET['id']);
                    /* Il faut aussi effacer l'image correspondante dans le répertoire img :
                     On récupère la liste des ID des différentes recettes */
                    $id_list = array_column($list_recipes, 'id');
//                    Et on cherche l'index qui correspond à l'ID que l'on veut
                    $found_index = array_search($_GET['id'], $id_list);
//                    on peut alors récupérer le nom de la photo
                    $photo_to_delete = ($list_recipes[$found_index]['photo']);
                    unlink('img/' . $photo_to_delete);
//                    On efface l'index stocké en session
                    $_SESSION['indexCurrentRecipe'] = 0;
                    $_SESSION['flash_confirm_message'] = 'Effacement de la recette effectué';
                    redirect('editer-recettes');
                    exit();
                }
                break;
            // Edition de la recette
            case 'editer-recette-seule':
                redirect('editer-recette-seule&id=' . $_GET['id']);
                exit();
        }
    }

