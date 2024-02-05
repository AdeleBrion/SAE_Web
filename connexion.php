<?php
require_once "identification.php";
require_once "retourNav.php";
require_once "Classes/InputText.php";
require_once "Classes/InputPassword.php";

use Form\Type\InputText;
use Form\Type\InputPassword;
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
    <main>
        <h1><img src="fixtures/images/line.png"> Connexion <img src="fixtures/images/line.png"></h1>
        <form>
            <?php
                $pseudo = new InputText("connect","pseudo","Insérez votre pseudo","pseudoCompte",true, "Pseudo :");
                $mdp = new InputPassword("connect","mdp","Saississez votre mot de passe","mdpCompte",true, "Mot de passe :");
                $pseudo->render();
                $mdp->render();
            ?>
            <button type="submit" name="connexion">Se connecter</button>
        </form>
    </main>
</body>
</html>