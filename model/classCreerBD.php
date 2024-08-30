<?php
require "config.php";

/**
 * class Creation
 * a besoin Du fichier config.php
 * Cette class permer de créer la base de donner
 */
class CreationBD
{
    /**
     * @var string Propriétés de la classe isu du fichier config.php
     */
    private $dsn;
    /**
     * @var string Propriétés de la classe isu du fichier config.php
     */
    private $user;
    /**
     * @var string Propriétés de la classe isu du fichier config.php
     */
    private $password;
    /**
     * @var array string Propriétés de la classe dans le contucter de celci
     */
    private $options;



    /**
     * Constructeur de la classe utilile les contente du fichier config.php
     */
    public function __construct()
    {
        // Initialisation des propriétés avec les constantes définies dans config.php
        $this->dsn = 'mysql:host=' . HOST . ';charset=' . CHARSET;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
    }

    /**
     * Méthode pour créer la base de données utiliser par la methode verifCreerBD() 
     */
    public function creerBD()
    {
        try {
            $pdo = new PDO($this->dsn, $this->user, $this->password, $this->options);

            // Création de la base de données
            $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET " . CHARSET . " COLLATE utf8mb4_unicode_ci");
            echo "<p>2 Base de données '" . DB_NAME . "' créée avec succès.<p>";
        } catch (\PDOException $e) {
            // Afficher un message d'erreur personnalisé
            echo "Erreur : Impossible de créer la base de données. Détails : " . $e->getMessage();
        }
    }

    // Méthode pour vérifier et créer la base de données si la demande est reçue
    public function verifCreerBD()
    {
        if (!empty($_POST['creer']) && isset($_POST['creer'])) {
            echo "<p>1 La demande de création de base de données a bien été reçue.</p>";

            // Appel de la méthode pour créer la base de données
            $this->creerBD();
        } else {
            echo "<p>0 En attente de demande de création de base de données.</p>";
        }
    }
}
