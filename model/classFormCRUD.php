<?php


class FormDemarage
{
    private $data;
    public $tag_p_bt_nouveau = 'p class="p_bt_nouveau"';
    public $tag_p_bt_ajouter = 'p class="p_bt_ajouter"';
    public $tag_p_bt_suprimer = 'p class="p_bt_suprimer"';


    public function __construct($data)
    {
        //constructeur de formDemarage
        $this->data = $data;
    }

    private function p_bt_crud($html)
    {
        return "<{$this->tag_p_bt_creer}>{$html}</{$this->tag_p_bt_creer}>";
    }

    public function nouveau()
    {
        return $this->p_bt_crud(
            '<button id="bt_nouveau" type="submit" name="nouveau" value ="nouveau"> Creer ecole </button>'
        );
    }

    public function ajouter()
    {
        return $this->p_bt_crud(
            '<button id="bt_ajouter" type="submit" name="ajouter" value ="ajouter"> Enregistre ecole </button>'
        );
    }

    public function suprimer()
    {
        return $this->p_bt_crud(
            '<button id="bt_suprimer" type="submit" name="suprimer" value ="suprimer"> Suprimer ecole </button>'
        );
    }
}
