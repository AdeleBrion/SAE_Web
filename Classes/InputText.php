<?php

namespace Form\Type;

require_once 'Input.php';

use Form\Type\Input;

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