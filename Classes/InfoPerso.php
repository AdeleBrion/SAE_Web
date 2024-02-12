<?php
namespace Classes;
use BD\requeteBase\BaseDeDonnee;
require_once 'requeteBase.php';


class InfoPerso{
    protected BaseDeDonnee $database;
    protected int $me;

    public function __construct(){
        $this->database = new BaseDeDonnee();
        $this->me = (int) $_SESSION['me'];

        if (!$this->me){
            header('Location: index.php');
        }
    }

    public function monNom(): string
    {
        return $this->database->getNomCompte($this->me);
    }

    public function __toString(){
        $output = "<main>
        <h1><img src='fixtures/images/line.png'> Mes informations <img src='fixtures/images/line.png'></h1>
        <form>
            <h2>".$this->monNom()."</h2>
            <a href='' ><button> Ma Playlist </button></a>
        </form>
    </main>";
        return $output;
    }

}

?>
