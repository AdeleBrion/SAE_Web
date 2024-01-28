<?php

class albumNomImage{
    protected string $nom;
    protected string $lienImg;

    public function __construct($nom, $lienImg){
        $this->nom = $nom;
        $this->lienImg = $lienImg;
    }

    public function __toString(){
        return "<img src=$this->lienImg><h2>$this->nom</h2>";
    }
}

?>