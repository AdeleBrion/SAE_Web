<?php
require_once "Classes/track.php";
require_once 'requeteBase.php';

class albumDetails{
    protected int $idAlbum;
    protected int $idArtiste;
    protected string $nomArtiste;
    protected string $nomAlbum;
    protected int $annee;
    protected string $lienImg;
    protected baseDeDonnee $database;

    public function __construct(int $idAlbum){
        $this->database = new baseDeDonnee();
        $album = $this->database->getAlbumById($idAlbum);
        $this->idAlbum = $idAlbum;
        $this->nomAlbum = $album["nomAlbum"];
        $this->nomArtiste = $album["nomArtiste"];
        $this->idArtiste = $album["idArtiste"];
        $this->annee = $album["annee"];
        $this->lienImg = $album["cheminPochette"];
    }

    public function getNomAlbum(): string
    {return $this->nomAlbum;}

    public function __toString(){
        $output = "<main>
                <section class='description'>"
                .$this->database->getAlbumImage($this->idAlbum).
                "<section class='genres'>";

        foreach($this->database->getGenresAlbum($this->idAlbum) as $genre){
            $output .= "<h3>$genre</h3>";
        }

        $output .= "</section>
                <div class='detail'>
                    <img class='coeur' src='fixtures/images/coeur.png'>
                    <section class='noms'>
                        <h1>$this->nomAlbum</h1>
                        <a href='artisteDetail.php?id=$this->idArtiste'><h2>$this->nomArtiste</h2></a>
                        <p>$this->annee</p>
                    </section>
                </div>
                <p>Note: ../5</p>
                </section>
                <section class='track'>
                    <h2>TITRES</h2>";
        foreach($this->database->getTitresByAlbum($this->idAlbum) as $titre){
            $output .= $titre;
        }
        $output .= "</section>
            </main>";
        return $output;
    }
}

?>
