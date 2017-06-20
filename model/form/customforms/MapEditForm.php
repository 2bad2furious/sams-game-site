<?php


namespace model\form\customforms;


use model\form\Form;
use model\form\formnodes\InputFormNode;
use model\form\formnodes\TextareaNode;
use model\language\LanguageI;

class MapEditForm extends Form{
    private $json;
    private $title;
    /**
     * add fields and stuff
     * @param LanguageI $lang
     * @param array $data
     * @return void
     */
    protected function main(LanguageI $lang, array $data = array()): void {
        $this->addFormNode($this->title = new InputFormNode("title","text",$lang->getTitle(),true,$data["title"]));
        $this->addFormNode($this->json = new TextareaNode("json",null,true,$data["json"]));
    }

    /**
     * @return mixed
     */
    public function getJson() {
        return $this->json;
    }

    /**
     * @return mixed
     */
    public function getMapTitle() {
        return $this->title;
    }

}