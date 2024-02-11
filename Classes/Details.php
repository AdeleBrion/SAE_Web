<?php
require_once 'requeteBase.php';

class Details{

    protected int $me;
    protected BaseDeDonnee $database;

    public function __construct(){
        $this->database = new BaseDeDonnee();
        $this->me = (int) $_SESSION['me'];
    }

}


?>
