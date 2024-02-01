<?php

require_once "retourNav.php";
require_once "Classes/track.php";

require_once 'requeteBase.php';
$database = new baseDeDonnée();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/albumDetail.css">
        <title><<Album>> - Mus'inEar</title>
    </head>
    <body>
        <main>
            <section class="description">
                <?php $database->getAlbumImage(3); ?>
                <div class="detail">
                    <img class="coeur" src="fixtures/images/coeur.png">
                    <section class="noms">
                        <h1>5-STAR</h1>
                        <a href="artisteDetail.php"><h2>Stray Kids</h2></a>
                        <p>2023</p>
                    </section>
                </div>
                <p>Note: ../5</p>
            </section>
            <section class="track">
                <h2>TITRES</h2>
                <?php
                    $database->getTitreByAlbum(3);
                ?>
            </section>
        </main>
    </body>
</html>