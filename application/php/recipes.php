<?php
//On récup l'id dans l'url
if (array_key_exists('id', $_GET) && !empty($_GET['id'])) {

    $id_recette = (int)$_GET['id'];

    $query = '
        SELECT 
            name,
            photo,
            how_many_persons,
            ingredients_list,
            cooking_time_minutes,
            category,
            note,
            creation_date
        FROM recette
        WHERE id = ?
        ORDER BY creation_date DESC 
    ';
    $resultSet = $pdo->prepare($query);
    $resultSet->execute(array($id_recette));
    $recette = $resultSet->fetch();
}