<?php
//    Recherche d'une recette d'après un (des) mot(s) dans le titre ou les ingrédients
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once $_SESSION['ROOT_PATH'] . 'application/php/utils.php';
    if (isset($_POST['submit']) && !empty($_POST['search_item'])) {
//        On sauve en session le mot de recherche
        $_SESSION['search_item'] = $_POST['search_item'];
        require_once $_SESSION['ROOT_PATH'] . 'application/bdd_connection.php';
        require_once $_SESSION['ROOT_PATH'] . 'application/model/RecipeModel.class.php';
//        On sauve en session le résultat de recherche, pour l'afficher sur la page search
        $_SESSION['search_result_list_recipes'] = RecipeModel::searchItem($_POST['search_item']);
        redirect('rechercher');
//        header("Location:" . $_SESSION['HOME'] . "index.php?page=rechercher");
        exit();
    }