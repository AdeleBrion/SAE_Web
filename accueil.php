<?php

require_once "nav.php";
require_once "Classes/albumNomImage.php";

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
        <section class="albums">
            <h2 class="titre"><img src="fixtures/images/line.png"> Albums <img src="fixtures/images/line.png"></h2>
            <?php
                require_once 'requeteBase.php';
                $database = new baseDeDonnée();
                $database->getAlbum();
            ?>
        </section>
    </main>
</body>
</html>