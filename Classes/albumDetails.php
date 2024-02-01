<?php

class albumNomImage{
    protected string $nomArtiste;
    protected string $nomAlbum;
    protected int $annee;
    protected string $lienImg;

    public function __construct($nom, $lienImg){
        $this->nom = $nom;
        $this->lienImg = $lienImg;
    }

    public function __toString(){
        return "";
    }
}

?>