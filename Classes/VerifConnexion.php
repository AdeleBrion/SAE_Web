<?php
require_once 'requeteBase.php';

class VerifConnexion{
    protected BaseDeDonnee $database;

    public function __construct(){
        $this->database = new baseDeDonnee();
    }

    public function __toString(){
        $output ="";

        return $output;
    }

}

?>
