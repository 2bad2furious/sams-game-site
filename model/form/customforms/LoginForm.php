<?php


namespace model\form\customforms;


use model\form\Form;
use model\form\formnodes\InputFormNode;
use model\language\LanguageI;

class LoginForm extends Form {

    /**
     * add fields and stuff
     * @param LanguageI $lang
     * @param array $data
     * @return void
     */
    protected function main(LanguageI $lang, array $data = array()): void {
        $this->addFormNode(new InputFormNode("username", "text", $lang->getUsername(), true));
        $this->addFormNode(new InputFormNode("password", "password", $lang->getPassword(), true));
    }
}