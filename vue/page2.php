<?php
require "header.php";
require "menu.php";
require "../model/classConextionBD.php";
require "../model/classFormCRUD.php";
#----------------------------------
require '../model/generData.php';
?>

<article class="article">
    <h2 class="titreArticle"> Genérer est Enregistre </h2>
    <!--  code instentce de contenue -->
    <?php


    //V1 fontionnele

    $connexion = new ConextionBD();
    $pdo = $connexion->getPDO();

    if ($pdo instanceof PDO) {

        $connexion->creerTables(); // Créer les tables

        echo ' <form action="#" method="post">';

        $formCRUD = new FormCRUD($_POST);

        echo  $formCRUD->nouveau('nouveau');

        echo '</form>';
        $formCRUD->crud_VerifNouveau();
    } else {
        echo "<p>L'objet \$pdo n'est pas correctement initialisé.<p>";
    }
    ?>

</article>

<?php
require "footer.php";
?>