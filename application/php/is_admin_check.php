<?php
//    Ce code est à inclure au début de chaque page dont l'accès est interdit si on n'est pas un admin connecté
    if (session_status() === PHP_SESSION_NONE) session_start();

//    Si on n'est pas connecté, on envoie un message message d'erreur et on stoppe
    if (empty($_SESSION['connected']) || $_SESSION['connected'] !== true) {
        echo '<p> Connection non valide </p>
          <a href="index.php?page=login_admin">Se connecter</a>';
        exit();
    }
