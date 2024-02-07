<?php

class Track{
    protected int $num;
    protected string $titre;

    public function __construct($num, $titre){
        $this->num = $num;
        $this->titre = $titre;
    }

    public function __toString(){
        return "<div class='titre'>
        <p class='num'>$this->num</p>
        <p class='title'>$this->titre</p>
        <img class='check' src='fixtures/images/add.png'/></div>";
    }
}

?>
