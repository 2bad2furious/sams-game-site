<?php


namespace model\form\customforms;


use model\form\Form;
use model\form\FormNode;
use model\form\formnodes\InputFormNode;
use model\language\LanguageI;

class RegisterForm extends Form{
    protected $password;
    protected $password2;
    protected $username;
    protected $email;

    public function __construct(LanguageI $lang, array $data = array()) {
        parent::__construct($lang, $lang->getRegister(), $lang->getRegister(), $data);
    }

    /**
     * add fields and stuff
     * @param LanguageI $lang
     * @param array $data
     * @return void
     */
    protected function main(LanguageI $lang, array $data = array()): void {
        $this->password = new InputFormNode("password","password",$lang->getPasswordFormText(),true,(string)@$data["password"]);
        $this->password2 = new InputFormNode("password2","password",$lang->getPasswordSecondFormText(),true,(string)@$data["password2"]);
        $this->username = new InputFormNode("username","text",$lang->getUsernameFormText(),true,(string)@$data["username"]);
        $this->email = new InputFormNode("email","email",$lang->getEmailFormText(),true,(string)@$data["email"]);

        $this->addFormNode($this->username);
        $this->addFormNode($this->email);
        $this->addFormNode($this->password);
        $this->addFormNode($this->password2);
    }

    public function getPassword():FormNode {
        return $this->password;
    }

    public function getPassword2():FormNode {
        return $this->password2;
    }

    public function getUsername():FormNode {
        return $this->username;
    }

    public function getEmail():FormNode {
        return $this->email;
    }
}