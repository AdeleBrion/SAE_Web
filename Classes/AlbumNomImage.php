<?php

class AlbumNomImage{
    protected int $id;
    protected string $nom;
    protected string $lienImg;

    public function __construct(int $id, string $nom, string $lienImg){
        $this->id = $id;
        $this->nom = $nom;
        $this->lienImg = $lienImg;
    }

    public function getId(): int{
        return $this->id;
    }

    public function __toString(){
        return "<img src=$this->lienImg><h2>$this->nom</h2>";
    }
}

?>