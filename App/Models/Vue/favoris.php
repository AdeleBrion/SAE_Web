<?php
require_once "../../autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
require_once "../nav/RetourNav.php";

$favoris = new Classes\Favoris();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../Static/css/accueil.css">
        <title>Mes favoris - Mus'inEar</title>
    </head>
    <body>
        <?php echo $favoris; ?>
    </body>
</html>