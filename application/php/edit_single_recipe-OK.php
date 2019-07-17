<?php
    
    if (!empty($_GET) && !empty($_GET['id']) && empty($_POST['submit'])) {
        require_once 'application/bdd_connection.php';
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
            creation_date
        FROM recette
        WHERE id = ?
        ORDER BY creation_date DESC
    ';
        $resultSet = $pdo->prepare($query);
        $resultSet->execute([(int)$_GET['id']]);
        $recette_from_id = $resultSet->fetch();
    }
    
    if (!empty($_POST['submit'])) {
        echo getcwd() . "\n";
    
        //On extrait les variables de $_POST
        $recette_id = (int)$_POST['recette_id'];
        $name = trim($_POST['name']);
        $photo = $_FILES['photo']['name'];
        $ingredients_list = $_POST['ingredients_list'];
        $how_many_persons = (int)trim($_POST['how_many_persons']);
        $cooking_time_minutes = (int)trim($_POST['cooking_time_minutes']);
        $cooking_instructions = $_POST['cooking_instructions'];
        $category = $_POST['category'];
        $note = $_POST['note'];
        if (!empty($_POST['submit'])) {
            require_once '../bdd_connection.php';
        var_dump($name);
            $query = "UPDATE `recette`
                      SET name = ?,
                          photo = ?,
                          ingredients_list = ?,
                          how_many_persons = ?,
                          cooking_time_minutes = ?,
                          cooking_instructions = ?,
                          category = ?,
                          note = ?,
                          creation_date = NOW()
                      WHERE id = ?";
            try {
                execute($query, [$name, $photo, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note, $recette_id]);
            } catch (Exception $e) {
                echo 'erreur PDO ' . $e->getMessage();
                die();
            }
        }
    }