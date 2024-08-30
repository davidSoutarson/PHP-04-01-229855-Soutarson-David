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
            echo "Connexion réussie à la base de données '" . DB_NAME . "'. <br>";
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

    public function creerTables()
    {
        // Création de la table `ecoles`
        $sql_ecoles = "
            CREATE TABLE IF NOT EXISTS ecoles (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                nom_ecole ENUM('A', 'B', 'C') NOT NULL, 
                nombre_eleves INT(11) CHECK(nombre_eleves >= 20 AND nombre_eleves <= 600),
                nombre_sportifs INT(11) CHECK(nombre_sportifs >= 0 AND nombre_sportifs <= 600)
            );
        ";

        /*
        # ENUM('A', 'B', 'C') limite les valeurs possibles
        # CHECK fontion de verification equivalant a if
        */

        // Création de la table `eleves_sportifs`
        $sql_eleves_sportifs = "
            CREATE TABLE IF NOT EXISTS eleves_sportifs (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                ecole_id INT(11) NOT NULL,
                nombre_sports INT(11) CHECK(nombre_sports IN (1, 2, 3)),
                FOREIGN KEY (ecole_id) REFERENCES ecoles(id)
            );
        ";

        // Création de la table `sports`
        $sql_sports = "
            CREATE TABLE IF NOT EXISTS sports (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                nom_sport ENUM('Boxe', 'Judo', 'Football', 'Natation', 'Cyclisme') NOT NULL,
                eleve_id INT(11) NOT NULL,
                FOREIGN KEY (eleve_id) REFERENCES eleves_sportifs(id)
            );
        ";

        try {
            // Exécution des requêtes SQL
            $this->pdo->exec($sql_ecoles);
            echo "Table 'ecoles' créée avec succès.<br>";

            $this->pdo->exec($sql_eleves_sportifs);
            echo "Table 'eleves_sportifs' créée avec succès.<br>";

            $this->pdo->exec($sql_sports);
            echo "Table 'sports' créée avec succès.<br>";
        } catch (\PDOException $e) {
            echo "Erreur lors de la création des tables : " . $e->getMessage();
        }
    }
}
