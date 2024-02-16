<?php
namespace Classes;
use autoload\Autoloader;
Autoloader::register();

class Details{

    protected int $me;
    protected BD\BaseDeDonnee $database;

    public function __construct(){
        $this->database = new BD\BaseDeDonnee();
        $this->me = (int) $_SESSION['me'];
    }

}


?>
