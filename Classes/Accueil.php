<?php
namespace Classes;
require_once "autoload/Autoloader.php";
use autoload\Autoloader;
Autoloader::register();
use BD\BaseDeDonnee;

class Accueil {
    protected BaseDeDonnee $database;
    protected array $albums;
    protected array $artistes;

    public function __construct(){
        $this->database = new BaseDeDonnee();
        $this->albums = $this->database->getEveryAlbums();
        $this->artistes = $this->database->getEveryArtistes();

        if (isset($_GET['keywords'])){
            $keywords = str_replace("'", '', $_GET['keywords']);
            $this->albums = $this->database->getAlbumsByKeywords($keywords);
            $this->artistes = $this->database->getArtistesByKeywords($keywords);
        }
    }

    public function __toString(){
        $output ="<main>
                    <h2 class='titre'><img src='fixtures/images/line.png'> Albums <img src='fixtures/images/line.png'></h2>
                    <section class='container'>
                        <section class='albums'>";
        foreach ($this->albums as $alb) {
            $output .= $alb;
                }
        $output .="</section>
                    </section>
                    <h2 class='titre'><img src='fixtures/images/line.png'> Artistes <img src='fixtures/images/line.png'></h2><section class='container'>
                        <section class='artiste'>";
        foreach ($this->artistes as $art){
            $output .= $art;
        }
        $output .= "</section>
                    </section>
                </main>";

        return $output;
    }
}
