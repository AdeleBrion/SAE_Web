<?php
namespace Classes;
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
use BD\BaseDeDonnee;

class Track extends Details{

    protected int $album;
    protected int $titre;
    protected string $nom;
    protected bool $ordonne;

    public function __construct(int $album, int $num, string $nom, bool $ordonne){
        parent::__construct();
        $this->album = $album;
        $this->titre = $num;
        $this->nom = $nom;
        $this->ordonne = $ordonne;
    }

    public static function gererAjoutPlaylist(int $idUtilisateur, int $idTitre, int $idAlbum){
        if ($idUtilisateur != 0) //si l'utilisateur est connecté
        {
            $accesBD = new BaseDeDonnee();
            $dansPlaylist = $accesBD->titreDansPlaylist($idUtilisateur, $idAlbum, $idTitre);
            if ($dansPlaylist){
                $accesBD->retirerTitreDePlaylist($idUtilisateur, $idAlbum, $idTitre);}
            else{
                $accesBD->mettreTitreDansPlaylist($idUtilisateur, $idAlbum, $idTitre);}
        }
    }

    public function __toString(){
        $output ="<div class='titre'>";
        if ($this->ordonne){
            $output .= "<p class='num'>$this->titre</p>";
        }

        if ($this->me == 0){    //si l'utilisateur n'est pas connecté
            $addPlaylist = "<a href='connexion.php'><img class='check' src='fixtures/images/plus.png'/></a>";}
        else{
            $src = 'fixtures/images/plus.png';
            if ($this->database->titreDansPlaylist($this->me, $this->album, $this->titre)){
                $src = 'fixtures/images/moins.png';
            }

            $addPlaylist = "<form method='POST'>
                        <input type='hidden' name='album' value='$this->album'/>
                        <input type='hidden' name='titre' value='$this->titre'/>
                        <input type='hidden' name='ajoutPlaylist' value='true'/>
                        <input type='image' class='check' src=$src>
                    </form>";
        }

        $output .= "<p class='title'>$this->nom</p>".$addPlaylist."</div>";

        return $output;
    }
}

?>
