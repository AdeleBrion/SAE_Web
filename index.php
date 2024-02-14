<?php
require_once "nav.php";
require_once "Classes/Accueil.php";
$accueil = new Accueil();

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
        <?php echo $accueil; ?>
    </body>
</html>
