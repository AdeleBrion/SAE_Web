<?php

namespace Form\Type;

require_once 'Input.php';  // Assurez-vous que le fichier Input.php est dans le bon emplacement

use Form\Type\Input;

//require_once "../GeneriqueFormElement.php";
class InputPassword extends Input {
    public function __construct($id,$name,$value,$label,$required, $question) {
        parent::__construct("password",$id,$name,$value,$label,$required, $question);
    }

    public function render() {
        parent::render();
    }
}

?>