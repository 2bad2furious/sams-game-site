<?php


namespace presenter\page;


use model\Head;
use model\language\LanguageI;
use presenter\Presenter;

class HeadPresenter extends Presenter {
    private $view;
    private $lang;
    private $head;

    public function __construct(LanguageI $lang, array $server) {

        $this->lang = $lang;
    }


    private function main(): void {

    }

    public function getHead(): Head {
        return $this->head;
    }
}