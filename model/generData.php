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

    public function __construct(
        $pdo,
        $nomEcoles = [],
        $nombreEleves = 0,
        $nomberDeSportifs = 0,
        $nSportifPratiquan1S = 0,
        $nSportifPratiquan2S = 0,
        $nSportifPratiquan3S = 0
    ) {
        $this->pdo = $pdo;
        $this->nomEcoles = $nomEcoles;
        $this->nombreEleves = $nombreEleves;
        $this->nomberDeSportifs = $nomberDeSportifs;
        #-------
        $this->nSportifPratiquan1S = $nSportifPratiquan1S;
        $this->nSportifPratiquan2S = $nSportifPratiquan2S;
        $this->nSportifPratiquan3S = $nSportifPratiquan3S;
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

    // Méthode pour générer un portion d'élèves sportif pratiquan 1 ativiter dans une école
    public function genererSportifPratiquan1S()
    {
        // nSportifPratiquan1S = rand(0,nombreDeSportifs)
    }

    // Méthode pour générer un portion d'élèves sportif pratiquan 1 ativiter dans une école
    public function genererSportifPratiquan2S()
    {

        // reste = nombreDeSportifs - nSportifPratiquan1S
        // $nSportifPratiquan2S = rand(0,reste) 
    }


    // Méthode pour générer un portion d'élèves sportif pratiquan 1 ativiter dans une école
    public function genererSportifPratiquan3S()
    {

        //nSportifPratiquan1S = nombreDeSportifs - (nSportifPratiquan1S + nSportifPratiquan2S)
    }
}
