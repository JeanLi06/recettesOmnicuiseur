<?php
//    Cette page permet d'éditer une recette existante
    require_once 'utils.php';
    sessionStart();
//    On stocke l'ID de la recette transmis en GET depuis la page edit_recipes
    if (isset($_GET) && !empty($_GET['id']) && empty($_POST['submit'])) {
        $recette_from_id = RecipeModel::findFromId($_GET['id']);
        //on stocke en session pour transmettre sur la page envoyée en post
        $_SESSION['recette_from_id'] = $recette_from_id;
    }
    if (isset($_POST['submit'])) {
        //On récupère les infos d'une recette donnée par son ID
        $recette_from_id = $_SESSION['recette_from_id'];
//    Normalement les champs vides sont gérés par le navigateur avec 'required',
//    mais on ne fait pas confiance aux données envoyées par l'utilisateur
        if (empty($_POST['name']) || empty($_POST['ingredients_list']) || empty($_POST['how_many_persons']) || empty($_POST['cooking_time_minutes'])
            || empty($_POST['cooking_instructions']) || empty($_POST['category'])) {
            if (empty($_POST['recette_id'])) $_POST['recette_id'] = 0;
            $_SESSION['flash_error_message'] = 'Certains champs sont vides';
            redirect('edit_single_recipe&id=' . $_POST['recette_id']);
//            header('Location: ../../index.php?page=edit_single_recipe&id=' . $_POST['recette_id']);
            exit();
        }
        //Si les champs de sont pas des nombre, alors erreur
        if (!ctype_digit($_POST['how_many_persons']) || !ctype_digit($_POST['cooking_time_minutes'])) {
            $_SESSION['flash_error_message'] = 'Utilisez des numéros dans les champs Nombre de personnes et Temps de cuisson';
//            header('Location: ../../index.php?page=edit_single_recipe');
            redirect('edit_single_recipe');
            exit();
        }
        
        $_GET['error'] = '';
        //On extrait les variables de $_POST
        $recette_id = (int)$_POST['recette_id'];
        $name = trim($_POST['name']);
//            Si le nom de l'image n'est pas changé (dans $_FILES), on le récupère dans le $_POST
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
            $infos_fichier = pathinfo($_FILES['photo']['name']);
            $extension_upload = $infos_fichier['extension'];
            // On teste si elle fait partie des celles autorisées
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees, true)) {
// Jusqu'ici, tout va bien, donc on peut écrire le fichier temporaire sur le disque
// On génère un nom de fichier unique avec un hash md5 + time
                $unique_filename = md5(basename($photo) . time());
                $file_extension = strrchr($photo, '.');
                $full_unique_name = $unique_filename . $file_extension;
                move_uploaded_file($_FILES['photo']['tmp_name'], '../../img/' . $full_unique_name);
//                    On efface l'ancienne photo
                $image_to_delete = "../../img/{$photo}";
                unlink($image_to_delete);
                $photo = $full_unique_name; //mise à jour le nom de la photo
            }
        }
//    On peut alors mettre à jour la recette
        require_once '../model/RecipeModel.class.php';
        require_once '../bdd_connection.php';
//        require_once ROOT_PATH . 'application/bdd_connection.php';
        RecipeModel::update($name, $photo, $ingredients_list, $how_many_persons, $cooking_time_minutes, $cooking_instructions, $category, $note, $recette_id);
        $_SESSION['flash_confirm_message'] = 'Modification de la recette effectuée';
        redirect('edit_recipes');
//        header('Location: ../../index.php?page=edit_recipes');
        exit();
    }
   