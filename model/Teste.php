<?php

class GenerData
{
    private $pdo;
    private $nomEcoles;
    private $nombreEleves;
    private $nomberDeSportifs;
    private $nSportifPratiquan1S;
    private $nSportifPratiquan2S;
    private $nSportifPratiquan3S;

    private $lesCinqSports;
    private $repartitionSports;

    public function __construct(
        $pdo,
        $nomEcoles = [],
        $nombreEleves = 0,
        $nomberDeSportifs = 0,
        $nSportifPratiquan1S = 0,
        $nSportifPratiquan2S = 0,
        $nSportifPratiquan3S = 0,
        $lesCinqSports = [],
        $repartitionSports = []
    ) {
        $this->pdo = $pdo;
        $this->nomEcoles = $nomEcoles;
        $this->nombreEleves = $nombreEleves;
        $this->nomberDeSportifs = $nomberDeSportifs;
        $this->nSportifPratiquan1S = $nSportifPratiquan1S;
        $this->nSportifPratiquan2S = $nSportifPratiquan2S;
        $this->nSportifPratiquan3S = $nSportifPratiquan3S;
        $this->lesCinqSports  = ['boxe', 'judo', 'football', 'natation', 'cyclisme'];
        $this->repartitionSports  = [
            'boxe' => 0,
            'judo' => 0,
            'football' => 0,
            'natation' => 0,
            'cyclisme' => 0
        ];
    }

    // Méthode pour générer les noms des écoles
    public function genererNomEcoles()
    {
        $nomEcole = ['A', 'B', 'C'];

        for ($n = 0; $n < count($nomEcole); $n++) {
            $this->nomEcoles[] = $nomEcole[$n];
        }
        return $this->nomEcoles;
    }

    // Méthode pour générer un nombre aléatoire d'élèves dans une école
    public function genererNombreEleves()
    {
        $this->nombreEleves = rand(20, 600); // Génère un nombre aléatoire entre 20 et 600
        return $this->nombreEleves;
    }

    // Méthode pour générer un nombre aléatoire d'élèves sportifs
    public function genererNombreDeSportif()
    {
        $this->nomberDeSportifs = rand(0, $this->nombreEleves); // Génère le nombre de sportifs
        return $this->nomberDeSportifs;
    }

    // Méthode pour générer le nombre d'élèves pratiquant 1 sport
    public function genererSportifPratiquan1S()
    {
        $this->nSportifPratiquan1S = rand(0, $this->nomberDeSportifs);
        return $this->nSportifPratiquan1S;
    }

    // Méthode pour générer le nombre d'élèves pratiquant 2 sports
    public function genererSportifPratiquan2S()
    {
        $reste = $this->nomberDeSportifs - $this->nSportifPratiquan1S;
        $this->nSportifPratiquan2S = rand(0, $reste);
        return $this->nSportifPratiquan2S;
    }

    // Méthode pour générer le nombre d'élèves pratiquant 3 sports
    public function genererSportifPratiquan3S()
    {
        $this->nSportifPratiquan3S = $this->nomberDeSportifs - ($this->nSportifPratiquan1S + $this->nSportifPratiquan2S);
        return $this->nSportifPratiquan3S;
    }

    // Méthode pour répartir les sportifs sur les différents sports
    public function repartirSports()
    {
        // Répartition des sportifs pratiquant 1 sport
        for ($i = 0; $i < $this->nSportifPratiquan1S; $i++) {
            $sport = $this->lesCinqSports[array_rand($this->lesCinqSports)];
            $this->repartitionSports[$sport]++;
        }

        // Répartition des sportifs pratiquant 2 sports
        for ($i = 0; $i < $this->nSportifPratiquan2S; $i++) {
            $sport1 = $this->lesCinqSports[array_rand($this->lesCinqSports)];
            $sport2 = $this->lesCinqSports[array_rand($this->lesCinqSports)];

            // S'assurer que les sports sont différents
            while ($sport1 === $sport2) {
                $sport2 = $this->lesCinqSports[array_rand($this->lesCinqSports)];
            }

            $this->repartitionSports[$sport1]++;
            $this->repartitionSports[$sport2]++;
        }

        // Répartition des sportifs pratiquant 3 sports
        for ($i = 0; $i < $this->nSportifPratiquan3S; $i++) {
            $sport1 = $this->lesCinqSports[array_rand($this->lesCinqSports)];
            $sport2 = $this->lesCinqSports[array_rand($this->lesCinqSports)];
            $sport3 = $this->lesCinqSports[array_rand($this->lesCinqSports)];

            // S'assurer que les sports sont différents
            while ($sport1 === $sport2 || $sport1 === $sport3 || $sport2 === $sport3) {
                $sport2 = $this->lesCinqSports[array_rand($this->lesCinqSports)];
                $sport3 = $this->lesCinqSports[array_rand($this->lesCinqSports)];
            }

            $this->repartitionSports[$sport1]++;
            $this->repartitionSports[$sport2]++;
            $this->repartitionSports[$sport3]++;
        }
    }

    // Méthode pour afficher les résultats
    public function afficherResultats()
    {
        echo "Répartition des élèves sportifs par sport :\n";
        foreach ($this->lesCinqSports as $sport) {
            echo ucfirst($sport) . " : " . $this->repartitionSports[$sport] . "\n";
        }
    }
}

// Exemple d'utilisation
$pdo = null; // Vous pouvez remplacer par une instance PDO si nécessaire
$generateur = new GenerData($pdo);
$generateur->genererNomEcoles();
$generateur->genererNombreEleves();
$generateur->genererNombreDeSportif();
$generateur->genererSportifPratiquan1S();
$generateur->genererSportifPratiquan2S();
$generateur->genererSportifPratiquan3S();
$generateur->repartirSports();
$generateur->afficherResultats();
