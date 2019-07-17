<?php
    if (session_status() === PHP_SESSION_NONE) session_start();

//    Si le formulaire comporte un des champs vide => message d'erreur
    if (isset($_POST['connection']) && (empty($_POST['admin_name']) || empty($_POST['admin_password']))) {
        $_SESSION['flash_error_message'] = 'Les 2 champs doivent être remplis';
        header('Location: ../../index.php?page=login_admin');
    }
//    Tous les champs sont présents => on teste leur validité
    if (isset($_POST['connection']) && !empty($_POST['admin_name']) && !empty($_POST['admin_password'])) {
        $admin_name = htmlspecialchars(trim($_POST['admin_name']));
        $admin_password = htmlspecialchars(trim($_POST['admin_password']));
        if(password_verify($admin_password, '$2y$10$9i2QbBUELCFWLaxL0RVmjOkOfv/Ks1Aok/LvaPN8vTN3K.OZzF7Nq')) {
            $_SESSION['connected'] = true;
            $_SESSION['flash_confirm_message'] = 'Connection Admin effectuée';
            header('Location: ../../index.php?page=home');
            echo 'conncecté';
            exit();
        }
    }
