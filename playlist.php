<?php

require_once "retourNav.php";
require_once "Classes/Playlist.php";

$playlist = new Playlist();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/playlist.css">
    <title>Ma playlist - Mus'inEar</title>
</head>

<body>
    <?php echo $playlist; ?>
</body>

</html>
