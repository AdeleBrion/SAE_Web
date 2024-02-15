<?php
namespace Classes;

class InputText extends Input {
    public function __construct($id,$name,$value,$label,$required, $intitule) {
        parent::__construct("text",$id,$name,$value,$label,$required, $intitule);
    }

    public function render(): string
    {
        return parent::render();
    }
}

?>