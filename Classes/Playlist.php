<?php
require_once 'requeteBase.php';
require_once 'Classes/Track.php';


class Playlist{
    protected BaseDeDonnee $database;
    protected int $me;

    public function __construct(){
        $this->database = new BaseDeDonnee();
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
                        <h1><img src='fixtures/images/line.png'>Ma Playlist<img src='fixtures/images/line.png'></h1>
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
