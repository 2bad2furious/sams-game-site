<?php


namespace model\form\customforms;


use model\form\Form;
use model\form\formnodes\InputFormNode;
use model\form\formnodes\UploadFileFormNode;
use model\language\LanguageI;

class ProfileForm extends Form {
    private $photo;
    private $username;
    /**
     * add fields and stuff
     * @param LanguageI $lang
     * @param array $data
     * @return void
     */
    protected function main(LanguageI $lang, array $data = array()): void {
        $this->addFormNode($this->photo = new UploadFileFormNode());
        $this->addFormNode($this->username = new InputFormNode());
    }

    /**
     * @return mixed
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }
}