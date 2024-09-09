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

            ## puis la genere
            echo "<h2> Generer le contenue </h2> <hr>";

            $generer = new GenerData($connexion->getPDO());

            $nomEcoles = $generer->genererNomEcoles();

            foreach ($nomEcoles as $key => $value) {

                echo "<p> contenue Table: ecoles: </p> <p> nom_ecole: " . $value . "<p>";
                $nombre_eleves = $generer->genererNombreEleves();
                echo "<p> nombre_eleves: " . $nombre_eleves . "<p>"; #teste

                $nombre_sportifs = $generer->genererNombreDeSportif();
                echo "<p> nombre_sportifs: " . $nombre_sportifs . "<p>"; #teste

                echo '<hr> ';

                // ----------------------
                echo "<p> contenue Table: nombre_eleves_pratiquan_1_2_3_sports: </p>";

                $nElevePrati_1_Sport = $generer->genererSportifPratiquan1S();
                echo "<p> nombre éléves pratiquan 1 sport: " . $nElevePrati_1_Sport . "<p>"; #teste

                $nElevePrati_2_Sport = $generer->genererSportifPratiquan2S();
                echo "<p> nombre éléves pratiquan 2 sport: " . $nElevePrati_2_Sport . "<p>"; #teste

                $nElevePrati_3_Sport = $generer->genererSportifPratiquan3S();
                echo "<p> nombre éléves pratiquan 3 sport: " . $nElevePrati_3_Sport . "<p>"; #teste

                echo '<hr>';

                echo '<p>Chois des sports </p>';

                echo "<p> Un chois a repartire par sport: " . $generer->repChoi1() . "</p>";
                echo $generer->repartitionAleatoireChoix1();
                echo '<hr> ';

                echo "<p> Deux chois a repartire par sport: " . $generer->repChoi2() . "</p>";
                echo $generer->repartitionAleatoireChoix2();
                echo '<hr> ';

                echo "<p> Trois chois a repartire par sport: " . $generer->repChoi3() . "</p>";
                echo $generer->repartitionAleatoireChoix3();
                echo '<hr> ';

                echo '<hr> <hr>';

                /* echo '<hr>';
                var_dump($generer);
                echo '<hr> </br>'; */
            }



            ##$remplir

        }
    }
}
