<?php
    
    if (isset($_POST['submit']) && !empty($_POST['search_item'])) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        require_once('../bdd_connection.php');
//        On sauve en session le mot de recherche, pour l'afficher sur la page suivante
        $_SESSION['search_item'] = $_POST['search_item'];
//        COLLATE utf8_unicode_ci permet d'être tolérant avec les accents de la requête
        $query = "
        SELECT
            id,
            name,
            photo,
            DATE_FORMAT(creation_date, '%d-%m-%Y à %Hh%i') as creation_date_formatted
        FROM `recette`
        WHERE `ingredients_list`  LIKE ?
        OR `name` LIKE ?
        COLLATE utf8_unicode_ci
        ";
        $item = strtolower(trim($_POST['search_item']));
        $result_set = $pdo->prepare($query);
        $result_set->execute(["%$item%", "%$item%"]);
        $list_recipes = $result_set->fetchAll();
        $_SESSION['list_recipes'] = $list_recipes;
        header('Location: ../../index.php?page=search');
        exit();
    }