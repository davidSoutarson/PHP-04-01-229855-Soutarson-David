<?php

/**
 * Class GenerData
 * Cette classe permet de générer des données pour des écoles, des élèves, 
 * et leur répartition en termes de pratique sportive.
 */
class GenerData
{
    // Propriétés privées pour stocker les données
    private $pdo; // Connexion à la base de données
    private $nomEcoles; // Noms des écoles
    private $nombreEleves; // Nombre d'élèves dans chaque école
    private $nomberDeSportifs; // Nombre total de sportifs dans une école
    private $nSportifPratiquan1S; // Nombre de sportifs pratiquant 1 seul sport
    private $nSportifPratiquan2S; // Nombre de sportifs pratiquant 2 sports
    private $nSportifPratiquan3S; // Nombre de sportifs pratiquant 3 sports

    public $lesCinqSports = []; // Les cinq sports disponibles

    // Variables pour les répartitions équivalentes
    private $repartitionEquivalente1S;
    private $repartitionEquivalente2S;
    private $repartitionEquivalente3S;

    // Tableaux pour la répartition des sportifs dans les sports
    public $repartitionSports1  = [];
    public $repartitionSports2  = [];
    public $repartitionSports3  = [];

    /**
     * Constructeur de la classe GenerData
     * @param $pdo : connexion à la base de données
     * @param array $nomEcoles : noms des écoles
     * @param int $nombreEleves : nombre d'élèves dans chaque école
     * @param int $nomberDeSportifs : nombre total de sportifs
     * @param int $nSportifPratiquan1S : nombre de sportifs pratiquant 1 sport
     * @param int $nSportifPratiquan2S : nombre de sportifs pratiquant 2 sports
     * @param int $nSportifPratiquan3S : nombre de sportifs pratiquant 3 sports
     */
    public function __construct(
        $pdo,
        $nomEcoles = [],
        $nombreEleves = 0,
        $nomberDeSportifs = 0,
        $nSportifPratiquan1S = 0,
        $nSportifPratiquan2S = 0,
        $nSportifPratiquan3S = 0,
        $lesCinqSports = [],
        $repartitionEquivalente1S = 0,
        $repartitionEquivalente2S = 0,
        $repartitionEquivalente3S = 0,
        $repartitionSports1  = [],
        $repartitionSports2  = [],
        $repartitionSports3  = []
    ) {
        // Initialisation des propriétés
        $this->pdo = $pdo;
        $this->nomEcoles = $nomEcoles;
        $this->nombreEleves = $nombreEleves;
        $this->nomberDeSportifs = $nomberDeSportifs;
        $this->nSportifPratiquan1S = $nSportifPratiquan1S;
        $this->nSportifPratiquan2S = $nSportifPratiquan2S;
        $this->nSportifPratiquan3S = $nSportifPratiquan3S;

        // Liste des 5 sports
        $this->lesCinqSports  = ['boxe', 'judo', 'football', 'natation', 'cyclisme'];

        // Initialisation des répartitions équivalentes
        $this->repartitionEquivalente1S = $repartitionEquivalente1S;
        $this->repartitionEquivalente2S = $repartitionEquivalente2S;
        $this->repartitionEquivalente3S = $repartitionEquivalente3S;

        // Répartition des sportifs dans les sports pour chaque choix
        $this->repartitionSports1  = array_fill_keys($this->lesCinqSports, 0);
        $this->repartitionSports2  = array_fill_keys($this->lesCinqSports, 0);
        $this->repartitionSports3  = array_fill_keys($this->lesCinqSports, 0);
    }

    /**
     * Générer les noms des écoles.
     * @return array Les noms des écoles
     */
    public function genererNomEcoles()
    {
        $nomEcole = ['A', 'B', 'C'];
        $this->nomEcoles = array_merge($this->nomEcoles, $nomEcole);
        return $this->nomEcoles;
    }

    /**
     * Générer un nombre aléatoire d'élèves dans une école.
     * @return int Le nombre d'élèves généré
     */
    public function genererNombreEleves()
    {
        $this->nombreEleves = rand(20, 600); // Génère un nombre aléatoire entre 20 et 600
        return $this->nombreEleves;
    }

    /**
     * Générer un nombre aléatoire de sportifs par rapport au nombre d'élèves.
     * @return int Le nombre de sportifs généré
     */
    public function genererNombreDeSportif()
    {
        $this->nomberDeSportifs = rand(0, $this->nombreEleves); // générer le nombre de sportifs par rapport au nombre d'élèves
        return $this->nomberDeSportifs;
    }

    /**
     * Générer un nombre aléatoire de sportifs pratiquant 1 sport.
     * @return int Le nombre de sportifs généré
     */
    public function genererSportifPratiquan1S()
    {
        $this->nSportifPratiquan1S = rand(0, $this->nomberDeSportifs);
        return $this->nSportifPratiquan1S;
    }

    /**
     * Générer le nombre d'élèves pratiquant 2 sports.
     * @return int Le nombre de sportifs pratiquant 2 sports
     */
    public function genererSportifPratiquan2S()
    {
        $reste = $this->nomberDeSportifs - $this->nSportifPratiquan1S;
        $this->nSportifPratiquan2S = rand(0, $reste);
        return $this->nSportifPratiquan2S;
    }

    /**
     * Générer le nombre d'élèves pratiquant 3 sports.
     * @return int Le nombre de sportifs pratiquant 3 sports
     */
    public function genererSportifPratiquan3S()
    {
        $this->nSportifPratiquan3S = $this->nomberDeSportifs - ($this->nSportifPratiquan1S + $this->nSportifPratiquan2S);
        return $this->nSportifPratiquan3S;
    }

    /**
     * Fonction privée pour calculer la répartition équivalente.
     * @param int $np Nombre de sportifs
     * @param int $multiplicateur Multiplicateur de la répartition
     * @return int Résultat du calcul de la répartition
     */
    private function calMulti($np, $multiplicateur)
    {
        return ($np > 0) ? $np * $multiplicateur : 0;
    }

    /**
     * Calculer la répartition pour les sportifs pratiquant 1 sport.
     * @return int La répartition équivalente pour 1 sport
     */
    public function repChoi1()
    {
        $this->repartitionEquivalente1S = $this->calMulti($this->nSportifPratiquan1S, 1);
        return $this->repartitionEquivalente1S;
    }

    /**
     * Calculer la répartition pour les sportifs pratiquant 2 sports.
     * @return int La répartition équivalente pour 2 sports
     */
    public function repChoi2()
    {
        $this->repartitionEquivalente2S = $this->calMulti($this->nSportifPratiquan2S, 2);
        return $this->repartitionEquivalente2S;
    }

    /**
     * Calculer la répartition pour les sportifs pratiquant 3 sports.
     * @return int La répartition équivalente pour 3 sports
     */
    public function repChoi3()
    {
        $this->repartitionEquivalente3S = $this->calMulti($this->nSportifPratiquan3S, 3);
        return $this->repartitionEquivalente3S;
    }

    /**
     * Attribuer une répartition aléatoire pour tous les sports.
     * @param int $repartitionEquivalente La répartition totale à distribuer
     * @param array &$repartitionSports Tableau de sports à répartir
     * @return void
     */
    private function attribuerRepartitionAleatoireTousSports($repartitionEquivalente, &$repartitionSports)
    {
        if ($repartitionEquivalente <= 0 || empty($repartitionSports)) {
            echo "<p class='atention' > Répartition invalide ou tableau de sports vide.</p>";
            return;
        }

        $total = $repartitionEquivalente;  // La valeur à répartir
        $sports = array_keys($repartitionSports);  // Liste des sports
        $nombreSports = count($sports);  // Nombre de sports disponibles

        // Répartition aléatoire initiale pour chaque sport
        for ($i = 0; $i < $nombreSports - 1; $i++) {
            $repartitionAleatoire = mt_rand(0, $total);
            $repartitionSports[$sports[$i]] += $repartitionAleatoire;
            $total -= $repartitionAleatoire;
        }

        // Attribuer le reste au dernier sport
        $repartitionSports[$sports[$nombreSports - 1]] += $total;

        // Afficher la répartition des sportifs pour chaque sport

        foreach ($repartitionSports as $sport => $valeur) {
            echo "<p>{$sport} reçoit {$valeur} sportifs.</p>";
        }
    }

    /**
     * Effectuer la répartition aléatoire pour le choix 1 (pratiquant 1 sport).
     * @return void
     */
    public function repartitionAleatoireChoix1()
    {
        $this->attribuerRepartitionAleatoireTousSports($this->repartitionEquivalente1S, $this->repartitionSports1);
    }

    /**
     * Effectuer la répartition aléatoire pour le choix 2 (pratiquant 2 sports).
     * @return void
     */
    public function repartitionAleatoireChoix2()
    {
        $this->attribuerRepartitionAleatoireTousSports($this->repartitionEquivalente2S, $this->repartitionSports2);
    }

    /**
     * Effectuer la répartition aléatoire pour le choix 3 (pratiquant 3 sports).
     * @return void
     */
    public function repartitionAleatoireChoix3()
    {
        $this->attribuerRepartitionAleatoireTousSports($this->repartitionEquivalente3S, $this->repartitionSports3);
    }

    public function nomSport()
    {
        $nomSport = $this->lesCinqSports = ['boxe', 'judo', 'football', 'natation', 'cyclisme'];
        return $nomSport;
    }
}
