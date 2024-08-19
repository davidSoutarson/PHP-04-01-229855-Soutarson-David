<?php


class FormDemarage
{
    private $data;
    public $tag_p_bt_creer = 'p class="p_bt_creer"';

    public function __construct($data)
    {
        //constructeur de formDemarage
        $this->data = $data;
    }

    private function p_bt_creer($html)
    {
        return "<{$this->tag_p_bt_creer}>{$html}</{$this->tag_p_bt_creer}>";
    }

    public function submit()
    {
        return $this->p_bt_creer(
            '<button id="bt_creer" type="submit" name="creer" value = "creer"> Creer la Base de donnée </button>'
        );
    }
}
