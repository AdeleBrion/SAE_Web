<?php
require_once "retourNav.php";
require_once "Classes/artisteDetails.php";
$id = $_GET['id'];
$artiste = new artisteDetails($id);
$titre = "<title>". $artiste->getNomArtiste() ." - Mus'inEar</title>";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/artisteDetail.css">
        <?php echo $titre; ?>
    </head>
    <body>
        <?php echo $artiste; ?>
    </body>

</html>