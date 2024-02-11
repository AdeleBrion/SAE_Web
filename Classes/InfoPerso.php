<?php
require_once 'requeteBase.php';


class InfoPerso{
    protected BaseDeDonnee $database;
    protected int $me;

    public function __construct(){
        $this->database = new BaseDeDonnee();
        $this->me = (int) $_SESSION['me'];

        if (!$this->me){
            header('Location: connexion.php');
        }

        if (isset($_POST['suppression'])){
            $this->database->fermerCompte($this->me);
            header('Location: deconnexion.php');
        }
    }

    public function monNom(): string
    {
        return $this->database->getNomCompte($this->me);
    }

    public function __toString(){
        $output = "<main>
            <h1><img src='fixtures/images/line.png'> Mes informations <img src='fixtures/images/line.png'></h1>
            
            <h2>".$this->monNom()."</h2>
            <form method='post' >
                <input type='hidden' name='suppression' value='true' />
                <button type='submit' name='suppression'>Fermer mon compte</button>
            </form>
        </main>";
        return $output;
    }

}

?>
