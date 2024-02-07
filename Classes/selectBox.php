<?php
class SelectBox{
    protected string $label;
    protected string $name;
    protected string $value;
    protected string $id;
    protected array $options;

    public function __construct(string $label, string $name, string $value, string $id){
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->id = $id;
    }

    public function __toString(){
        $res = "<label for=\"$this->id\">$this->label</label><select name=\"$this->name\" id=\"$this->id\">";
        foreach($this->options as $option){
            $res = $res . "<option value=\"$option[0]\">$option[1]</option>";
        }
        return $res . "<\select>";
    }
}

?>