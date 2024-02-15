<?php
require_once 'requeteBase.php';


class Favoris{
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
        $output ="<main>
                    <h2 class='titre'><img src='fixtures/images/line.png'> Albums <img src='fixtures/images/line.png'></h2>
                    <section class='container'>
                        <section class='albums'>";
        foreach ($this->database->getAlbumsFavoris($this->me) as $alb) {
            $output .= $alb;
                }
        $output .="</section>
                    </section>
                    <h2 class='titre'><img src='fixtures/images/line.png'> Artistes <img src='fixtures/images/line.png'></h2><section class='container'>
                        <section class='artiste'>";
        foreach ($this->database->getArtistesSuivis($this->me) as $art){
            $output .= $art;
        }
        $output .= "</section>
                    </section>
                </main>";

        return $output;
    }

}

?>
