<?php
class CreationBD
{
    public $cerat_dsn;
    public $user;
    public $password;

    public $cerat_options;

    public function creerBD($dsn, $user, $password, $cerat_options)
    {

        try {
            $pdo = new PDO($dsn, $user, $password, $cerat_options);

            $pdo->exec("CREATE DATABASE IF NOT EXISTS devoire_ecole CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            echo "Base de données créée avec succès.";
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


    /**
     * verifie la demende de création
     */
    public function verifCreerBD()
    {
        if (!empty($_POST['creer']) && isset($_POST['creer'])) {

            $creer = $_POST['creer'];

            echo "<p> La demende de création de base de doner et bien resue</p>";
        }
        if (isset($creer)) {

            echo "<p> La base de donne peut etre créer! </p>";
            //utilisation de la fontion: creerBD()

        } else {

            echo "<p> En atente de demende de création de base de donnée</p>";
        }
    }
}
