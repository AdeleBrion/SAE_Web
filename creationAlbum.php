<?php
var_dump($_GET['genre']);
echo("<br>");
var_dump($_GET['titre']);

use Form\Type\InputText;

require_once "nav.php";
require_once "Classes/selectBox.php";
require_once "Classes/InputText.php";
require_once 'requeteBase.php';
$database = new BaseDeDonnee();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/creationAlbum.css">
    <script src="JS/creationAlbum.js" defer></script>
    <title>Création album - Mus'inEar</title>
</head>

<body>
    <main>
        <h1><img src="fixtures/images/line.png"> Créez votre album <img src="fixtures/images/line.png"></h1>

        <h2><img src="fixtures/images/line.png"> Couverture de votre album <img src="fixtures/images/line.png"></h2>
        <form method='get'>
            <div id="dropZone" ondragover="allowDrop(event)" ondrop="drop(event)" ondragenter="dragEnter(event)" ondragleave="dragLeave(event)">
                Déposez l'image de la pochette ici
            </div>
            <section class="textArea">
                <section class="nomAlbum">
                    <h2><img src="fixtures/images/line.png"> Nom de l'album <img src="fixtures/images/line.png"></h2>
                    <?php
                    $nomAlbum = new InputText("saisir", "nomAlbum", "Nom album ici...", "nomAlbum", true, "");
                    echo $nomAlbum->render();

                    ?>
                </section>

                <section class="anneeParution">
                    <h2><img src="fixtures/images/line.png"> Année de parution <img src="fixtures/images/line.png"></h2>
                    <?php
                    $parution = new InputText("saisir", "parution", "Date de parution...", "parution", true, "");
                    echo $parution->render();
                    ?>
                </section>
            </section>

            <section class="genreAlbum">
                <h2><img src="fixtures/images/line.png"> Genre de l'album <img src="fixtures/images/line.png"></h2>
                <div class="selectbox">
                    <?php
                    $options = $database->getAllGenre();
                    $selectGenre = new SelectBox("Choisir un genre", "genre[]", "", "select", $options);
                    echo $selectGenre;
                    ?>
                </div>
                <button id="ajouterGenre"><img src="fixtures/images/plus.png"> Ajouter un genre</button>
                <button id="supprimerGenre"><img src="fixtures/images/moins.png"> Supprimer un genre</button>

                
            </section>

            <section class="titres">
                <h2><img src="fixtures/images/line.png"> Titres<img src="fixtures/images/line.png"></h2>
                <div class="tracks">
                    <input type="text" class="saisir" id="titre" name='titre[]' placeholder="Nom titre ici..." required=true>
                </div>
                <button id="ajouter"><img src="fixtures/images/plus.png"> Ajouter un titre</button>
                <button id="supprimer"><img src="fixtures/images/moins.png"> Supprimer un titre</button>
            </section>
            
            <button class="validation" value="submit"> Créer l'album </button>
        </form>

    </main>
</body>

</html>