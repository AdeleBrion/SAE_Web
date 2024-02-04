<?php
require_once "retourNav.php";
require_once "Classes/albumDetails.php";
$id = $_GET['id'];
$album = new albumDetails($id);
$titre = "<title>". $album->getNomAlbum() ."- Mus'inEar</title>";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/albumDetail.css">
        <?php echo $titre; ?>
    </head>
    <body>
        <?php echo $album; ?>
    </body>
</html>