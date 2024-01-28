<?php

require_once "nav.php";
require_once "Classes/albumNomImage.php";

require_once 'requeteBase.php';
$database = new baseDeDonnée();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/accueil.css">
    <title>Mus'inEar</title>
</head>

<body>
    <main>
        <h2 class="titre"><img src="fixtures/images/line.png"> Albums <img src="fixtures/images/line.png"></h2>
        <section class="container">
            <section class="albums">
                <?php
                $database->getAlbum();
                ?>
            </section>
        </section>
        <h2 class="titre"><img src="fixtures/images/line.png"> Artistes <img src="fixtures/images/line.png"></h2><section class="container">
            <section class="artiste">
                <?php
                $database->getArtiste();
                ?>
            </section>
        </section>
    </main>
</body>

</html>