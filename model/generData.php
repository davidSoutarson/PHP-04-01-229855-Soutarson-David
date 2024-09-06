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

    public $np1 = [];
    public $np2 = [];
    public $np3 = [];

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
        $repartitionSports = []
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

    //repartition 
    public function repartition01()
    {
        $this->np1 = [$this->nSportifPratiquan1S];
        $this->np2 = [$this->nSportifPratiquan2S];
        $this->np3 = [$this->nSportifPratiquan3S];

        //return $np1 . $np2 . $np3;
    }
}
