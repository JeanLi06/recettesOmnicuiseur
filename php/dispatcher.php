<?php
/**
 * Ce fichier va choisir quelle vue à afficher
 * Tout dépend de données fournies dans la chaine de requête
 */
if ($debug) echo ' Dispatcher ';

// définition d'une page par défaut "home"
$template = 'home';

// récupération de la clé "page" dans l'url pour modifier la page à afficher en cas de soumission de form
if (array_key_exists('page', $_GET)) {
    echo $_GET['page'];
    // choix de la page
    $template = $_GET['page'];

    // affichage de la page 404 si la page n'existe pas
    if (!is_file("pages/$template.phtml") || $_GET['page'] === '404') {
        $template = 404;
    }
}

