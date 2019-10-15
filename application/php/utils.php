<?php
//   Fonctions utilitaires

//   Permet la redirection vers une URL dont le nom des passé en paramètre
    function redirect($url)
    {
        header("Location: " . $_SESSION['HOME'] . "index.php?page=" . $url);
        exit();
    }
