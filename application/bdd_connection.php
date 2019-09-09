<?php
	//	Connexion à la base de données
	$pdo = new PDO
	(
		'mysql:host=localhost;dbname=recettes_omnicuiseur;charset=UTF8',
		'root',
		'',
	    [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//	    	Demande à PDO de générer une execption en cas d'erreur
	    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES, false
	    ]
    );

// Fonctions utiles pour la base de données //
function fetchAll($sql, array $params = []) {
    global $pdo;
    $request = $pdo->prepare($sql);
    $request->execute($params);
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function fetch($sql, array $params = []) {
    global $pdo;
    $request = $pdo->prepare($sql);
    $request->execute($params);
    return $request->fetch(PDO::FETCH_ASSOC);
}

function execute($sql, array $params = []) {
    global $pdo;
    $request = $pdo->prepare($sql);
    $request->execute($params);
}