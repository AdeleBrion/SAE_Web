<?php
namespace Models\Classes;
use autoload\Autoloader;
Autoloader::register();

session_start();

class Navigation{
    protected BD\BaseDeDonnee $database;
    protected int $me;

    public function __construct(){
        $this->database = new BD\BaseDeDonnee(__DIR__);
        $this->me = (int) $_SESSION['me'];
    }

    public function __toString(){
        $output = "<nav class='navbar navbar-default navbar'>
                        <a href='../../index.php'><img class='logo' src='../Static/fixtures/images/logo.png'><a>
                        <form class='barre-recherche' action='index.php' method='GET'>
                            <input type='text' name='keywords' placeholder='Rechercher ...'></div>
                        </form>";

        if ($this->me == 0){        //si l'utilisateur n'est pas connecté
            $output .= "<a href='../Models/Vue/connexion.php'><img class='user' src='../Static/fixtures/images/user.png'></a></nav>";
        }
        else{
            if ($this->database->isArtiste($this->me)){
                $photo = $this->database->getArtistePortrait($this->me);
            } else {$photo = '../Static/fixtures/images/user.png';}
            $output .= "<a href='#' id='userBtn'><img class='user' src='$photo'></a>
                    </nav>
                    <div id='menu' class='menu'>
                        <a href='../Models/Vue/compte.php'>Mes informations</a>
                        <a href='../Models/Vue/favoris.php'>Mes favoris</a>
                        <a href='../Models/Vue/playlist.php'>Ma playlist</a>
                        <a href='../Models/Vue/deconnexion.php'>Se deconnecter</a>
                    </div>";
        }
        return $output;
    }
}

?>
