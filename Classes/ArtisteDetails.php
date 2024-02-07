<?php

require_once "Classes/AlbumNomImage.php";
require_once 'requeteBase.php';

class ArtisteDetails{
    protected int $idArtiste;
    protected string $nomArtiste;
    protected string $biographie;
    protected string $lienImg;
    protected BaseDeDonnee $database;

    public function __construct(int $idArtiste){
        $this->database = new BaseDeDonnee();
        $artiste = $this->database->getArtisteById($idArtiste);
        $this->idArtiste = $idArtiste;
        $this->nomArtiste = $artiste["nom"];
        $this->biographie = $artiste["biographie"];
        $this->lienImg = $artiste["cheminPhoto"];
    }

    public function getNomArtiste(): string
    {return $this->nomArtiste;}

    public function __toString(){
        $output = "<main>
                    <section class='classification'>
                        <img class='artiste' src='$this->lienImg'>
                        <h1>$this->nomArtiste</h1>
                        <ul class='style'>Styles:";
        foreach($this->database->getStylesArtiste($this->idArtiste) as $style){
            $output .= "<li>$style</li>";
        }

        $output .= "</ul>
                    <img class='coeur' src='fixtures/images/coeur.png'>
                </section>
                <section class='infos'>
                    <p class='description'>$this->biographie</p>
                    <h2><img src='fixtures/images/line.png'> Albums <img src='fixtures/images/line.png'></h2>
                    <div class='content'>";

        foreach($this->database->getAlbumsByArtist($this->idArtiste) as $album){
            $output .= "<a href='albumDetail.php?id=".$album->getId()."'class='album'>" . $album . "</a>";
        }
        $output .= "</div></section></main>";

        return $output;
    }

}

?>
