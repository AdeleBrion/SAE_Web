<?php

require_once "nav.php";
require_once "Classes/Track.php";

require_once 'requeteBase.php';
$database = new BaseDeDonnee();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/playlist.css">
    <title>Ma playlist - Mus'inEar</title>
</head>

<body>
    <main>
        <h1><img src="fixtures/images/line.png">Ma Playlist<img src="fixtures/images/line.png"></h1>
        <div class="playlist">
            <?php
            $titres = $database->getTitresByAlbum(1);
            foreach ($titres as $titre) {
                echo $titre;
            }
            ?>
        </div>
    </main>
</body>

</html>