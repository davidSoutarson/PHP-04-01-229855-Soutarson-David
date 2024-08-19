<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Devoire PHP expert 01 </title>
</head>

<body>
    <header>
        <h1 class="en-tete">PHP expert - Génération de contenus
            et statistiques</h1>
    </header>

    <nav>
        <h2 class="titreMenu">menu de navigation</h2>
        <ul>
            <li class="liste"><a href="index.php" class="item">Accueil</a></li>
            <li class="liste"><a href="vue/page2.php" class="item">Genérer & Enregistre</a></li>
            <li class="liste"><a href="vue/page3.php" class="item">Trier les données</a></li>
            <li class="liste"><a href="vue/page4.php" class="item">Creer Ajouter&Suprimer</a></li>
        </ul>
    </nav>

    <main>
        <h1>h1 main page index</h1>

        <?php
        require "vue/demarage.php";
        ?>

    </main>

    <footer>
        <p>FROMATON SUIVIE</p>
        <p>Integrateur Developer Webe et Mobile</p>
        <p>Eléve: David Soutarson </p>
        <p>n° 229855</p>
    </footer>

</body>

</html>