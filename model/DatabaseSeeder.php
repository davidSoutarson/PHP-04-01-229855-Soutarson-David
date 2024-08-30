<?php

class DatabaseSeeder
{
    private $pdo;

    public $nombreEleves;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Méthode pour générer un nombre aléatoire d'élèves dans une école
    private function genererNombreEleves()
    {
        return rand(20, 600); // Génère un nombre aléatoire entre 20 et 600
    }

    // Méthode pour générer un nombre aléatoire d'élèves sportifs
    private function genererNombreSportifs($nombre_eleves)
    {
        return rand(0, $nombre_eleves); // Génère un nombre aléatoire de sportifs entre 0 et le nombre total d'élèves
    }

    public function aficheNombreEleves()
    {
        $nombre_eleves = $this->genererNombreEleves();
        return $nombre_eleves; #teste
    }

    // Méthode pour insérer des écoles avec des données aléatoires
    public function seedEcoles($nombre_ecoles = 3)
    {
        $noms_choix = ['A', 'B', 'C'];

        for ($i = 0; $i < $nombre_ecoles; $i++) {
            $nom_ecole = $noms_choix[$i % count($noms_choix)]; // Tourne parmi A, B, C
            $nombre_eleves = $this->genererNombreEleves();
            $nombre_sportifs = $this->genererNombreSportifs($nombre_eleves);

            $sql = "INSERT INTO ecoles (nom_ecole, nombre_eleves, nombre_sportifs) VALUES 
                    ('$nom_ecole', $nombre_eleves, $nombre_sportifs);";

            try {
                $this->pdo->exec($sql);
                echo "Données aléatoires insérées dans la table 'ecoles'.<br>";
            } catch (\PDOException $e) {
                echo "Erreur lors de l'insertion dans 'ecoles' : " . $e->getMessage();
            }
        }
    }

    // Méthode pour générer un nombre aléatoire de sports pratiqués par un élève
    private function genererNombreSports()
    {
        return rand(1, 3); // Génère un nombre aléatoire entre 1 et 3
    }

    // Méthode pour insérer des élèves sportifs avec des données aléatoires
    public function seedElevesSportifs($nombre_eleves = 10)
    {
        $sql_ecoles = "SELECT id FROM ecoles";
        $ecoles = $this->pdo->query($sql_ecoles)->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < $nombre_eleves; $i++) {
            $ecole_id = $ecoles[array_rand($ecoles)]['id']; // Choisir une école au hasard
            $nombre_sports = $this->genererNombreSports();

            $sql = "INSERT INTO eleves_sportifs (ecole_id, nombre_sports) VALUES 
                    ($ecole_id, $nombre_sports);";

            try {
                $this->pdo->exec($sql);
                echo "Données aléatoires insérées dans la table 'eleves_sportifs'.<br>";
            } catch (\PDOException $e) {
                echo "Erreur lors de l'insertion dans 'eleves_sportifs' : " . $e->getMessage();
            }
        }
    }

    // Méthode pour insérer des sports avec des données aléatoires
    public function seedSports()
    {
        $sql_eleves = "SELECT id FROM eleves_sportifs";
        $eleves = $this->pdo->query($sql_eleves)->fetchAll(PDO::FETCH_ASSOC);

        $sports_choix = ['Boxe', 'Judo', 'Football', 'Natation', 'Cyclisme'];

        foreach ($eleves as $eleve) {
            $nombre_sports = $this->genererNombreSports();
            $sports_pratiques = array_rand(array_flip($sports_choix), $nombre_sports);

            if (!is_array($sports_pratiques)) {
                $sports_pratiques = [$sports_pratiques];
            }

            foreach ($sports_pratiques as $sport) {
                $sql = "INSERT INTO sports (nom_sport, eleve_id) VALUES 
                        ('$sport', {$eleve['id']});";

                try {
                    $this->pdo->exec($sql);
                    echo "Données aléatoires insérées dans la table 'sports'.<br>";
                } catch (\PDOException $e) {
                    echo "Erreur lors de l'insertion dans 'sports' : " . $e->getMessage();
                }
            }
        }
    }

    // Méthode pour exécuter tous les seeders
    public function run()
    {
        $this->seedEcoles();
        $this->seedElevesSportifs();
        $this->seedSports();
    }
}
