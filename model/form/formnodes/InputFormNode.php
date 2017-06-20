<?php


namespace model\form\formnodes;


use model\form\FormNode;

class InputFormNode extends FormNode {
    protected $type;

    public function __construct(string $name, string $type = "text", string $placeholder = "", bool $required = false, string $value = "", string $additionaltags = "") {
        $this->type = $type;
        parent::__construct($name, $placeholder, $required, $value, $additionaltags);
    }

    /**
     * returns html string
     * e.g.: <input type='text' ....>
     * @return string
     */
    public function returnHtml(): string {
        return "<input type='{$this->type}' name='{$this->name}' placeholder='{$this->placeholder}' value='{$this->value}' {$this->getRequired()} {$this->getAdditionaltags()}>";
    }
}