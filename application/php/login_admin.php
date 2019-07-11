<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!empty($_POST['connection']) && (empty($_POST['admin_name']) || empty($_POST['admin_password']))) {
        $_SESSION['flash_error_message'] = 'Les 2 champs doivent être remplis';
        header('Location: ../../index.php?page=login_admin');
        exit();
    }
    
    if (!empty($_POST['connection']) && !empty($_POST['admin_password']) && !empty($_POST['admin_name'])) {
        $admin_password = htmlspecialchars(trim($_POST['admin_password']));
        $admin_name = htmlspecialchars(trim($_POST['admin_name']));
//        if(password_verify('3waLive10', '$2y$10$9i2QbBUELCFWLaxL0RVmjOkOfv/Ks1Aok/LvaPN8vTN3K.OZzF7Nq')) {
        if(password_verify($admin_password, '$2y$10$9i2QbBUELCFWLaxL0RVmjOkOfv/Ks1Aok/LvaPN8vTN3K.OZzF7Nq')) {
            $_SESSION['connected'] = true;
            $_SESSION['flash_confirm_message'] = 'Connection Admin effectuée';
            header('Location: ../../index.php?page=home');
            exit();
        }
    }
    //    TODO A EFFACER echo password_hash('3waLive10', PASSWORD_BCRYPT);
