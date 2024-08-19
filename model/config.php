<?php
$host = 'loclhost';
$dbname = 'devoire_ecole';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

//--------------------a utiliset dans une class-------------------------------

// Créer une base de données (si elle n'existe pas déjà)
$cerat_dsn = "mysql:host=$host;charset=$charset";

$cerat_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $password, $cerat_options);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS devoire_ecole CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Base de données créée avec succès.";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

//---------------------a utiliset dans une class------------------------------

// Créer une connexion à la base de données
$conect_dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$conect_options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Gérer les erreurs sous forme d'exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Mode de récupération des résultats par défaut
    PDO::ATTR_EMULATE_PREPARES   => false,  // Désactiver l'émulation des requêtes préparées
];

try {
    $pdo = new PDO($dsn, $user, $password, $conect_options);
    echo "Connexion réussie à la base de données.";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
