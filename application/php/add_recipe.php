<?php

//     On verifie que la session n'est déjà pas créée'
    if (session_status() === PHP_SESSION_NONE) session_start();
//    on stocke le nom de la recette envoyée par get, en session
    $_SESSION['name'] = isset($_SESSION['name']) ? $_SESSION['name'] : null;
    if (isset($_GET['name'])) {
        $_SESSION['name'] = $_POST['name'];
    }
    
    if (isset($_POST['submit'])) {
//Si des champs sont vides (normalement, le navigateur gère ça avec l'attribut required, mais il ne faut jamais faire confiance aux données utilisateur...), on affiche une erreur et on redirige
        if (empty($_POST['name']) || empty($_POST['ingredients_list']) || empty($_POST['how_many_persons']) || empty($_POST['cooking_time_minutes'])
            || empty($_POST['cooking_instructions']) || empty($_POST['category'])) {
            header('Location: ../../index.php?page=add_recipe&error=Veuillez%20remplir%20tous%20les%20champs');
            exit();
        }
        
        if (is_nan($_POST['how_many_persons']) || is_nan($_POST['cooking_time_minutes'])) {
            //Si les champs de sont pas des nombre, alors erreur
            header('Location: ../../index.php?page=add_recipe&error=' . urlencode('Utilisez des numéros dans les champs Nombre de personnes et Temps de cuisson'));
            exit();
        }
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
        
        //Test si fichier photo bien envoyé et pas d'erreurs + test si la taille < 1Mo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0 && $_FILES['photo']['size'] <= 1048576) {
            //On récupère l'extension
            $infosfichier = pathinfo($_FILES['photo']['name']);
            $extension_upload = $infosfichier['extension'];
            // On teste si elle fait partie des celles autorisées
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees, true)) {
//            Jusqu'ici, tout va bien, donc on peut stocker le fichhier temporaire sur le disque

//            On génère un nom de fichier unique avec un hash md5 + time, ainsi on peut avoir des fichiers avec le même nom à l'origne.
                $unique_filename = md5(basename($photo) . time());
                $file_extension = strrchr($photo, '.');
                $full_unique_name = $unique_filename . $file_extension;
                move_uploaded_file($_FILES['photo']['tmp_name'], '../../img/' . $full_unique_name);
            }
        }
//    On peut alors écrire dans la base
        require_once '../bdd_connection.php';
        require_once '../model/RecipeModel.class.php';
        RecipeModel::recipeAdd($name, $full_unique_name, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note);
//        Message de confirmation d'ajout
        $_SESSION['flash_confirm_message'] = "Ajout de la recette effectué";
        header('Location: ../../index.php?page=home');
        exit();
    }