<?php
require "header.php";
require "menu.php";
require "../model/classConextionBD.php";
?>

<article class="article">
    <h2 class="titreArticle"> Genérer est Enregistre </h2>
    <!--  code instentce de contenue -->
    <?php


    // Test de la classe ConextionBD
    $connexion = new ConextionBD();
    $pdo = $connexion->getPDO();

    if ($pdo instanceof PDO) {
        echo "<p>L'objet \$pdo est correctement initialisé.<p>";
    } else {
        echo "<p>L'objet \$pdo n'est pas correctement initialisé.<p>";
    }
    ?>

</article>

<?php
require "footer.php";
?>