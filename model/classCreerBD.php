<?php
class CreationBD
{



    public function verifCreerBD()
    {
        if (!empty($_POST['creer']) && isset($_POST['creer'])) {

            $creer = $_POST['creer'];

            echo "<p> La demende de création de basse de doner et bien resue</p>";
        }
        if (isset($creer)) {

            echo "<p> La base de donne peut etre créer! </p>";
        } else {

            echo "<p> En atente de demende de création de base de donnée</p>";
        }
    }
}
