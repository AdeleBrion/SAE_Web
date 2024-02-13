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
                        <input type='text' placeholder='Search..'>";

        if ($this->me == 0){
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
