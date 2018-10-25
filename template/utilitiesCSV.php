<?php

/**
 * Enregistre les données d'un tableau dans un fichier CSV
 * @param $datas
 * @param $fileName
 */
function save_csv($datas, $fileName) {
    // ouverture de la ressource en écriture
    $file = fopen($fileName, 'w');


    // insertion de la ligne dans le tableau
    foreach ($datas as $line) {
        fputcsv($file, $line);
    }

    // fermeture de la ressource
    fclose($file);
}


/**
 * @param $fileName string nom du fichier et chemin d'accès
 * @return array données récupérées dans le CSV
 */
function get_csv($fileName) {
    // ouverture de la ressource en lecture (si le fichier n'existe pas on le crée
    $file = fopen($fileName, 'a+');

    $datas = [];

    // quand il n'y a plus de ligne à retourner, fgetscsv retourne false
    while ($line = fgetcsv($file)) {

        // génération du tableau de données
        array_push($datas, $line);

    }

    return $datas;
}


