<?php
namespace Classes;
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
use BD\BaseDeDonnee;

class Details{

    protected int $me;
    protected BaseDeDonnee $database;

    public function __construct(){
        $this->database = new BaseDeDonnee();
        $this->me = (int) $_SESSION['me'];
    }

}


?>
