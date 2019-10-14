<?php
//   Fonctions utilitaires

//   Permet la redirection vers une URL dont le nom des passé en paramètre
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
