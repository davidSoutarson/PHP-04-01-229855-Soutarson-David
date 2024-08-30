<?php

/**
 * Class FomDemarage
 * Bouton de type submit dans formulaire posts
 */
class FormDemarage
{
    /**
     * @var array Données du fomulaire
     */
    private $data;

    /**
     * @var string Balise et class html
     */
    public $tag_p_bt_creer = 'p class="p_bt_creer"';

    /**
     * @param array $data Données utiliser par fomulaire
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     *@param $html string code html a entoure uliser dans la métode: submit()
     *@return string 
     */
    private function p_bt_creer($html)
    {
        return "<{$this->tag_p_bt_creer}>{$html}</{$this->tag_p_bt_creer}>";
    }

    /**
     *@return string utilise la métode: p_bt_creer() entoure en html le bouton
     */
    public function submit()
    {
        return $this->p_bt_creer(
            '<button id="bt_creer" type="submit" name="creer" value = "creer"> Creer la Base de donnée </button>'
        );
    }
}
