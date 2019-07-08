<?php
//    echo getcwd() . "\n";
    
    if (isset($_GET) && !empty($_GET['id']) && empty($_POST['submit'])) {
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
    
    
    if (isset($_POST['submit'])) {
        //On récupère les infos d'une recette donnée par son ID
//        if (array_key_exists('page', $_GET) && !empty($_GET['page']) && $_GET['page'] === 'recipes') {
//            if (!isset($id_recette)) $id_recette = 0; //id recette par défaut, si non définie
            if (empty($_POST['name']) || empty($_POST['ingredients_list']) || empty($_POST['how_many_persons']) || empty($_POST['cooking_time_minutes'])
                || empty($_POST['cooking_instructions']) || empty($_POST['category']) || empty($_POST['recette_id'])) {
//            TODO Afficher erreur
                header('Location: ../../index.php?page=edit_single_recipe&&error=Certains%20champs%20sont%20les%20vides');
                exit();
            } elseif (is_nan($_POST['how_many_persons']) || is_nan($_POST['cooking_time_minutes']) || $_POST['recette_id']) {
                //Si les champs de sont pas des nombre, alors erreur
                header('Location: ../../index.php?page=edit_single_recipe&error=' . urlencode('Utilisez des numéros dans les champs Nombre de personnes et Temps de cuisson'));
                exit();
            } else {
                $_GET['error'] = '';
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

                //Test si fichier photo bien envoyé et pas d'erreurs
                // +   test si la taille < 1Mo
//                if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0 && $_FILES['photo']['size'] <= 1048576) {
//                    //On récupère l'extension
//                    $infosfichier = pathinfo($_FILES['photo']['name']);
//                    $extension_upload = $infosfichier['extension'];
//                    // On teste si elle fait partie des celles autorisées
//                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
////                    if (in_array($extension_upload, $extensions_autorisees, true)) {
////                        // Jusqu'ici, tout va bien, donc on peut stocker le fichhier temporaire sur le disque
////                        move_uploaded_file($_FILES['photo']['tmp_name'], '../../img/' . basename($_FILES['photo']['name']));
////                    }
//                }
//    On peut alors écrire dans la base
                require_once 'application/bdd_connection.php';

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
            header('Location: ../../index.php?pages=add_recipe');
        exit();
//        }
    }
   