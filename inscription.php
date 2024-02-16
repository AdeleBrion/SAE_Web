<?php
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
require_once "nav/nav.php";

$verifInscription = new Classes\Verification\VerifInscription();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/connexion.css">
        <script src="js/inscription.js" defer></script>
        <title>Inscription - Mus'inEar</title>
    </head>
    <body>
        <?php echo $verifInscription; ?>
    </body>
</html>
