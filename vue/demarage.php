<?php
require "model/classFormDemarage.php";
?>
<article class="demarage">
    <h2 class="titreArticle">Bouton de démarage</h2>

    <form action="" method="post">
        <?php
        $formDemarage = new classFormDemarage();

        echo "<p class = 'test' >" . $formDemarage->test_fom_demarage() . "</p>";

        ?>
    </form>
</article>