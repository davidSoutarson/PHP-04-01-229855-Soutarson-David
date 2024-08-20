<?php
$host = 'loclhost';
$dbname = 'devoire_ecole';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

//--------------------a utiliset dans une class-------------------------------

$cerat_dsn = "mysql:host=$host;charset=$charset";

$cerat_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

//---------------------a utiliset dans une class------------------------------

$conect_dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$conect_options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Gérer les erreurs sous forme d'exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Mode de récupération des résultats par défaut
    PDO::ATTR_EMULATE_PREPARES   => false,  // Désactiver l'émulation des requêtes préparées
];
