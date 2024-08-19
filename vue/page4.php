<?php
require "header.php";
require "menu.php";
require "../model/classFormCRUD.php";
?>

<article class="demarage">
    <h2 class="titreArticle">Creer nouvele ecole, ajouter & suprimer de la base de donner</h2>
    <!--  code instentce de contenue -->
    <form action="#" method="post">
        <?php
        $formCRUD = new FormCRUD($_POST);

        echo  $formCRUD->nouveau();
        echo  $formCRUD->ajouter();
        echo  $formCRUD->suprimer();
        ?>
    </form>

</article>

<?php
require "footer.php";
?>