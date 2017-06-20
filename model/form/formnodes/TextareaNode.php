<?php


namespace model\form\formnodes;


use model\form\FormNode;

class TextareaNode extends FormNode {

    /**
     * returns html string
     * e.g.: <input type='text' ....>
     * @return string
     */
    public function returnHtml(): string {
        return "<textarea name='{$this->getName()}' placeholder='{$this->getPlaceholder()}' {$this->getRequired()} {$this->getAdditionaltags()}>{$this->getValue()}</textarea>";
    }
}