<?php
require_once 'requeteBase.php';


class InfoPerso{
    protected BaseDeDonnee $database;
    protected int $me;

    public function __construct(){
        $this->database = new BaseDeDonnee();
        $this->me = (int) $_SESSION['me'];

        if (!$this->me){
            header('Location: connexion.php');
        }

        if (isset($_POST['modifBio'])){
            $this->database->editerBiographie($this->me, $_POST['biographie']);
        }

        if (isset($_POST['suppression'])){
            $this->database->supprimerAlbum($_POST['idAlbum']);
            header('Location: compte.php');
        }

        if (isset($_POST['fermeture'])){
            $this->database->fermerCompte($this->me);
            header('Location: deconnexion.php');
        }
    }

    public function monNom(): string
    {
        return $this->database->getNomCompte($this->me);
    }

    public function __toString(){
        $output = "<main>
            <h1><img src='fixtures/images/line.png'> Mes informations <img src='fixtures/images/line.png'></h1>
            <h2>Votre nom d'artiste est : ".$this->monNom()."</h2>";

        if ($this->database->isArtiste($this->me)){
            $output .= "<form class='bio' id='bio' method='POST' >
                            <label class='labelbio'>Modifier votre biographie :</label>
                            <textarea class='textareabio' name='biographie' rows='10' cols='80' >".$this->database->getBiographie($this->me)."</textarea>
                            <button  class='buttonbio' type='submit' name='modifBio'>Enregistrer</button>
                        </form>";

            $output .= "<h2 class='titre'><img src='fixtures/images/line.png'> Vos albums <img src='fixtures/images/line.png'></h2><section class='container'>
                        <section class='mesAlbums'>";
            
                        foreach($this->database->getAlbumsByArtist($this->me) as $album){
            $output .= "<div class='content'>"
                            .$album.
                            "<form method='POST' >
                                <input type='hidden' name='idAlbum' value='".$album->getId()."' >
                                <button type='submit' name='suppression'>Supprimer</button>
                            </form>
                        </div>";
            }
            $output .= "</section>
                    <form action='creationAlbum.php'>
                        <button type='submit'>Créez un nouvel album</input>
                    </form>";    
        }

        $output .= "<form method='POST' >
                        <button class='buttonclosecompte' type='submit' name='fermeture'>Fermer mon compte</button>
                    </form>
                </main>";
        return $output;
    }

}

?>
