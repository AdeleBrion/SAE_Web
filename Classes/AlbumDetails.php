<?php
namespace Classes;

require_once "Classes/Track.php";
require_once "Classes/Details.php";

class AlbumDetails extends Details{

    protected int $idAlbum;
    protected int $idArtiste;
    protected string $nomArtiste;
    protected string $nomAlbum;
    protected int $annee;
    protected string $lienImg;

    public function __construct(){
        parent::__construct();
        $this->idAlbum = $_GET['id'];
        if (isset($_GET['like']))$this->gererFavoris();

        $album = $this->database->getAlbumById($this->idAlbum);
        $this->nomAlbum = $album["nomAlbum"];
        $this->nomArtiste = $album["nomArtiste"];
        $this->idArtiste = $album["idArtiste"];
        $this->annee = $album["annee"];
        $this->lienImg = $album["cheminPochette"];
    }

    private function gererFavoris(){
        if ($this->me != 0) //si l'utilisateur est connecté
        {
            $enFavoris = $this->database->albumEnFavoris($this->me, $this->idAlbum);
            if ($enFavoris){
                $this->database->retirerAlbumFavoris($this->me, $this->idAlbum);}
            else{
                $this->database->mettreAlbumFavoris($this->me, $this->idAlbum);}

            header('Location: albumDetail.php?id='.$_GET['id']);
        }
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

        $output .= "</section><div class='detail'>";

        if ($this->me == 0){    //si l'utilisateur n'est pas connecté
            $coeur = "<a href='connexion.php'><img class='coeur' src='fixtures/images/coeur.png'></a>";}
        else{
            $src = 'fixtures/images/coeur.png';
            if ($this->database->albumEnFavoris($this->me, $this->idAlbum)){
                $src = 'fixtures/images/coeur_plein.png';
            }

            $coeur = "<form method='get'>
                        <input type='hidden' name='id' value='".$this->idAlbum."'/>
                        <input type='hidden' name='like' value='true'/>
                        <input type='image' class='coeur' src=$src>
                    </form>";
        }

        $output .= $coeur."<section class='noms'>
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
