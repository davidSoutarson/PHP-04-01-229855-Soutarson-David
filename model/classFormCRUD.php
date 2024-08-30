<?php

/**
 * Class FormCRUD
 * Permet de creer trois Bouton de type submit dans formulaire posts
 */
class FormCRUD
{
    /**
     * @var array Données du fomulaire
     */
    private $data;

    // etape 1

    /**
     * @var string Balise et class html nouveau
     */
    public $tag_p_bt_nouveau = 'p class="p_bt_nouveau"';
    /**
     * @var string Balise et class html ajouter
     */
    public $tag_p_bt_ajouter = 'p class="p_bt_ajouter"';
    /**
     * @var string Balise et class html suprimer
     */
    public $tag_p_bt_suprimer = 'p class="p_bt_suprimer"';


    /**
     * @param array $data Données utiliser par fomulaire crud
     */
    public function __construct($data = array())
    {
        $this->data = $data;
    }

    //etape 2


    /**
     *@param $html string code html a entoure uliser dans la métode: nouveau()
     *@return string 
     */
    private function p_bt_crudN($html)
    {
        return "<{$this->tag_p_bt_nouveau}>{$html}</{$this->tag_p_bt_nouveau}>";
    }

    /**
     *@param $html string code html a entoure uliser dans la métode: ajouter()
     *@return string 
     */
    private function p_bt_crudA($html)
    {
        return "<{$this->tag_p_bt_ajouter}>{$html}</{$this->tag_p_bt_ajouter}>";
    }

    /**
     *@param $html string code html a entoure uliser dans la métode: suprimer()
     *@return string 
     */
    private function p_bt_crudS($html)
    {
        return "<{$this->tag_p_bt_suprimer}>{$html}</{$this->tag_p_bt_suprimer}>";
    }


    //etape 3

    private function getValue($index)
    {
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     *@return string utilise la métode: p_bt_creer() entoure en html le bouton Creer ecole
     */
    public function nouveau($nouveau)
    {
        return $this->p_bt_crudN(
            '<button id="bt_nouveau" type="submit" name="' . $nouveau . '" value ="' . $this->getValue($nouveau) . '"> Creer ecole </button>'
        );
    }
    /**
     *@return string utilise la métode: p_bt_creer() entoure en html le bouton Enregistre
     */
    public function ajouter()
    {
        return $this->p_bt_crudA(
            '<button id="bt_ajouter" type="submit" name="ajouter" value ="ajouter"> Enregistre ecole </button>'
        );
    }
    /**
     *@return string utilise la métode: p_bt_creer() entoure en html le bouton Suprimer
     */
    public function suprimer()
    {
        return $this->p_bt_crudS(
            '<button id="bt_suprimer" type="submit" name="suprimer" value ="suprimer"> Suprimer ecole </button>'
        );
    }

    public function crud_VerifNouveau()
    {
        # var_dump($_POST);

        if (!empty('nouveau') && isset($_POST['nouveau'])) {
            //cliquer
            echo "<p> 1 GENERE LES DONER <br> 2 Initialiser la connexion à la base de données <br> 3 remplir Les TABLE  </p>";

            $connexion = new ConextionBD(); // Initialiser la connexion à la base de données

            ## puis la remplir

            # $remplir = new DatabaseSeeder($connexion->getPDO());

            # $remplir->run();
        }
    }
}
