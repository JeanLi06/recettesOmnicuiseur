<?php
//Récupère la liste des ID des recettes, dans le tableau $tableIDs trié par date décroissante
    
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
