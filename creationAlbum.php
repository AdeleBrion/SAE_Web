<?php

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
    <title>Création album - Mus'inEar</title>
</head>

<body>
    <main>
        <h1><img src="fixtures/images/line.png"> Créez votre album <img src="fixtures/images/line.png"></h1>

        <h2><img src="fixtures/images/line.png"> Couverture de votre album <img src="fixtures/images/line.png"></h2>
        <form>
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
                    $parution = new InputText("saisir", "parution", "Date de parution...", "parution", false, "");
                    echo $parution->render();
                    ?>
                </section>
            </section>

            <section class="genreAlbum">
                <h2><img src="fixtures/images/line.png"> Genre de l'album <img src="fixtures/images/line.png"></h2>
                <div class="selectbox">
                    <?php
                    $options = $database->getAllGenre();
                    $selectGenre = new SelectBox("Choisir un genre", "Genre", "", "select", $options);
                    echo $selectGenre;
                    ?>
                </div>
                <button id="ajouterGenre"><img src="fixtures/images/plus.png"> Ajouter un genre</button>
                <button id="supprimerGenre"><img src="fixtures/images/moins.png"> Supprimer un genre</button>

                <script>
                    let buttonAjoutGenre = document.getElementById("ajouterGenre");
                    buttonAjoutGenre.addEventListener("click", function(e) {
                        $new = document.querySelector("#select").cloneNode(true);
                        document.querySelector(".selectbox").appendChild($new);
                    });

                    let buttonSupprimerGenre = document.getElementById("supprimerGenre");
                    buttonSupprimerGenre.addEventListener("click", function(e) {
                        if (document.querySelector(".selectbox").childNodes.length > 3) {
                            document.querySelector(".selectbox").removeChild(document.querySelector(".selectbox").lastChild)
                        }
                    });
                </script>
            </section>

            <section class="titres">
                <h2><img src="fixtures/images/line.png"> Titres<img src="fixtures/images/line.png"></h2>
                <div class="tracks">
                    <input type="text" class="saisir" id="titre" placeholder="Nom album ici..." required=false>
                </div>
                <button id="ajouter"><img src="fixtures/images/plus.png"> Ajouter un titre</button>
                <button id="supprimer"><img src="fixtures/images/moins.png"> Supprimer un titre</button>
            </section>
            
            <button class="validation" value="submit"> Créer l'album </button>
        </form>

        <script>
            let buttonAjout = document.getElementById("ajouter");
            buttonAjout.addEventListener("click", function(e) {
                titre = document.querySelector("#titre").cloneNode(true);
                titre.value = "";
                document.querySelector(".tracks").appendChild(titre);
            });

            let buttonSupprimer = document.getElementById("supprimer");
            buttonSupprimer.addEventListener("click", function(e) {
                if (document.querySelector(".tracks").childNodes.length > 3) {
                    document.querySelector(".tracks").removeChild(document.querySelector(".tracks").lastChild)
                }
            });
        </script>
    </main>
</body>

</html>