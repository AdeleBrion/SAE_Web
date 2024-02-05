<?php
session_start();
require_once "retourNav.php";
require_once "Classes/VerifConnexion.php";

$verifConnexion= new VerifConnexion();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Connexion - Mus'inEar</title>
</head>
<body>
    <?php echo $verifConnexion; ?>
</body>
</html>
