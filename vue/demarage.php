<?php
require "model/classFormDemarage.php";
require "model/classCreerBD.php";
?>
<article class="demarage">
    <h2 class="titreArticle">Bouton de démarage</h2>

    <form action="#" method="post">
        <?php
        $formDemarage = new FormDemarage($_POST);

        echo  $formDemarage->submit();
        ?>
    </form>
    <h2>Ci-dessous afiche l'etat de basse de donnée</h2>
    <?php
    $creationBD = new CreationBD();

    echo $creationBD->testCreerBD();

    echo $creationBD->verifDemandCrea();
    ?>
</article>