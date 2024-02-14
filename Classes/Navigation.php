<?php

session_start();

class Navigation{

    protected int $me;

    public function __construct(){
        $this->me = (int) $_SESSION['me'];
    }

    public function __toString(){
        $output = "<nav class='navbar navbar-default navbar'>
                        <img class='logo' src='fixtures/images/logo.png'>
                        <form class='barre-recherche' method='GET'>
                            <input type='text' name='keywords' placeholder='Rechercher ...'></div>
                        </form>";

        if ($this->me == 0){        //si l'utilisateur n'est pas connecté
            $output .= "<a href='connexion.php'><img class='user' src='fixtures/images/user.png'></a></nav>";
        }
        else{
            $output .= "<a href='#' id='userBtn'><img class='user' src='fixtures/images/user.png'></a>
                    </nav>
                    <div id='menu' class='menu'>
                        <a href='compte.php'>Mes informations</a>
                        <a href='#'>Mes favoris</a>
                        <a href='playlist.php'>Ma playlist</a>
                        <a href='deconnexion.php'>Se deconnecter</a>
                    </div>";
        }
        return $output;
    }
}


?>
