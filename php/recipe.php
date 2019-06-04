<?php
if ($debug) echo ' Recipe ';
//    include 'application/bdd_connection.php';
//include 'pages/header.php';
//        pour l'instant, on n'affiche qu'une recette
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
        WHERE id ="1"
        ORDER BY creation_date DESC 
    ';
    $resultSet = $pdo->query($query);
    $recette = $resultSet->fetch();
    $resultSet->closeCursor();//fermeture

//     génération d'une constante HOME, qui contient l'url absolue vers la racine du site
//    define("HOME", 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

