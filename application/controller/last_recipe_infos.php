<?php
//    Récupère les infos de la dernière recette créee (grâce à ORDER BY ... DESC)
    $query = '
        SELECT
            id,
            name,
            photo
        FROM recette
        ORDER BY creation_date DESC
    ';
    $resultSet = $pdo->query($query);
    $recettes = $resultSet->fetch();
    
    

