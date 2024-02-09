<?php

use Form\Type\InputText;

require_once 'requeteBase.php';
require_once "Classes/SelectBox.php";
require_once "Classes/InputText.php";

class InsertionAlbum{

    protected string $cheminEnregistrement;
    protected int $me;
    protected BaseDeDonnee $database;

    public function __construct(){
        $this->cheminEnregistrement = "./fixtures/images/";
        $this->database = new BaseDeDonnee();
        $this->me = (int) $_SESSION['me'];


        if($_POST || $_FILES){
            $file = $this->upload($_FILES, $this->cheminEnregistrement);
            if (is_string($file)){
                echo '<h1>Upload terminé : '.$file.'</h1>';
            } else {
                echo "<h1>Upload terminé : pas d'image fournie<h1>";
            }
        }
    }

    private function upload($_files, $destination_rep){
        if(!empty($_files['pochette']['tmp_name']) && !empty($_files['pochette']['name']))
        {
            $tmp_file = $_files['pochette']['tmp_name'];

            //on teste si l'upload a reussi
            if(!is_uploaded_file($tmp_file))
                exit('Erreur lors de l\'upload.');

            // on va ajouter une chaine pour rendre le nom du fichier unique et pratiquement introuvable.
            $unikifier = md5( uniqid('H', 5) );

            // extension du fichier
            $ext = pathinfo($_FILES['pochette']['name'], PATHINFO_EXTENSION);

            // nettoyage du nom du fichier (on ne veux pas d'accents ou d'espace)
            $file_name = $unikifier.'.'.$ext;

            //on déplace le fichier vers notre répertoire de destination
            if(!move_uploaded_file($tmp_file, $destination_rep.$file_name))
                exit("Impossible de déplacer le fichier. Upload annulé.");
            else
                return $file_name;
        }
    }

    public function __toString(){
        $output = "<main>
            <h1><img src='fixtures/images/line.png'> Créez votre album <img src='fixtures/images/line.png'></h1>

            <h2><img src='fixtures/images/line.png'> Couverture de votre album <img src='fixtures/images/line.png'></h2>
            
            <form method='post' action='creationAlbum.php' enctype='multipart/form-data' action='' >
                <input id='dropZone' type='file' name='pochette' size='30'>

                <section class='textArea'>
                    <section class='nomAlbum'>
                        <h2><img src='fixtures/images/line.png'> Nom de l'album <img src='fixtures/images/line.png'></h2>";

        $nomAlbum = new InputText('saisir', 'nomAlbum', 'Nom album ici...', 'nomAlbum', true, '');
        $output .= $nomAlbum->render();

                        
        $output .= "</section>

                    <section class='anneeParution'>
                        <h2><img src='fixtures/images/line.png'> Année de parution <img src='fixtures/images/line.png'></h2>";

        $parution = new InputText('saisir', 'parution', 'Date de parution...', 'parution', true, '');
        $output .= $parution->render();
                        
        $output .= "</section>
                </section>
                <section class='genreAlbum'>
                    <h2><img src='fixtures/images/line.png'> Genre de l'album <img src='fixtures/images/line.png'></h2>
                    <div class='selectbox'>";

        $options = $this->database->getAllGenre();
        $selectGenre = new SelectBox('Choisir un genre', 'genre[]', '', 'select', $options);
        $output .= $selectGenre."</div>
                    <button id='ajouterGenre'><img src='fixtures/images/plus.png'> Ajouter un genre</button>
                    <button id='supprimerGenre'><img src='fixtures/images/moins.png'> Supprimer un genre</button>

                    
                </section>

                <section class='titres'>
                    <h2><img src='fixtures/images/line.png'> Titres<img src='fixtures/images/line.png'></h2>
                    <div class='tracks'>
                        <input type='text' class='saisir' id='titre' name='titre[]' placeholder='Nom titre ici...' required=true>
                    </div>
                    <button id='ajouter'><img src='fixtures/images/plus.png'> Ajouter un titre</button>
                    <button id='supprimer'><img src='fixtures/images/moins.png'> Supprimer un titre</button>
                </section>
                
                <button class='validation' value='submit' onclick='saveImage()' > Créer l'album </button>
            </form>

        </main>";

        return $output;
    }
}


?>