<?php
//    Cette page permet de se connecter/déconnecter en tant qu'administrateur, et pouvoir ainsi modifier ajouter ou supprimer des recettes
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once $_SESSION['ROOT_PATH'] . 'application/php/utils.php';

//    Si le formulaire comporte un des champs vide => message d'erreur
    if (isset($_POST['connection']) && (empty($_POST['admin_name']) || empty($_POST['admin_password']))) {
        $_SESSION['flash_error_message'] = 'Les 2 champs doivent être remplis';
        redirect('login_admin');
    }
//    Tous les champs sont présents => on teste leur validité
    if (isset($_POST['connection']) && !empty($_POST['admin_name']) && !empty($_POST['admin_password'])) {
        if (isset($_POST['g-recaptcha-response'])) {
            $captcha_response = $_POST['g-recaptcha-response'];
        } else {
            $_SESSION['flash_error_message'] = 'Erreur de Captcha';
            redirect('login_admin');
        }
        $admin_name = htmlspecialchars(trim($_POST['admin_name']));
        $admin_password = htmlspecialchars(trim($_POST['admin_password']));

//        la clé secrète est dans un fichier séparé, qui n'est pas copié dans GITHUB
        require_once 'secret_key_captcha.php';

//        Idem pour les identifiants administrateurs
        require_once 'secret_admin.php';

//        Vérification du captcha
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key_captcha) . '&response=' . urlencode($captcha_response);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);
        if (!$responseKeys['success']) {
            $_SESSION['flash_error_message'] = 'Captcha non validé';
            redirect('login_admin');
        }

//        On vérifie le le nom utilisateur, le captcha et le mot de passe,
//        TODO Ajouter l'URL de l'hébergeur dans les Paramètres de google.com/captcha
        if (password_verify($admin_password, $secret_admin_password)
            && $responseKeys['success']
            && $admin_name === $secret_admin_name) {
            $_SESSION['connected'] = true;
            $_SESSION['flash_confirm_message'] = 'Connexion Admin effectuée';
            redirect('home');
        } else {
            $_SESSION['flash_error_message'] = 'Nom d\'utilisateur ou mot de passe non valide';
            redirect('login_admin');
        }
    }

//    Test déconnexion
    if (isset($_POST['deconnection']) && $_SESSION['connected']) {
        unset($_SESSION['connected']);
        $_SESSION['flash_confirm_message'] = 'Déconnexion Admin effectuée';
        redirect('home');
    }

