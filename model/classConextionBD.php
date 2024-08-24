<?php
require "config.php";
class ConextionBD
{
    // Propriétés pour stocker les informations de connexion
    private $dsn;
    private $user;
    private $password;
    private $options;
    private $pdo;



    // Constructeur de la classe
    public function __construct()
    {
        // Initialisation des propriétés avec les constantes définies dans config.php
        $this->dsn = 'mysql:host=' . HOST . ';dbname=' . DB_NAME . ';charset=' . CHARSET;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        // Établir la connexion lors de l'instanciation de la classe
        $this->ce_conecter_bd();
    }

    // Méthode pour établir la connexion à la base de données
    public function ce_conecter_bd()
    {
        try {
            // Création de l'objet PDO
            $this->pdo = new PDO($this->dsn, $this->user, $this->password, $this->options);
            echo "Connexion réussie à la base de données '" . DB_NAME . "'.";
        } catch (\PDOException $e) {
            // Afficher un message d'erreur personnalisé
            echo "Erreur : Impossible de se connecter à la base de données. Détails : " . $e->getMessage();
            exit; // Terminer le script en cas d'échec de la connexion
        }
    }

    // Méthode pour obtenir l'objet PDO
    public function getPDO()
    {
        //var_dump($this->pdo); // Diagnostic : afficher le contenu de $this->pdo
        return $this->pdo;
    }
}
