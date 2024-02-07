<?php

use Form\Type\InputText;

require_once "nav.php";
require_once "Classes/selectBox.php";
require_once "Classes/InputText.php";
require_once 'requeteBase.php';
$database = new baseDeDonnée();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/creationAlbum.css">
    <title>Création album - Mus'inEar</title>
</head>

<body>
    <main>
        <h1><img src="fixtures/images/line.png"> Créez votre album <img src="fixtures/images/line.png"></h1>

        <h3><img src="fixtures/images/line.png"> Couverture de votre album <img src="fixtures/images/line.png"></h3>
        <form>
            <style>
                #dropZone {
                    width: 300px;
                    height: 300px;
                    border: 2px dashed black;
                }

                img {
                    max-width: 100%;
                    max-height: 100%;
                }
            </style>
            <div id="dropZone" ondragover="allowDrop(event)" ondrop="drop(event)" ondragenter="dragEnter(event)" ondragleave="dragLeave(event)">
                Drop image here
            </div>
            <script>
                function allowDrop(event) {
                    event.preventDefault();
                }

                function dragEnter(event) {
                    event.target.style.backgroundColor = "lightgray";
                }

                function dragLeave(event) {
                    event.target.style.backgroundColor = "";
                }

                function drop(event) {
                    event.preventDefault();
                    event.target.style.backgroundColor = "";

                    var file = event.dataTransfer.files[0];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var image = new Image();
                        image.src = e.target.result;
                        event.target.innerHTML = '';
                        event.target.appendChild(image);
                    }

                    reader.readAsDataURL(file);
                }
            </script>

            <h3><img src="fixtures/images/line.png"> Nom de l'album <img src="fixtures/images/line.png"></h3>
            <?php
            $nomAlbum = new InputText("saisir", "nomAlbum", "Nom album ici...", "nomAlbum", true, "");
            $nomAlbum->render();

            ?>

            <h3><img src="fixtures/images/line.png"> Année de parution <img src="fixtures/images/line.png"></h3>
            <?php
            $parution = new InputText("saisir", "parution", "Date de parution...", "parution", true, "");
            $parution->render();
            ?>

            <h3><img src="fixtures/images/line.png"> Genre de l'album <img src="fixtures/images/line.png"></h3>
            <?php
            $options = $database->getAllGenre();
            $selectGenre = new SelectBox("Choisir un genre", "Genre", "", "select", $options);
            echo $selectGenre;
            ?>
            <button id="ajouterGenre">Ajouter un titre</button>
            <button id="supprimerGenre">Supprimer un titre</button>

            <script>
                let buttonAjoutGenre = document.getElementById("ajouterGenre");
                buttonAjoutGenre.addEventListener("click", function(e) {
                    titre = document.createElement("input");
                    titre.type = "text";
                    titre.placeholder = "Nom album ici...";
                    titre.required = true;
                    titre.id = "nomAlbum";
                    document.querySelector(".tracks").appendChild(titre);
                });

                let buttonSupprimerGenre = document.getElementById("supprimerGenre");
                buttonSupprimerGenre.addEventListener("click", function(e) {
                    if(document.querySelector(".tracks").childNodes.length > 3) {
                        document.querySelector(".tracks").removeChild(document.querySelector(".tracks").lastChild)
                }});
            </script>


            <h3><img src="fixtures/images/line.png"> Titres<img src="fixtures/images/line.png"></h3>
            <ul class="tracks">
            <input type="text" class="saisir" id="nomAlbum" placeholder="Nom album ici..." required=false>
            </ul>
            </form>
            <button id="ajouter">Ajouter un titre</button>
            <button id="supprimer">Supprimer un titre</button>

            <script>
                let buttonAjout = document.getElementById("ajouter");
                buttonAjout.addEventListener("click", function(e) {
                    titre = document.createElement("input");
                    titre.type = "text";
                    titre.placeholder = "Nom album ici...";
                    titre.required = true;
                    titre.id = "nomAlbum";
                    document.querySelector(".tracks").appendChild(titre);
                });

                let buttonSupprimer = document.getElementById("supprimer");
                buttonSupprimer.addEventListener("click", function(e) {
                    if(document.querySelector(".tracks").childNodes.length > 3) {
                        document.querySelector(".tracks").removeChild(document.querySelector(".tracks").lastChild)
                }});
            </script>
    </main>
</body>

</html>