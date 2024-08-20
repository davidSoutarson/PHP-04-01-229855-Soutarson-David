<?php

class ConextionBD
{

    /**  
     * Nesesite flichier config.php
     * Créer une connexion à la base de données
     */
    public function ce_conecter_bd()
    {
        try {
            $pdo = new PDO($dsn, $user, $password, $conect_options);
            echo "Connexion réussie à la base de données.";
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
