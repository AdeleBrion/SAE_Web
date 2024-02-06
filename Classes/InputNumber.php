<?php

namespace Form\Type;

require_once 'Input.php';

use Form\Type\Input;

class InputNumber extends Input {
    public function __construct($id,$name,$value,$label,$required, $question){
        parent::__construct("number",$id,$name,$value,$label,$required, $question);
    }

    public function render(): string
    {
        return parent::render();
    }
}

?>