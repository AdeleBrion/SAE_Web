<?php
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
require_once "retourNav.php";
use Classes\InfoPerso;
$infoPerso = new InfoPerso();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/connexion.css">
        <title>Mes informations - Mus'inEar</title>
    </head>
    <body>
        <?php echo $infoPerso; ?>
    </body>
</html>
