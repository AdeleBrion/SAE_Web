<?php
require_once "retourNav.php";
require_once "Classes/InfoPerso.php";
$infoPerso = new InfoPerso();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/connexion.css">
        <link rel="stylesheet" href="css/popup.css">
        <script src="js/popup.js"></script>
        <title>Mes informations - Mus'inEar</title>
    </head>
    <body>
        <?php echo $infoPerso; ?>
    </body>
</html>
