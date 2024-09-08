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

    private function calculerRepartitionEquivalente($np, $multiplicateur)
    {
        if ($np >= 5 && $np != 0) {
            $repartitionEquivalente = ($np * $multiplicateur) / 5;
            $result = (int) floor($repartitionEquivalente);

            return $result;
        } elseif ($np < 5 && $np != 0) {
            $result = ($np * $multiplicateur) / $np;

            return $result;
        } else {
            return 0;
        }
    }

    // Utilisation de la fonction pour chaque $np

    public function repE1()
    {
        $this->repartitionEquivalente1S = $this->calculerRepartitionEquivalente($this->nSportifPratiquan1S, 1);
        return $this->repartitionEquivalente1S;
    }

    public function repE2()
    {
        $this->repartitionEquivalente2S = $this->calculerRepartitionEquivalente($this->nSportifPratiquan2S, 2);
        return $this->repartitionEquivalente2S;
    }

    public function repE3()
    {
        $this->repartitionEquivalente3S = $this->calculerRepartitionEquivalente($this->nSportifPratiquan3S, 3);

        return $this->repartitionEquivalente3S;
    }
}
