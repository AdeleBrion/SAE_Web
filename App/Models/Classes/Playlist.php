<?php
namespace Models\Classes;
use autoload\Autoloader;
Autoloader::register();

class Playlist{
    protected BD\BaseDeDonnee $database;
    protected int $me;

    public function __construct(){
        $this->database = new BD\BaseDeDonnee(__DIR__);
        $this->me = (int) $_SESSION['me'];

        if (!$this->me){
            header('Location: connexion.php');
        }

        if (isset($_POST['ajoutPlaylist']))Track::gererAjoutPlaylist($this->me, $_POST['titre'], $_POST['album']);
    }

    public function monNom(): string
    {
        return $this->database->getNomCompte($this->me);
    }

    public function __toString(){
        $output = "<main>
                        <h1><img src='../../Static/fixtures/images/line.png'>Ma Playlist<img src='../../Static/fixtures/images/line.png'></h1>
                        <div class='playlist'>";
        $titres = $this->database->getPlaylist($this->me);
        foreach ($titres as $titre) {
            $output .= $titre;
        }
        $output .= "</div>
                    </main>";
        return $output;
    }

}

?>
