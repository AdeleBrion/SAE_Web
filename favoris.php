<?php
require_once "retourNav.php";
require_once "Classes/Favoris.php";
$favoris = new Favoris();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/accueil.css">
        <title>Mes favoris - Mus'inEar</title>
    </head>
    <body>
        <?php echo $favoris; ?>
    </body>
</html>
