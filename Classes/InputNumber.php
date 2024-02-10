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
        $label = "<label for='" . $this->getLabel() . "'>". $this->intitule ."</label>" . PHP_EOL;
        $input = "<input type='" . $this->getType() . "' id='". $this->getId() . "' name='". $this->getName() . "' value='" . $this->getValue() . "' min='0' required='" . $this->isRequired() . "' >" . PHP_EOL; 
        return $label . $input;
    }
}

?>
