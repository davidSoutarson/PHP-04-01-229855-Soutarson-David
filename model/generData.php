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

    private $lesCinqSports = [];

    private $repartitionEquivalente1S;
    private $repartitionEquivalente2S;
    private $repartitionEquivalente3S;

    private $repartitionSports  = [];




    public function __construct(
        $pdo,
        $nomEcoles = [],
        $nombreEleves = 0,
        $nomberDeSportifs = 0,
        #------
        $nSportifPratiquan1S = 0,
        $nSportifPratiquan2S = 0,
        $nSportifPratiquan3S = 0,
        #------
        $lesCinqSports = [],
        $repartitionEquivalente1S = 0,
        $repartitionEquivalente2S = 0,
        $repartitionEquivalente3S = 0,
        $repartitionSports  = []

    ) {
        $this->pdo = $pdo;
        $this->nomEcoles = $nomEcoles;
        $this->nombreEleves = $nombreEleves;
        $this->nomberDeSportifs = $nomberDeSportifs;
        #-------
        $this->nSportifPratiquan1S = $nSportifPratiquan1S;
        $this->nSportifPratiquan2S = $nSportifPratiquan2S;
        $this->nSportifPratiquan3S = $nSportifPratiquan3S;
        #-------
        $this->lesCinqSports  = ['boxe', 'judo', 'football', 'natation', 'cyclisme'];

        $this->repartitionEquivalente1S = $repartitionEquivalente1S;
        $this->repartitionEquivalente2S = $repartitionEquivalente2S;
        $this->repartitionEquivalente3S = $repartitionEquivalente3S;

        $this->repartitionSports  = [
            'boxe' => 0,
            'judo' => 0,
            'football' => 0,
            'natation' => 0,
            'cyclisme' => 0
        ];
    }

    // Méthode pour générer les noms des ecole nomEcoles
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

    // Méthode pour générer un nombre aléatoire d'élèves dans une école
    public function genererNombreDeSportif()
    {
        $this->nomberDeSportifs = rand(0, $this->nombreEleves); // gener le nombre de sportif par rapor au nonbre d'éleve
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

    public function calRepartition123S()
    {

        $np1 = $this->nSportifPratiquan1S;
        $np2 = $this->nSportifPratiquan2S;
        $np3 = $this->nSportifPratiquan3S;

        if ($np1 >= 5 && $np1 != 0) {

            $repartitionEquivalente1S = $np1 / 5;
            $this->repartitionEquivalente1S = (int) floor($repartitionEquivalente1S);

            echo "<p>" . $this->repartitionEquivalente1S . "</p>";
        }
        if ($np1 < 5 && $np1 != 0) {

            $this->repartitionEquivalente1S = $np1 / $np1;

            echo "<p> ! infrieur a 5: " . $this->repartitionEquivalente1S . "</p>";
        } else {
            $this->repartitionEquivalente3S = 0;
        }

        #____________________________________________________________________________


        if ($np2 >= 5 && $np2 != 0) {
            $repartitionEquivalente2S = ($np2 * 2) / 5;
            $this->repartitionEquivalente2S = (int) floor($repartitionEquivalente2S);

            echo "<p> r2: " . $this->repartitionEquivalente2S . "</p>";
        }
        if ($np2 < 5 && $np2 != 0) {

            $this->repartitionEquivalente2S = ($np2 * 2) / $np2;

            echo "<p> ! r2 infrieur a 5: " . $this->repartitionEquivalente1S . "</p>";
        } else {
            $this->repartitionEquivalente2S = 0;
        }

        #____________________________________________________________________________


        if ($np3 >= 5 && $np3 != 0) {
            $repartitionEquivalente3S = ($np3 * 2) / 5;
            $this->repartitionEquivalente3S = (int) floor($repartitionEquivalente3S);

            echo "<p> r3: " . $this->repartitionEquivalente3S . "</p>";
        }
        if ($np3 < 5 && $np3 != 0) {

            $this->repartitionEquivalente3S = ($np3 * 2) / $np3;

            echo "<p> ! r3 infrieur a 5: " . $this->repartitionEquivalente3S . "</p>";
        } else {
            $this->repartitionEquivalente3S = 0;
        }

        return $this->repartitionEquivalente1S . $this->repartitionEquivalente2S . $this->repartitionEquivalente3S;
    }
}
