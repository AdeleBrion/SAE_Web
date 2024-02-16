<?php
namespace Classes;
require_once "autoload/Autoloader.php";
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
