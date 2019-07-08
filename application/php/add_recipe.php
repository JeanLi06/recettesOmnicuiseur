<?php
    
//    TODO On verifie que la session n'est déjà pas créée'
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['name'] = isset($_SESSION['name']) ? $_SESSION['name'] : null;
    $_SESSION['name'] = isset($_GET['name']) ? $_POST['name'] : $_SESSION['name'];
    
    if (isset($_POST['submit'])) {
//Si des champs sont vides (normalement, le navigateur gère ça, avec l'attribut required, mais bon...), on affiche une erreur et on redirige
        if (empty($_POST['name']) || empty($_POST['ingredients_list']) || empty($_POST['how_many_persons']) || empty($_POST['cooking_time_minutes'])
            || empty($_POST['cooking_instructions']) || empty($_POST['category'])) {
            header('Location: ../../index.php?page=add_recipe&error=Veuillez%20remplir%20tous%20les%20champs');
        } elseif (is_nan($_POST['how_many_persons']) || is_nan($_POST['cooking_time_minutes'])) {
            //Si les champs de sont pas des nombre, alors erreur
            header('Location: ../../index.php?page=add_recipe&error=' . urlencode('Utilisez des numéros dans les champs Nombre de personnes et Temps de cuisson'));
        } else {
            $_GET['error'] = '';
            //On extrait les variables de $_POST
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
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0 && $_FILES['photo']['size'] <= 1048576) {
                //On récupère l'extension
                $infosfichier = pathinfo($_FILES['photo']['name']);
                $extension_upload = $infosfichier['extension'];
                // On teste si elle fait partie des celles autorisées
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees, true)) {
                    // Jusqu'ici, tout va bien, donc on peut stocker le fichhier temporaire sur le disque
                    move_uploaded_file($_FILES['photo']['tmp_name'], '../../img/' . basename($_FILES['photo']['name']));
                }
            }
//    On peut alors écrire dans la base
            require_once '../bdd_connection.php';
            $query = "INSERT
                      INTO recette (name, photo, ingredients_list, how_many_persons, cooking_time_minutes, cooking_instructions, category, note, creation_date)
                      VALUES (?,?,?,?,?,?,?,?, NOW())";
            try {
                execute($query, [$name, $photo, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note]);
            } catch (Exception $e) {
                echo 'erreur' . $e->getMessage();
            }
        }
//        Ajouter un message de confirmation d'ajout
        header('Location: index.php?page=home');
    }