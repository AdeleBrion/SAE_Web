<?php
require_once 'requeteBase.php';

session_start();

class Navigation{
    protected BaseDeDonnee $database;
    protected int $me;

    public function __construct(){
        $this->database = new BaseDeDonnee();
        $this->me =  isset($_SESSION['me']) ? (int) $_SESSION['me'] : 0;
    }

    public function __toString(){
        $output = "<nav class='navbar navbar-default navbar'>
                        <img class='logo' src='fixtures/images/logo.png'>
                        <form class='barre-recherche' action='index.php' method='GET'>
                            <input type='text' name='keywords' placeholder='Rechercher ...'></div>
                        </form>";

        if ($this->me == 0){        //si l'utilisateur n'est pas connecté
            $output .= "<a href='connexion.php'><img class='user' src='fixtures/images/user.png'></a></nav>";
        }
        else{
            if ($this->database->isArtiste($this->me)){
                $photo = $this->database->getArtistePortrait($this->me);
            } else {$photo = 'fixtures/images/user.png';}
            $output .= "<a href='#' id='userBtn'><img class='user' src='$photo'></a>
                    </nav>
                    <div id='menu' class='menu'>
                        <a href='compte.php'>Mes informations</a>
                        <a href='favoris.php'>Mes favoris</a>
                        <a href='playlist.php'>Ma playlist</a>
                        <a onclick='togglePopup($this->me);'>Se deconnecter</a>
                    </div>

                    <div id='$this->me' class='popup-overlay'>
                        <div class='popup-content'>
                            <div class='contenu-popup'>
                                <h2>Vous allez être déconnecté.</h2>
                            </div>
                            <div class='contenu-popup'>
                                <a onclick='togglePopup($this->me);'><input id='annuler-deconnexion' type='button' value='Annuler' alt='AnnulerDeconnexion'/></a>
                                <a href='deconnexion.php'><input id='valider-deconnexion' type='button' value='Continuer' alt='ValiderDeconnexion'/></a>
                            </div>
                        </div>
                    </div>";
        }
        return $output;
    }
}

?>
