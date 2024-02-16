<?php
namespace Classes;
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();


class InfoPerso{
    protected BD\BaseDeDonnee $database;
    protected int $me;

    public function __construct(){
        $this->database = new BD\BaseDeDonnee();
        $this->me = (int) $_SESSION['me'];

        if (!$this->me){
            header('Location: connexion.php');
        }

        if (isset($_POST['modifBio'])){
            $this->database->editerBiographie($this->me, $_POST['biographie']);
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
        $output .= "<form id='bio' method='POST' >
                        <label>Modifier votre biographie :</label>
                        <textarea name='biographie' rows='10' cols='80' >".$this->database->getBiographie($this->me)."</textarea>
                        <button type='submit' name='modifBio'>Enregistrer</button>
                    </form>";
        }


        $output .= "<form method='POST' >
                        <button type='submit' name='fermeture'>Fermer mon compte</button>
                    </form>
                </main>";
        return $output;
    }

}

?>
