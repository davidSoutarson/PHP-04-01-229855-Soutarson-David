<?php

/**
 * Class GestionEcole
 * Gère les données liées aux écoles et aux élèves, y compris la génération des informations sur les écoles et les élèves pratiquant des sports.
 */
class GestionEcole
{
    /**
     * @var object Connexion à la base de données
     */
    private $connexion;

    /**
     * @var object Instance de la classe GenerData pour générer des données aléatoires
     */
    private $generer;

    public function __construct($connexion)
    {
        // Stocke la connexion à la base de données
        $this->connexion = $connexion;

        // Crée une instance de la classe GenerData avec la connexion PDO pour générer des données aléatoires
        $this->generer = new GenerData($this->connexion->getPDO());
    }

    /**
     * Gère la génération des données des écoles et des élèves pratiquant des sports.
     * Génère les noms d'écoles, le nombre d'élèves et les informations sur les élèves sportifs.
     */
    public function genererDonnees()
    {
        // Récupère une liste de noms d'écoles générés
        $nomEcoles = $this->generer->genererNomEcoles();

        // Parcourt chaque école générée pour afficher et traiter les informations
        echo "<h3>Place pour haut !</h3>";

        foreach ($nomEcoles as $key => $nom_ecole) {
            echo "<div class='contenerGenererContenue'>";

            $nombre_eleves = $this->generer->genererNombreEleves();
            $nombre_sportifs = $this->generer->genererNombreDeSportif();

            // Prépare et exécute l'insertion dans la table `ecoles`
            $sql = "INSERT INTO ecoles (nom_ecole, nombre_eleves, nombre_sportifs) VALUES (?, ?, ?)";
            $stmt = $this->connexion->getPDO()->prepare($sql);
            $stmt->execute([$nom_ecole, $nombre_eleves, $nombre_sportifs]);

            // Récupère l'ID de la dernière école insérée
            $ecole_id = $this->connexion->getPDO()->lastInsertId();

            // Affichage avant insertion dans la base de données
            echo "<div class='creationDeContenue'>";
            echo "<h3 class='titreNtable'>Écoles :</h3>";
            echo "<p>Nom de l'école : " . htmlspecialchars($nom_ecole) . "</p>";
            echo "<p>Nombre d'élèves : " . htmlspecialchars($nombre_eleves) . "</p>";
            echo "<p>Nombre d'élèves sportifs : " . htmlspecialchars($nombre_sportifs) . "</p>";
            echo "</div>";

            // Générer les informations sur les élèves sportifs
            $this->genererSportifs($ecole_id);
            echo "</div>";
        }

        echo "<h3>Les écoles ont été ajoutées à la base de données.</h3>";
    }

    /**
     * Génère des données sur les sportifs dans une école donnée.
     * 
     * @param int $ecole_id L'ID de l'école concernée
     */
    private function genererSportifs($ecole_id)
    {
        $nElevePrati_1_Sport = $this->generer->genererSportifPratiquan1S();
        $nElevePrati_2_Sport = $this->generer->genererSportifPratiquan2S();
        $nElevePrati_3_Sport = $this->generer->genererSportifPratiquan3S();

        // Insertion dans la table `nombre_eleves_pratiquan_1_2_3_sports`
        $sql = "INSERT INTO nombre_eleves_pratiquan_1_2_3_sports (ecole_id, n_eleves_pratiquan_1_sports, n_eleves_pratiquan_2_sports, n_eleves_pratiquan_3_sports) VALUES (?, ?, ?, ?)";
        $stmt = $this->connexion->getPDO()->prepare($sql);
        $stmt->execute([$ecole_id, $nElevePrati_1_Sport, $nElevePrati_2_Sport, $nElevePrati_3_Sport]);

        // Insertion des sports dans la table `sports`
        foreach ($this->generer->nomSport() as $sport) {
            $sql = "INSERT INTO sports (nom_sport, ecole_id) VALUES (?, ?)";
            $stmt = $this->connexion->getPDO()->prepare($sql);
            $stmt->execute([$sport, $ecole_id]);
        }

        // Affichage des informations sur les sportifs
        echo "<div class='creationDeContenue2'>";
        echo "<h3 class='titreNtable'>Nombre d'élèves pratiquant 1, 2 ou 3 sports :</h3>";
        echo "<p>Élèves pratiquant 1 sport : " . htmlspecialchars($nElevePrati_1_Sport) . "</p>";
        echo "<p>Élèves pratiquant 2 sports : " . htmlspecialchars($nElevePrati_2_Sport) . "</p>";
        echo "<p>Élèves pratiquant 3 sports : " . htmlspecialchars($nElevePrati_3_Sport) . "</p>";
        echo "</div>";

        // Affichage des choix sportifs
        echo "<div class='lage'>";
        echo "<h3 class='titreNtable bloc'>Sports</h3>";
        echo "<div class='mdr'>";

        echo "<div class='creationDeContenueChoix'>";
        echo "<p class='info'>Info : Un choix réparti par sport : " . $this->generer->repChoi1() . "</p>";
        echo $this->generer->repartitionAleatoireChoix1();
        echo "</div>";

        echo "<div class='creationDeContenueChoix'>";
        echo "<p class='info'>Info : Deux choix répartis par sport : " . $this->generer->repChoi2() . "</p>";
        echo $this->generer->repartitionAleatoireChoix2();
        echo "</div>";

        echo "<div class='creationDeContenueChoix'>";
        echo "<p class='info'>Info : Trois choix répartis par sport : " . $this->generer->repChoi3() . "</p>";
        echo $this->generer->repartitionAleatoireChoix3();
        echo "</div>";

        echo "<h3>Place pour des données supplémentaires</h3>";
        echo "</div>";

        // Affichage des noms des sports
        echo "<h3>Place pour les sports choisis</h3>";
        foreach ($this->generer->nomSport() as $nomSport) {
            echo "<br>" . htmlspecialchars($nomSport);
        }

        echo "</div>";
    }
}
