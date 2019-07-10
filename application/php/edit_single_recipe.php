<?php
   if (session_status() === PHP_SESSION_NONE) session_start();

    if (isset($_GET) && !empty($_GET['id']) && empty($_POST['submit'])) {
//        session_start();
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
        
        //on stocke en session pour transmettre sur la page envoyée en post
        $_SESSION['recette_from_id'] = $recette_from_id;
    }
    
    
    if (isset($_POST['submit'])) {
        //On récupère les infos d'une recette donnée par son ID
        $recette_from_id = $_SESSION['recette_from_id'];
//    Normalement les champs vides sont gérés par le navigateur avec 'required', mais on ne sait jamais...
        if (empty($_POST['name']) || empty($_POST['ingredients_list']) || empty($_POST['how_many_persons']) || empty($_POST['cooking_time_minutes'])
            || empty($_POST['cooking_instructions']) || empty($_POST['category']) ) {
            if( empty($_POST['recette_id'])) $_POST['recette_id'] = 0;
            $_SESSION['flash_error_message'] = 'Certains champs sont vides';
            header('Location: ../../index.php?page=edit_single_recipe&id=' . $_POST['recette_id']);
            exit();
            //Si les champs de sont pas des nombre, alors erreur
        }
    
        if (!ctype_digit($_POST['how_many_persons']) || !ctype_digit($_POST['cooking_time_minutes'])) {
               $_SESSION['flash_error_message'] = 'Utilisez des numéros dans les champs Nombre de personnes et Temps de cuisson';
            header('Location: ../../index.php?page=edit_single_recipe');
            exit();
        }
    
        $_GET['error'] = '';
        //On extrait les variables de $_POST
        $recette_id = (int)$_POST['recette_id'];
        $name = trim($_POST['name']);
//            Si le nom de l'image n'est pas changé (dans $_FILES), on le récupère dans le $_POST
//           $photo = empty($_FILES['photo']['name']) ? $_POST['photo'] : $_FILES['photo']['name'];
        $photo = $_POST['recipe_photo']; //On récupère le nom dans le champ caché
        $ingredients_list = $_POST['ingredients_list'];
        $how_many_persons = (int)trim($_POST['how_many_persons']);
        $cooking_time_minutes = (int)trim($_POST['cooking_time_minutes']);
        $cooking_instructions = $_POST['cooking_instructions'];
        $category = $_POST['category'];
        $note = $_POST['note'];
    
        //Test si fichier photo bien envoyé et pas d'erreurs
//             +   test si la taille < 1Mo
        if (isset($_FILES['photo']['name']) && $_FILES['photo']['error'] === 0 && $_FILES['photo']['size'] <= 1048576) {
            //On récupère l'extension
            $infosfichier = pathinfo($_FILES['photo']['name']);
            $extension_upload = $infosfichier['extension'];
            // On teste si elle fait partie des celles autorisées
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees, true)) {
//                        // Jusqu'ici, tout va bien, donc on peut stocker le fichhier temporaire sur le disque
                move_uploaded_file($_FILES['photo']['tmp_name'], '../../img/' . basename($_FILES['photo']['name']));
//                    On efface l'ancienne photo
//                    echo unlink('../img/'. $photo . '\')';
//                    define("WEB_ROOT",substr(__DIR__,0,strlen(__DIR__)-3));
                $image_to_delete = "../../img/{$photo}";
                unlink($image_to_delete);
                $photo = $_FILES['photo']['name']; //Il faut mettre à jour le nom de la photo
            }
        }
//    On peut alors écrire dans la base
        require_once '../bdd_connection.php';
    
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
    
        execute($query, [$name, $photo, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note, $recette_id]);
        $_SESSION['flash_confirm_message'] = "Modification de la recette effectuée";
        header('Location: ../../index.php?page=edit_recipes');
        exit();
    }
   