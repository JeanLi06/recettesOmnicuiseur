<?php
//   Fonctions utilitaires

//   Permet la redirection de l'URL passée en paramètre
    function redirect($url)
    {
        header("Location: " . $_SESSION['HOME'] . "index.php?page=" . $url);
        exit();
    }

//  Démarre une session (si nécessaire)
    function sessionStart()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }
