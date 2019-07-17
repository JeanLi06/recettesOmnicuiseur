<?php
// TODO mettre controller et model
    if (session_status() === PHP_SESSION_NONE) session_start();

//On stocke la recette consultée courante, afin d'y revenir en cas de navigation sur une autre page.
//et on l'initialise à la dernière créée (index 0 car classement par date décroissante, dans la query SQL
//pour créer $tableIDs)
    if (!isset($_SESSION['indexCurrentRecipe'])) $_SESSION['indexCurrentRecipe'] = 0;

//On récup la liste des ID des recettes, dans un tableau triè par date décroissante
    if (array_key_exists('page', $_GET) && !empty($_GET['page']) && $_GET['page'] === 'recipes' && !isset($tableIDs)) {
        $query = '
        SELECT 
           id
        FROM recette
        ORDER BY creation_date DESC 
    ';
        $resultSet = $pdo->prepare($query);
        $resultSet->execute(array());
        $tableIDs = $resultSet->fetchAll(PDO::FETCH_NUM);
    }

//On récupère les infos d'une recette donnée par son ID
    if (array_key_exists('page', $_GET) && !empty($_GET['page']) && $_GET['page'] === 'recipes') {
        if (!isset($id_recette)) $id_recette = 0; //id recette par défaut, si non définie
        
        $query = '
        SELECT 
            name,
            photo,
            how_many_persons,
            ingredients_list,
            cooking_time_minutes,
            cooking_instructions,
            category,
            note,
            DATE_FORMAT(creation_date, \'%d-%m-%Y à %Hh%i\') as creation_date_formatted
        FROM recette
        WHERE id = ?
        ORDER BY creation_date DESC 
    ';
        $resultSet = $pdo->prepare($query);
//    TODO MEttre à jour indexCurrentRecipe dans les autre pages si effacement de la recette en cours
        $resultSet->execute($tableIDs[$_SESSION['indexCurrentRecipe']]);
        $recette_from_id = $resultSet->fetch();


//navigation entre les recettes
        
        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'first':
                    $_SESSION['indexCurrentRecipe'] = 0;
                    header('Location: index.php?page=recipes');
                    exit();
                    break;
                
                case 'previous':
                    $_SESSION['indexCurrentRecipe'] = $_SESSION['indexCurrentRecipe'] - 1;
                    if ($_SESSION['indexCurrentRecipe'] < 0) {
                        $_SESSION['indexCurrentRecipe'] = 0;
                    }
                    header('Location: index.php?page=recipes');
                    exit();
                    break;
                
                case 'next':
                    $_SESSION['indexCurrentRecipe'] = $_SESSION['indexCurrentRecipe'] + 1;
                    if ($_SESSION['indexCurrentRecipe'] > count($tableIDs) - 1) {
                        $_SESSION['indexCurrentRecipe'] = count($tableIDs) - 1;
                    }
                    header('Location: index.php?page=recipes');
                    exit();
                    break;
                
                case 'last':
                    $_SESSION['indexCurrentRecipe'] = count($tableIDs) - 1;
                    header('Location: index.php?page=recipes');
                    exit();
                    break;
            }
        }
    }



