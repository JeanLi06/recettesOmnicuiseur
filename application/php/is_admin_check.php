<?php
//    Ce code est à inclure au début de chaque page dont l'accès est interdit si on n'est pas un admin connecté
    sessionStart();
//    Si on n'est pas connecté, on envoie un message message d'erreur, et on affiche le lien de connexion
    if (empty($_SESSION['connected']) || $_SESSION['connected'] !== true) {
        $_SESSION['flash_error_message'] = 'Connexion non valide';
        echo '<p></p> <a href="index.php?page=login-admin">Se connecter</a>';
        exit();
    }
