<?php

require_once "retourNav.php";
require_once "Classes/albumNomImage.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/artisteDetail.css">
    <title>
        <<Artiste>> - Mus'inEar
    </title>
</head>

<body>
    <main>
        <section class="classification">
            <img class="artiste" src="fixtures/images/skz.webp">
            <h1>Stray Kids</h1>
            <h2>스트레이 키즈</h2>
            <ul class="style">Styles:
                <li>K-pop</li>
                <li>pop</li>
                <li>hip-hop</li>
                <li>éléctronique</li>
                <li>rock</li>
            </ul>
            <img class="coeur" src="fixtures/images/coeur.png">
        </section>
        <section class="infos">
            <p class="description">Stray Kids, formé en 2017 par JYP Entertainment, est un groupe de K-pop composé de huit membres.
                Connus pour leurs paroles significatives et leurs performances énergiques, ils abordent des thèmes comme l'adolescence et l'identité.
                Avec des albums à succès comme "GO生" et "NOEASY", le groupe est salué pour son authenticité artistique et sa base de fans mondiale.
                Stray Kids est devenu un acteur majeur de la scène K-pop contemporaine.
            </p>
            <h2><img src="fixtures/images/line.png"> Albums <img src="fixtures/images/line.png"></h2>
            <div class="content">
                <?php
                    require_once 'requeteBase.php';
                    $database = new baseDeDonnée();
                    $database->getAlbum();
                ?>
            </div>
        </section>
    </main>
</body>

</html>