<?php
class CreationBD
{

    public function testCreerBD()
    {
        return var_dump($_POST);
    }

    public function verifDemandCrea()
    {
        if (!empty($_POST['creer']) && isset($_POST['creer'])) {

            $creer = $_POST['creer'];
            $info = "<p> La demende de création de basse de doner et bien paser </p>";
            return $info;
        } else {

            return "<p> En atente de demende de création de base de donnée</p>";
        }
    }
}
