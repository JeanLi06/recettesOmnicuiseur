<?php
// Cette page permet de choisir quelle vue afficher selon données fournies dans la chaine de requête*

// définition d'une page par défaut "home"
    $template = 'accueil';

//recette par défaut
    $currentRecipe = 0;

// récupération de la clé "page" dans l'url pour modifier la page à afficher en cas de soumission de form
    if (array_key_exists('page', $_GET)) {
        // choix de la page
        $template = $_GET['page'];
        // affichage de la page 404 si la page n'existe pas
        if (!is_file("application/view/$template.phtml") || $_GET['page'] == '404') {
            $template = 404;
        }
    }
    