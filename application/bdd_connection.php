<?php
echo 'connection bdd';
	//	Connexion à la base de données
	$pdo = new PDO
	(
		'mysql:host=localhost;dbname=recettes_omnicuiseur;charset=UTF8',
		'root',
		'',
	    [
	    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES, false
	    ]
    );

////////////////////         FONCTION UTILES        ////////////////////////////////
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