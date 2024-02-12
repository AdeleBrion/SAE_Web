<?php
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
use BD\BaseDeDonnee;
use Classes\ArtisteDetails;
require_once "nav/retourNav.php";
require_once "Classes/ArtisteDetails.php";

$artiste = new ArtisteDetails();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/artisteDetail.css">
        <?php echo "<title>". $artiste->getNomArtiste() ." - Mus'inEar</title>"; ?>
    </head>
    <body>
        <?php echo $artiste; ?>
    </body>

</html>