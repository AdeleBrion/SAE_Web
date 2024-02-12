<?php
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
use BD\BaseDeDonnee;

session_start();
require_once "nav/nav.php";
require_once "Classes/AlbumNomImage.php";

$database = new BaseDeDonnee();

if (intval($_SESSION['me'])){echo "Actuellement connecté avec ".$database->getNomCompte(intval($_SESSION['me']))."<br><a href='decoProvisoire.php'>Se déconnecter</a>";}
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
    <main>
        <h2 class="titre"><img src="fixtures/images/line.png"> Albums <img src="fixtures/images/line.png"></h2>
        <section class="container">
            <section class="albums">
                <?php
                $database->getAlbum();
                ?>
            </section>
        </section>
        <h2 class="titre"><img src="fixtures/images/line.png"> Artistes <img src="fixtures/images/line.png"></h2><section class="container">
            <section class="artiste">
                <?php
                $database->getArtiste();
                ?>
            </section>
        </section>
    </main>
</body>

</html>