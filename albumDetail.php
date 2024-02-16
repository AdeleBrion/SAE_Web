<?php
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
require_once "nav/retourNav.php";

$album = new Classes\AlbumDetails();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/albumDetail.css">
        <?php echo "<title>". $album->getNomAlbum() ." - Mus'inEar</title>"; ?>
    </head>
    <body>
        <?php echo $album; ?>
    </body>
</html>
