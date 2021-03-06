<?php


namespace model\form\customforms;


use model\form\Form;
use model\form\formnodes\InputFormNode;
use model\language\LanguageI;

class LoginForm extends Form {
    protected $username;
    protected $password;

    public function __construct(LanguageI $lang, array $data = array()) {
        parent::__construct($lang, $lang->getLogin(), $lang->getLogin(), $data);
    }


    /**
     * add fields and stuff
     * @param LanguageI $lang
     * @param array $data
     * @return void
     */
    protected function main(LanguageI $lang, array $data = array()): void {
        $this->username = new InputFormNode("username", "text", $lang->getUsernameFormText(), true, (string)@$data["username"]);
        $this->password = new InputFormNode("password", "password", $lang->getPasswordFormText(), true, (string)@$data["password"]);
        $this->addFormNode($this->username);
        $this->addFormNode($this->password);
    }

    /**
     * @return InputFormNode
     */
    public function getUsername(): InputFormNode {
        return $this->username;
    }

    /**
     * @return InputFormNode
     */
    public function getPassword(): InputFormNode {
        return $this->password;
    }

}