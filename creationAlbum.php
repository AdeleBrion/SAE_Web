<?php
require_once "Classes/InsertionAlbum.php";
require_once "nav.php";

$insertionAlbum = new InsertionAlbum();
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/creationAlbum.css">
        <script src="js/creationAlbum.js" defer></script>
        <title>Création d'album - Mus'inEar</title>
    </head>

    <body>
        <?php echo $insertionAlbum; ?>
    </body>
</html>
