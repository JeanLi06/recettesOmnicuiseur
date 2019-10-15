<?php
    if (session_status() === PHP_SESSION_NONE) session_start();

// Cette page permet de choisir quelle vue afficher selon données fournies dans la chaine de requête*

// définition d'une page par défaut "home"
    $template = 'accueil';

//recette par défaut (c'est un index, pas l'ID de la bdd)
    $currentRecipe = 0;

// récupération de la clé "page" dans l'url pour modifier la page à afficher en cas de soumission de form
    if (array_key_exists('page', $_GET)) {
        $template = (string)$_GET['page'];
        // affichage de la page 404 si la page n'existe pas
        if (!file_exists("application/view/$template.phtml")) {
            $template = 404;
        }
    }
    