<?php

/**
 * Class FormCRUD
 * Permet de créer trois boutons de type submit dans un formulaire pour la gestion CRUD (Créer, Ajouter, Supprimer)
 */
class FormCRUD
{
    /**
     * @var array Données du formulaire
     */
    private $data;

    /**
     * @var string Balise HTML et classe CSS pour le bouton "Nouveau"
     */
    public $tag_p_bt_nouveau = 'p class="p_bt_nouveau"';

    /**
     * @var string Balise HTML et classe CSS pour le bouton "Ajouter"
     */
    public $tag_p_bt_ajouter = 'p class="p_bt_ajouter"';

    /**
     * @var string Balise HTML et classe CSS pour le bouton "Supprimer"
     */
    public $tag_p_bt_suprimer = 'p class="p_bt_suprimer"';

    /**
     * Constructeur de la classe FormCRUD
     * 
     * @param array $data Données utilisées par le formulaire CRUD (peut être vide par défaut)
     */
    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * Méthode privée qui entoure le code HTML fourni pour le bouton "Nouveau"
     * avec les balises et classes HTML définies.
     *
     * @param string $html Code HTML à envelopper
     * @return string Code HTML avec la balise et la classe "Nouveau" ajoutée
     */
    private function p_bt_crudN($html)
    {
        return "<{$this->tag_p_bt_nouveau}>{$html}</{$this->tag_p_bt_nouveau}>";
    }

    /**
     * Méthode privée qui entoure le code HTML fourni pour le bouton "Ajouter"
     * avec les balises et classes HTML définies.
     *
     * @param string $html Code HTML à envelopper
     * @return string Code HTML avec la balise et la classe "Ajouter" ajoutée
     */
    private function p_bt_crudA($html)
    {
        return "<{$this->tag_p_bt_ajouter}>{$html}</{$this->tag_p_bt_ajouter}>";
    }

    /**
     * Méthode privée qui entoure le code HTML fourni pour le bouton "Supprimer"
     * avec les balises et classes HTML définies.
     *
     * @param string $html Code HTML à envelopper
     * @return string Code HTML avec la balise et la classe "Supprimer" ajoutée
     */
    private function p_bt_crudS($html)
    {
        return "<{$this->tag_p_bt_suprimer}>{$html}</{$this->tag_p_bt_suprimer}>";
    }

    /**
     * Récupère la valeur associée à une clé spécifique dans les données du formulaire.
     *
     * @param string $index Nom de l'index à rechercher dans les données du formulaire
     * @return mixed Valeur associée à l'index, ou null si l'index n'existe pas
     */
    private function getValue($index)
    {
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * Crée et retourne un bouton HTML pour ajouter une nouvelle école,
     * en utilisant la méthode p_bt_crudA pour envelopper le bouton.
     *
     * @return string Code HTML pour le bouton "Ajouter"
     */
    public function ajouter($ajouter)
    {
        return $this->p_bt_crudA(
            '<button id="bt_ajouter" type="submit" name="' . $ajouter . '" value="' . $this->getValue($ajouter) . '"> Ajout école => BD  </button>'
        );
    }

    /**
     * Crée et retourne un bouton HTML pour supprimer une école,
     * en utilisant la méthode p_bt_crudS pour envelopper le bouton.
     *
     * @return string Code HTML pour le bouton "Supprimer"
     */
    public function suprimer()
    {
        return $this->p_bt_crudS(
            '<button id="bt_suprimer" type="submit" name="suprimer" value="suprimer"> Supprimer école </button>'
        );
    }

    /**
     * Crée et retourne un bouton HTML pour créer une nouvelle école,
     * en utilisant la méthode p_bt_crudN pour envelopper le bouton.
     *
     * @param string $nouveau Clé spécifique à utiliser pour récupérer une valeur dans les données du formulaire
     * @return string Code HTML pour le bouton "Nouveau"
     */
    public function nouveau($nouveau)
    {
        return $this->p_bt_crudN(
            '<button id="bt_nouveau" type="submit" name="' . $nouveau . '" value="' . $this->getValue($nouveau) . '"> Créer école </button>'
        );
    }

    /**
     * Vérifie si un formulaire de création d'une nouvelle école a été soumis.
     * Si le formulaire a été soumis, initialise la connexion à la base de données
     * et génère les données des écoles à enregistrer dans la base.
     */
    public function crud_VerifNouveau()
    {
        // Vérifie si le formulaire "nouveau" a été soumis
        if (!empty('nouveau') && isset($_POST['nouveau'])) {
            echo "<p> 1. GÉNÉRER LES DONNÉES </p>";
            echo "<p> 2. Initialiser la connexion à la base de données </p>";
            // Initialise la connexion à la base de données
            $connexion = new ConextionBD();


            // Initialise la classe de gestion des écoles pour générer les données
            $gestionEcole = new GestionEcole($connexion);
            $gestionEcole->genererDonnees();
        }
    }


    public function crud_VerifAjouter()
    {
        // Vérifie si le formulaire "nouveau" a été soumis
        if (!empty('ajouter') && isset($_POST['ajouter'])) {
            // Initialise la connexion à la base de données
            $connexion = new ConextionBD();
            $pdo = $connexion->getPDO();
            echo "<p> 3. Remplir les tables </p>";
            //nouvel verification ci donner Exite?

            if ($pdo instanceof PDO) {
                echo "<p> CONNEXION OK </p>";
                $connexion->ce_conecter_bd();
                echo "<p> ECRITURE DES DONNER EN COUR </p>";
            } else {
                echo "<p>L'objet \$pdo n'est pas correctement initialisé.<p>";
            }
        } else {
            echo "<p>mesasage Echeque envoie data <p>";
        }
    }
}
