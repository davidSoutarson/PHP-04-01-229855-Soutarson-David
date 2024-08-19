<?php


class FormCRUD
{
    private $data;
    // etape 1
    public $tag_p_bt_nouveau = 'p class="p_bt_nouveau"';
    public $tag_p_bt_ajouter = 'p class="p_bt_ajouter"';
    public $tag_p_bt_suprimer = 'p class="p_bt_suprimer"';


    public function __construct($data)
    {
        //constructeur de formDemarage
        $this->data = $data;
    }

    //etape 2
    private function p_bt_crudN($html)
    {
        return "<{$this->tag_p_bt_nouveau}>{$html}</{$this->tag_p_bt_nouveau}>";
    }

    private function p_bt_crudA($html)
    {
        return "<{$this->tag_p_bt_ajouter}>{$html}</{$this->tag_p_bt_ajouter}>";
    }

    private function p_bt_crudS($html)
    {
        return "<{$this->tag_p_bt_suprimer}>{$html}</{$this->tag_p_bt_suprimer}>";
    }


    //etape 3
    public function nouveau()
    {
        return $this->p_bt_crudN(
            '<button id="bt_nouveau" type="submit" name="nouveau" value ="nouveau"> Creer ecole </button>'
        );
    }

    public function ajouter()
    {
        return $this->p_bt_crudA(
            '<button id="bt_ajouter" type="submit" name="ajouter" value ="ajouter"> Enregistre ecole </button>'
        );
    }

    public function suprimer()
    {
        return $this->p_bt_crudS(
            '<button id="bt_suprimer" type="submit" name="suprimer" value ="suprimer"> Suprimer ecole </button>'
        );
    }
}
