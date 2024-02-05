<?php

declare(strict_types=1);

namespace Form\Type;

require_once "InputRenderInterface.php";

abstract class Input implements Irender {
    protected string $type;
    protected string $id;
    protected string $name;
    protected string $value = " ";
    protected string $label;
    protected bool $required;
    protected string $question;

    public function __construct($type, $id, $name, $value, $label, $required, $question) {
        $this->type = $type;
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->required = $required;
        $this->question = $question;
    }

    public function getType() {
        return $this->type;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function getLabel() {
        return $this->label;
    }

    public function isRequired() {
        return $this->required ? "required" : " "; // ? reponse si true : reponse si false
    }

    public function render() {
        $label = "<label for='" . $this->getLabel() . "'>". $this->question ."</label>" . PHP_EOL;
        $input = "<input type='" . $this->getType() . "' id='". $this->getId() . "' name='". $this->getName() . "' placeholder='" . $this->getValue() . "' </input>" . PHP_EOL; 
        print( $label . $input);
    }
}

?>